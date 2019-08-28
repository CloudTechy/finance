<?php

namespace App\Http\Resources;

use App\Package;
use App\PackageUser;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class TransactionResource extends JsonResource {
	/**
	 * Transform the resource into an array.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return array
	 */
	public function toArray($request) {
		$user = User::find($this->user_id);
		$packageUser = PackageUser::find($this->reference);
		$package = $packageUser == null ? null : Package::find($packageUser->package_id);
		return [
			'username' => $user->username,
			'owner' => $user->last_name . ' ' . $user->first_name,
			'amount' => $this->amount,
			'payment' => $this->payment,
			'sent' => $this->sent,
			'confirmed' => $this->confirmed,
			'reference' => $this->reference,
			'package' => $package == null ? null : '$' . $package->name . ' Plan',
			'currency_code' => $this->currency_code,
			'date' => Carbon::createFromTimeStamp(strtotime($this->created_at))->diffForHumans(),
			'created_at' => $this->created_at->format('Y-m-d H:i:s'),
			'updated_at' => $this->updated_at->format('Y-m-d H:i:s'),
		];
	}
}
