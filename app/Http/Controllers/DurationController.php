<?php

namespace App\Http\Controllers;

use App\Helper;
use App\Http\Resources\DurationResource;
use App\duration;
use Illuminate\Http\Request;
use \DB;
use \Exception;

class DurationController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		try {
			$page = request()->query('page', 1);
			$pageSize = request()->query('pageSize', 10000000);
			$data = duration::filter(request()->all())
				->paginate($pageSize);
			$total = $data->total();
			$data = DurationResource::collection($data);
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
	public function store(Request $request) {
		$validated = $request->validate([
			"duration" => "required|numeric",
		]);
		DB::beginTransaction();
		try
		{
			$data = duration::create($validated);
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
	 * @param  \App\Duration  $duration
	 * @return \Illuminate\Http\Response
	 */
	public function show(duration $duration) {
		try {
			$data = new DurationResource($duration);
			return Helper::validRequest($data, 'specified data was fetched successfully', 200);
		} catch (Exception $bug) {
			return $this->exception($bug, 'unknown error', 500);
		}
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Duration  $duration
	 * @return \Illuminate\Http\Response
	 */
	public function edit(duration $duration) {
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Duration  $duration
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, duration $duration) {
		DB::beginTransaction();
		$validated = $request->validate([
			'duration' => 'numeric',
		]);
		try {
			$data = $duration->update($validated);
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
	 * @param  \App\Duration  $duration
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(duration $duration) {
		DB::beginTransaction();
		try {
			$data = $duration->delete();
			DB::commit();
			return Helper::validRequest(["success" => $data], 'Item deleted successfully', 200);
		} catch (Exception $bug) {
			DB::rollback();
			return $this->exception($bug, 'unknown error', 500);
		}
	}
}
