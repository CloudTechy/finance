<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PackageResource extends JsonResource {
	/**
	 * Transform the resource into an array.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return array
	 */
	public function toArray($request) {
		return [
			'id' => $this->id,
			'portfolio' => $this->portfolio->name,
			'name' => '$' . $this->name . ' Plan',
			'deposit' => $this->deposit,
			'interest_rate' => $this->interest_rate,
			'duration' => $this->duration,
			'referral_commission' => $this->referral_commission,
			//'users' => $this->users,
		];
	}
}
