<?php

namespace App\Http\Controllers;

use App\Helper;
use App\Http\Resources\PortfolioResource;
use App\Portfolio;
use Illuminate\Http\Request;
use \DB;
use \Exception;

class PortfolioController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		try {
			$page = request()->query('page', 1);
			$pageSize = request()->query('pageSize', 10000000);
			$data = Portfolio::filter(request()->all())
				->latest()
				->paginate($pageSize);
			$total = $data->total();
			$data = PortfolioResource::collection($data);
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
			"name" => "required|unique:banks|max:50|string",
		]);
		DB::beginTransaction();
		try
		{
			$data = Portfolio::create($validated);
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
	 * @param  \App\Portfolio  $portfolio
	 * @return \Illuminate\Http\Response
	 */
	public function show(Portfolio $portfolio) {
		try {
			$data = new PortfolioResource($portfolio);
			return Helper::validRequest($data, 'specified data was fetched successfully', 200);
		} catch (Exception $bug) {
			return $this->exception($bug, 'unknown error', 500);
		}
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Portfolio  $portfolio
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Portfolio $portfolio) {
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Portfolio  $portfolio
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, Portfolio $portfolio) {
		DB::beginTransaction();
		$validated = $request->validate([
			'name' => 'string|min:2|max:255',
		]);
		try {
			$data = $portfolio->update($validated);
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
	 * @param  \App\Portfolio  $portfolio
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Portfolio $portfolio) {
		DB::beginTransaction();
		try {
			$data = $portfolio->delete();
			DB::commit();
			return Helper::validRequest(["success" => $data], 'Item deleted successfully', 200);
		} catch (Exception $bug) {
			DB::rollback();
			return $this->exception($bug, 'unknown error', 500);
		}
	}
}
