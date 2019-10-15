<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidateTransactionRequest extends FormRequest {
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
			'amount' => 'required|numeric',
			'payment' => 'required|numeric',
			'reference' => 'required|string',
			'pop' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
		];
	}
}
