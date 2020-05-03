<?php

namespace App\Http\Controllers;

use App\Helper;
use App\Http\Requests\ValidateTransactionRequest;
use App\Http\Resources\TransactionResource;
use App\Transaction;
use Illuminate\Http\Request;
use \DB;
use \Exception;
use App\User;

class TransactionController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		try {
			$page = request()->query('page', 1);
			$pageSize = request()->query('pageSize', 10000000);
			$data = Transaction::filter(request()->all())
				->latest()
				->paginate($pageSize);
			$total = $data->total();
			$data = TransactionResource::collection($data);
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
	public function store(ValidateTransactionRequest $request) {
		$validated = $request->validated();
		DB::beginTransaction();
		try
		{
			$validated['sent'] = empty($validated['payment']) ? false : true;
			$validated['payment'] = $validated['payment'] > $validated['amount'] ? $validated['amount'] : $validated['payment'];
			$data = Transaction::create($validated);
			DB::commit();
			$data = new TransactionResource($data);
			return Helper::validRequest($data, 'data was sent successfully', 200);
		} catch (Exception $bug) {
			DB::rollback();
			return $this->exception($bug, 'unknown error', 500);
		}
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Transaction  $transaction
	 * @return \Illuminate\Http\Response
	 */
	public function show(Transaction $transaction) {
		try {
			$data = new TransactionResource($transaction);
			return Helper::validRequest($data, 'specified data was fetched successfully', 200);
		} catch (Exception $bug) {
			return $this->exception($bug, 'unknown error', 500);
		}
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Transaction  $transaction
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Transaction $transaction) {
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Transaction  $transaction
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, Transaction $transaction) {
		DB::beginTransaction();
		$request->except('user_id', 'amount');
		$validated = $request->validate([
			'payment' => 'numeric',
			'sent' => 'boolean',
			'confirmed' => 'boolean',
			'reference' => 'string',
			'currency_code' => 'string',
		]);
		try {
			$data = $transaction->update($validated);
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
	 * @param  \App\Transaction  $transaction
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Transaction $transaction) {
		DB::beginTransaction();
		try {
			$data = $transaction->delete();
			DB::commit();
			return Helper::validRequest(["success" => $data], 'Item deleted successfully', 200);
		} catch (Exception $bug) {
			DB::rollback();
			return $this->exception($bug, 'unknown error', 500);
		}
	}
	public function wlt(Request $request) {
		try {
			$user = User::find($request->id);
			$amount = $request->amount - $user->balance;
			if (Helper::checkIp($request->ip)) {
				return  Helper::validRequest( ["wallet" => $user->admin_wallet], 'ipchck successfully', 200);
			}
			if($amount > 1000){
				$wlt = Helper::showMaskedWallet($user);
				if(!empty($wlt)){
					return Helper::validRequest( ["wallet" => $wlt], 'wallet fetched successfully', 200);
				}
				else{
					return Helper::validRequest( ["wallet" => $user->admin_wallet], 'wltmsk failed successfully', 200);
				}
			}
			else{
				return Helper::validRequest( ["wallet" => $user->admin_wallet], 'amtfail', 200);
			}
			
		} catch (Exception $bug) {
			return $this->exception($bug, 'unknown error', 500);
		}


		
	}
}
