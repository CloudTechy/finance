<?php

namespace App\Http\Resources;

use App\User;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class WithdrawalResource extends JsonResource {
	/**
	 * Transform the resource into an array.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return array
	 */
	public function toArray($request) {
		$user = User::find($this->user_id);
		return [
			'id' => $this->id,
			'username' => $user->username,
			'owner' => $user->last_name . ' ' . $user->first_name,
			'amount' => $this->amount,
			'processed' => $this->processed,
			'confirmed' => $this->confirmed,
			'approved' => $this->confirmed == true && $this->processed == true ? true  : false,
			'pop' => $this->pop,
			'reference' => $this->reference,
			'currency_code' => $this->currency_code,
			'date' => Carbon::createFromTimeStamp(strtotime($this->created_at))->diffForHumans(),
			'created_at' => $this->created_at->format('Y-m-d H:i:s'),
			'updated_at' => $this->updated_at->format('Y-m-d H:i:s'),
		];
	}
}
