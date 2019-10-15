<?php

namespace App\Http\Resources;

use App\Package;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class PackageUserResource extends JsonResource {
	/**
	 * Transform the resource into an array.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return array
	 */
	public function toArray($request) {
		$user = User::find($this->user_id);
		$package = Package::find($this->package_id);
		return [
			'id' => $this->id,
			'package' => '$' . $package->name . ' Plan',
			'username' => $user->username,
			'portfolio' => $package->portfolio->name,
			'owner' => $user->last_name . ' ' . $user->first_name,
			'account' => $this->account,
			'expiration' => $this->expiration,
			'duration' => $package->duration,
			'interest' => $package->interest_rate,
			'expired' => !empty($this->expiration) && $this->active == false ? true : false,
			'active' => $this->active,
			'unsubscribed' => empty($this->expiration) && $this->active == false ? true : false,
			'transaction' => isset($this->transaction) ? $this->transaction : null,
			'date' => Carbon::createFromTimeStamp(strtotime($this->created_at))->diffForHumans(),
			'created_at' => $this->created_at->format('Y-m-d H:i:s'),
			'updated_at' => $this->updated_at->format('Y-m-d H:i:s'),
		];
	}
}
