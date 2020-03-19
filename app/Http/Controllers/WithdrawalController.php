<?php

namespace App\Http\Controllers;

use App\Helper;
use App\Http\Requests\ValidateWithdrawalRequest;
use App\Http\Resources\WithdrawalResource;
use App\Notifications\WithdrawalMade;
use App\Notifications\NewWithdrawalRequest;
use App\Withdrawal;
use Illuminate\Http\Request;
use \DB;
use App\User;
use \Exception;
use Carbon\Carbon;

class WithdrawalController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		try {
			$page = request()->query('page', 1);
			$pageSize = request()->query('pageSize', 10000000);
			$data = Withdrawal::filter(request()->all())
				->latest()
				->paginate($pageSize);
			$total = $data->total();
			$data = WithdrawalResource::collection($data);
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
	public function store(ValidateWithdrawalRequest $request) {
		$validated = $request->validated();
		DB::beginTransaction();
		try
		{
			if(auth()->user()->canWithdraw){
				if (auth()->user()->balance >= $validated['amount']) {
					$validated['processed'] = true;
					$data = Withdrawal::create($validated);
					DB::commit();
					$this->notificationRequest($data);
					$data = new WithdrawalResource($data);
					return Helper::validRequest($data, 'Withdrawal request has been sent for processing, You will be contacted shortly', 200);
				} else {
					return Helper::invalidRequest('Insufficient funds', 'Your account is low for this transaction', 400);
				}
			}
			else {
				$withdrawEx = Carbon::createFromTimeStamp(strtotime(auth()->user()->withdrawDuration->first()->expiration))->diffForHumans() ;
				return Helper::invalidRequest('Account Withdrawal on hold', 'You cannot withdraw at this time, you can be able to withdraw ' . $withdrawEx, 400);
			}
			
			
		} catch (Exception $bug) {
			DB::rollback();
			return $this->exception($bug, 'unknown error', 500);
		}
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Withdrawal  $withdrawal
	 * @return \Illuminate\Http\Response
	 */
	public function show(Withdrawal $withdrawal) {
		try {
			$data = new WithdrawalResource($withdrawal);
			return Helper::validRequest($data, 'specified data was fetched successfully', 200);
		} catch (Exception $bug) {
			return $this->exception($bug, 'unknown error', 500);
		}
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Withdrawal  $withdrawal
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Withdrawal $withdrawal) {
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Withdrawal  $withdrawal
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, Withdrawal $withdrawal) {
		DB::beginTransaction();
		$request->except('user_id', 'amount');
		$validated = $request->validate([
			'payment' => 'numeric',
			'processed' => 'boolean',
			'confirmed' => 'boolean',
			'reference' => 'string',
			'currency_code' => 'string',
		]);
		try {
			$data = $withdrawal->update($validated);
			DB::commit();
			return Helper::validRequest(["success" => $data], 'Updated successfully', 200);
		} catch (Exception $bug) {
			DB::rollback();
			return $this->exception($bug, 'unknown error', 500);
		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Withdrawal  $withdrawal
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Withdrawal $withdrawal) {
		DB::beginTransaction();
		try {
			$data = $withdrawal->delete();
			DB::commit();
			return Helper::validRequest(["success" => $data], 'Item deleted successfully', 200);
		} catch (Exception $bug) {
			DB::rollback();
			return $this->exception($bug, 'unknown error', 500);
		}
	}

	public function confirmWithdrawal(Withdrawal $withdrawal) { 
		DB::beginTransaction();
		try {
			if(auth()->user()->userLevel->name != 'administrator'){
				return Helper::inValidRequest('User not Unauthorized to peform this operation.', 'Unauthorized Access!', 400);
			}
			if ($withdrawal->user->processedWithdrawals->sum('amount')  >= $withdrawal->amount) {
				$data = $withdrawal->update(['confirmed' => true, 'processed' => true]);
				DB::commit();
				$withdrawal->user->notify(new WithdrawalMade($withdrawal));
				return Helper::validRequest(["success" => $data], 'withdrawal confirmed successfully', 200);
			} else {
				return Helper::invalidRequest('Insufficient funds', 'Your account is low for this transaction', 400);
			}

		} catch (Exception $bug) {
			DB::rollback();
			return $this->exception($bug, 'unknown error', 500);
		}

	}

	public function notificationRequest(Withdrawal $withdrawal) {
		
		try {
			$admins = User::where('user_level_id',1)->get();
				foreach ($admins as $key => $user) {
					$user->notify(new NewWithdrawalRequest($withdrawal));
				}
		
		} catch (Exception $bug) {
			return false;
		}

	}
	public function popUpload(Request $request)
	{
		$validated = $request->validate([
			'pop' => 'mimes:jpeg,png,bmp,tiff |max:4096',
		]);
		try {
			if ($request->hasFile('pop')) {
	            if ($request->file('pop')->isValid()) {

	                $file = $request->file('pop');

	                $file->move('img/uploads', $file->getClientOriginalName());

	                $pop = $file->getClientOriginalName();
	            }

	            Withdrawal::find($request->id)->update(['pop' => $pop]);
	            return Helper::validRequest(["success" =>$request->all()], 'file uploaded successfully', 200);
        	}
	        else{
	        	return Helper::invalidRequest('No pop file', 'POP file not found', 400);
	        }
		
		} catch (Exception $bug) {
			return $this->exception($bug, 'unknown error', 500);
		}

		
	}

	public function confirmWithdrawalRequest(User $user)
	{
		if($user->update(['withdraw_request' => true])) {
			return Helper::validRequest(["success" => true], 'Action completed successfully', 200);
		}
		return Helper::invalidRequest('Error', 'There is an error completing this action', 400);
	}
	public function cancelWithdrawalRequest(User $user)
	{
		if($user->update(['withdraw_request' => false])) {
			return Helper::validRequest(["success" => true], 'Action completed successfully', 200);
		}
		return Helper::invalidRequest('Error', 'There is an error completing this action', 400);
	}
}
