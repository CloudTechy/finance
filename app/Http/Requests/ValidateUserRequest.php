<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidateUserRequest extends FormRequest {
	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize() {
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules() {
		return [
			'first_name' => 'required|min:2|string|max:255',
			'last_name' => 'required|min:2|string|max:255',
			'username' => 'required|min:2|string|max:255|unique:users,username',
			'wallet' => 'nullable|string',
			'pm' => 'nullable|string',
			"number" => "required|nullable|string|min:5|max:255|unique:users,number",
			"email" => "email|required|unique:users,email",
			'password' => 'required|string|min:5',
			'user_level_id' => 'required|numeric|exists:user_levels,id',
		];
	}
}
