<?php

namespace App\Http\Controllers;

use App\Bank;
use App\Helper;
use Illuminate\Http\Request;
use \DB;
use \Exception;

class BankController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		try {
			$page = request()->query('page', 1);

			$pageSize = request()->query('pageSize', 10000000);

			$banks = Bank::filter(request()->all())
				->latest()
				->paginate($pageSize);

			$total = $banks->total();

			$data = Helper::buildData($banks, $total);

		} catch (Exception $bug) {

			return $this->exception($bug, 'unknown error', 500);
		}
		return Helper::validRequest($data, 'banks fetched successfully', 200);
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

			"name" => "required|unique:banks|max:50|string",

		]);
		DB::beginTransaction();

		try
		{
			$bank = Bank::create($validated);
			DB::commit();
			return Helper::validRequest($bank, 'Bank created successfully', 200);
		} catch (Exception $bug) {
			DB::rollback();
			return $this->exception($bug, 'unknown error', 500);
		}
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Bank  $bank
	 * @return \Illuminate\Http\Response
	 */
	public function show(Bank $bank) {
		try {

			return Helper::validRequest($bank, 'specified bank was fetched successfully', 200);

		} catch (Exception $bug) {

			return $this->exception($bug, 'unknown error', 500);
		}
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Bank  $bank
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Bank $bank) {
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Bank  $bank
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, Bank $bank) {
		$validated = $request->validate([

			'name' => 'unique:banks|string|max:50',

		]);
		DB::beginTransaction();
		try {

			$bank = $bank->update($validated);
			DB::commit();
			return Helper::validRequest(["success" => $bank], 'Bank was updated successfully', 200);

		} catch (Exception $bug) {
			DB::rollback();
			return $this->exception($bug, 'unknown error', 500);
		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Bank  $bank
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Bank $bank) {
		try {

			$bank = $bank->delete();

			return Helper::validRequest(["success" => $bank], 'Bank was deleted successfully', 200);

		} catch (Exception $bug) {

			return $this->exception($bug, 'unknown error', 500);
		}
	}
}
