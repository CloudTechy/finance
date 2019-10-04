<?php

namespace App\Http\Controllers;

use App\Helper;
use App\Http\Requests\ValidatePackageUserRequest;
use App\Http\Resources\PackageUserResource;
use App\Notifications\PackageSubscribed;
use App\Notifications\TransactionMade; 
use App\Notifications\WithdrawalMade;
use App\Package;
use App\PackageUser;
use App\Transaction;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use \DB;
use \Exception;

class PackageUserController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		try {
			$page = request()->query('page', 1);
			$pageSize = request()->query('pageSize', 10000000);
			$data = PackageUser::filter(request()->all())
				->orderBy('expiration', 'asc')
				->paginate($pageSize);
			$total = $data->total();
			$data = PackageUserResource::collection($data);
			$builtData = Helper::buildData($data, $total);
			return Helper::validRequest($builtData, 'data was fetched successfully', 200);
		} catch (Exception $bug) {
			return $this->exception($bug, 'unknown error', 500);
		}

	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(ValidatePackageUserRequest $request) {
		$validated = $request->validated();
		DB::beginTransaction();
		try
		{
			$user = User::find($validated['user_id']);
			$package = Package::find($validated['package_id']);
			if ($package->portfolio->name == 'bronze') {
				$tries = PackageUser::where('package_id', $package->id)->where('user_id', $user->id)->count();
				if ($tries > 1) {
					return Helper::invalidRequest(['This subscription is invalid'], 'you are no more eligible for this plan, you have exceeded the number of subscriptions for this plan', 400);
				}
			}

			if ($user->balance >= $package->deposit) {

				$transaction = $user->transactions()->create(['reference' => 'SELF', 'amount' => $package->deposit, 'payment' => $package->deposit, 'sent' => true, 'confirmed' => true]);

				$withdrawal = $user->withdrawals()->create(['amount' => $package->deposit, 'reference' => 'BFIN', 'processed' => true, 'confirmed' => true]);

				$subscription = PackageUser::create(['user_id' => $user->id, 'transaction_id' => $transaction->id, 'package_id' => $package->id, 'account' => $package->deposit, 'active' => true, 'expiration' => Carbon::now()->addDays($package->duration)]);

				$user->notify(new WithdrawalMade($withdrawal));
				$user->notify(new PackageSubscribed($package));

				DB::commit();

				$this->referralPayment($subscription);

				$subscription = new PackageUserResource($subscription);
				return Helper::validRequest($subscription, 'subscription was successful', 200);
			} else {

				$payment = $package->deposit - $user->balance;

				$transaction = $user->transactions()->create(['reference' => 'SELF', 'amount' => $package->deposit, 'payment' => $user->balance]);

				$subscription = PackageUser::create(['transaction_id' => $transaction->id, 'user_id' => $user->id, 'package_id' => $package->id, 'account' => $package->deposit, 'active' => false]);

				if ($user->balance > 0) {
					$withdrawal = $user->withdrawals()->create(['amount' => $user->balance, 'reference' => 'BFIN', 'processed' => true, 'confirmed' => true]);

					$user->notify(new WithdrawalMade($withdrawal));
				}
				DB::commit();
				$subscription = new PackageUserResource($subscription);
				return Helper::validRequest($subscription, 'subscription is being processed', 200);
			}

		} catch (Exception $bug) {
			DB::rollback();
			return $this->exception($bug, 'unknown error', 500);
		}
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\PackageUser  $packageUser
	 * @return \Illuminate\Http\Response
	 */
	public function show(PackageUser $packageUser) {
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\PackageUser  $packageUser
	 * @return \Illuminate\Http\Response
	 */
	public function edit(PackageUser $packageUser) {
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\PackageUser  $packageUser
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, PackageUser $packageUser) {
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\PackageUser  $packageUser
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(PackageUser $packageUser) {
		//
	}
	public function confirmSubscription(Transaction $transaction) {
		DB::beginTransaction();
		try {

			$packageUser = PackageUser::where('transaction_id', $transaction->id)->first();
			if (!$packageUser->active && empty($packageUser->expiration)) {
				$duration = $packageUser->package->duration;
				$packageUser->update(['expiration' => Carbon::now()->addDays($duration), 'active' => true]);
				$transaction->update(['confirmed' => true, 'payment' => $packageUser->account, 'sent' => true]);

				DB::commit();
				$this->referralPayment($packageUser);
				$packageUser->user->notify(new PackageSubscribed($packageUser->package));
				$data = new PackageUserResource($packageUser);
				return Helper::validRequest($data, 'subscription successful', 200);
			} else {
				return Helper::invalidRequest(['This subscription is invalid'], 'user\'s package has already been subscribed', 400);
			}

		} catch (Exception $bug) {
			DB::rollback();
			return $this->exception($bug, 'unknown error', 500);
		}

	}
	public function referralPayment(PackageUser $subscription) {
		DB::beginTransaction();
		try {
			$user = User::find($subscription->user_id);
			$referrer = User::where('username', $user->referral)->first();
			$referrer_count = PackageUser::where('user_id', $user->id)->where('referral', $referrer->id)->count();
			$commission = $subscription->package->referral_commission / 100 * $subscription->package->deposit;
			if ($commission > 0 && $referrer_count == 0) {
				$transaction = $referrer->transactions()->create(['reference' => 'BFIN commission', 'amount' => $commission, 'payment' => $commission, 'confirmed' => true, 'active' => false, 'sent' => true]);
				$subscription->update(['referral' => $referrer->id]);
				DB::commit();
				$transaction->user->notify(new TransactionMade($transaction));
				return true;
			}
			return false;
		} catch (Exception $bug) {
			DB::rollback();
			return false;
		}

	}
}
