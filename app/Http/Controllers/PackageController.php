<?php

namespace App\Http\Controllers;

use App\Helper;
use App\Http\Requests\ValidatePackageRequest;
use App\Http\Resources\PackageResource;
use App\Package;
use Illuminate\Http\Request;
use \DB;
use \Exception;

class PackageController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		try {
			$page = request()->query('page', 1);
			$pageSize = request()->query('pageSize', 10000000);
			$data = Package::filter(request()->all())
				->orderBy('deposit', 'asc')
				->paginate($pageSize);
			$total = $data->total();
			$data = PackageResource::collection($data);
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
	public function store(ValidatePackageRequest $request) {
		$validated = $request->validated();
		DB::beginTransaction();
		try
		{
			$data = Package::create($validated);
			DB::commit();
			return Helper::validRequest($data, 'data was sent successfully', 200);
		} catch (Exception $bug) {
			DB::rollback();
			return $this->exception($bug, 'unknown error', 500);
		}
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Package  $package
	 * @return \Illuminate\Http\Response
	 */
	public function show(Package $package) {
		try {
			$package = new PackageResource($package);
			return Helper::validRequest($package, 'specified Package was fetched successfully', 200);
		} catch (Exception $bug) {
			return $this->exception($bug, 'unknown error', 500);
		}
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Package  $package
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Package $package) {
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Package  $package
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, Package $package) {
		DB::beginTransaction();
		$validated = $request->validate([
			'portfolio_id' => 'numeric|exists:portfolios,id',
			'interest_rate' => 'numeric',
			'deposit' => 'numeric',
			'duration' => 'numeric',
			'name' => 'string|min:2|max:255|multiple_unique:' . Package::class . ',name,portfolio_id',
			'referral_commission' => 'numeric',
		]);
		try {
			$data = $package->update($validated);
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
	 * @param  \App\Package  $package
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Package $package) {
		DB::beginTransaction();
		try {
			$data = $package->delete();
			DB::commit();
			return Helper::validRequest(["success" => $data], 'Item deleted successfully', 200);
		} catch (Exception $bug) {
			DB::rollback();
			return $this->exception($bug, 'unknown error', 500);
		}
	}
}
