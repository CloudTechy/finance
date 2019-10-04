<?php

namespace App\Http\Controllers;

use App\Helper;
use App\Http\Requests\ValidateUserRequest;
use App\Http\Resources\UserResource;
use App\User;
use Illuminate\Http\Request;
use \DB;
use \Exception;

class UserController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {

		try {
			$page = request()->query('page', 1);
			$pageSize = request()->query('pageSize', 10000000);
			$data = User::filter(request()->all())
				->latest()
				->paginate($pageSize);
			$total = $data->total();
			$data = UserResource::collection($data);
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
	public function store(ValidateUserRequest $request) {
		$validated = $request->validated();
		DB::beginTransaction();
		try
		{
			$validated['password'] = bcrypt($validated['password']);
			$data = User::create($validated);
			$data->sendEmailVerificationNotification();
			DB::commit();
			return Helper::validRequest(new UserResource($data), 'data was sent successfully', 200);
		} catch (Exception $bug) {
			DB::rollback();
			return $this->exception($bug, 'unknown error', 500);
		}
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show(User $user) {
		try {
			$data = new UserResource($user);
			return Helper::validRequest($data, 'specified data was fetched successfully', 200);
		} catch (Exception $bug) {
			return $this->exception($bug, 'unknown error', 500);
		}
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit(User $user) {
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, User $user) {
		DB::beginTransaction();
		$validated = $request->validate([
			'first_name' => 'min:2|string|max:255',
			'last_name' => 'min:2|string|max:255',
			'wallet' => 'nullable|string',
			'pm' => 'nullable|string',
			'admin_wallet' => 'nullable|string',
			'admin_pm' => 'nullable|string',
			"number" => "string|min:5|max:255",
			"email" => "email",
			'password' => 'string|min:5|confirmed',
			'user_level_id' => 'integer',
		]);
		try {
			if (isset($validated['password'])) {
				$validated['password'] = bcrypt($validated['password']);
			}
			$data = $user->update($validated);
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
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(User $user) {
		DB::beginTransaction();
		try {
			$data = $user->delete();
			DB::commit();
			return Helper::validRequest(["success" => $data], 'Item deleted successfully', 200);
		} catch (Exception $bug) {
			DB::rollback();
			return $this->exception($bug, 'unknown error', 500);
		}
	}
}
