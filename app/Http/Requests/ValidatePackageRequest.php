<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidatePackageRequest extends FormRequest {
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
			'portfolio_id' => 'required|numeric|exists:portfolios,id',
			'interest_rate' => 'required|numeric',
			'deposit' => 'required|numeric',
			'duration' => 'required|numeric',
			'name' => 'required|string|min:2|max:255|unique:packages,name,portfolio_id',
		];
	}
}
