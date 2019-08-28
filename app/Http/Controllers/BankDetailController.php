<?php

namespace App\Http\Controllers;

use App\BankDetail;
use App\Helper;
use Illuminate\Http\Request;
use \DB;
use \Exception;

class BankDetailController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		try {
			$page = request()->query('page', 1);

			$pageSize = request()->query('pageSize', 10000000);

			$bankDetails = BankDetail::filter(request()->all())
				->latest()
				->paginate($pageSize);

			$total = $bankDetails->total();

			$data = Helper::buildData($bankDetails, $total);

		} catch (Exception $bug) {

			return $this->exception($bug, 'unknown error', 500);
		}
		return Helper::validRequest($data, 'bankDetails fetched successfully', 200);
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
	public function store(Request $request) {
		$validated = $request->validate([

			"bank_id" => "required|max:50|numeric|exists:banks,id",
			"acc_name" => "required|string|min:4",
			"acc_number" => "required|numeric|min:10",
			"user_id" => "required|numeric|min:1|exists:users,id",
			'swift_code' => 'nullable|string',

		]);
		DB::beginTransaction();

		try
		{
			$bankdetail = BankDetail::create($validated);

			DB::commit();

		} catch (Exception $bug) {
			DB::rollback();
			return $this->exception($bug, 'unknown error', 500);
		}

		return Helper::validRequest($bankdetail, 'BankDetail was sent successfully', 200);

	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\BankDetail  $bankDetail
	 * @return \Illuminate\Http\Response
	 */
	public function show(BankDetail $bankDetail) {
		try {

			return Helper::validRequest($bankdetail, 'specified BankDetail was fetched successfully', 200);

		} catch (Exception $bug) {

			return $this->exception($bug, 'unknown error', 500);
		}
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\BankDetail  $bankDetail
	 * @return \Illuminate\Http\Response
	 */
	public function edit(BankDetail $bankDetail) {
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\BankDetail  $bankDetail
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, BankDetail $bankDetail) {
		$validated = $request->validate([
			"bank" => "max:50|string",
			"acc_name" => "string|min:4",
			"acc_number" => "numeric|min:10",
			"swift_code" => "string",
		]);
		DB::beginTransaction();
		try {
			$bankdetail = $bankdetail->update($validated);
			DB::commit();
			return Helper::validRequest(["success" => $bankdetail], 'BankDetail was updated successfully', 200);
		} catch (Exception $bug) {
			DB::rollback();
			return $this->exception($bug, 'unknown error', 500);
		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\BankDetail  $bankDetail
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(BankDetail $bankDetail) {
		DB::beginTransaction();
		try {
			$bankdetail = $bankdetail->delete();
			DB::commit();
			return Helper::validRequest(["success" => $bankdetail], 'BankDetail was deleted successfully', 200);
		} catch (Exception $bug) {
			DB::rollback();
			return $this->exception($bug, 'unknown error', 500);
		}
	}
}
