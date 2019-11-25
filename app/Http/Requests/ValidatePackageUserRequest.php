<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidatePackageUserRequest extends FormRequest {
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
			'user_id' => 'required|numeric|exists:users,id',
			'package_id' => 'required|numeric|exists:packages,id',
			'pop' => 'mimes:jpeg,png,bmp,tiff |max:4096',
		];
	}
}
