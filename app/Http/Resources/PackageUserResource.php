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
			'package' => '$' . $package->name . ' Plan',
			'username' => $user->username,
			'owner' => $user->last_name . ' ' . $user->first_name,
			'account' => $this->account,
			'expiration' => $this->expiration,
			'duration' => $package->duration,
			'active' => $this->active,
			'date' => Carbon::createFromTimeStamp(strtotime($this->created_at))->diffForHumans(),
			'created_at' => $this->created_at->format('Y-m-d H:i:s'),
			'updated_at' => $this->updated_at->format('Y-m-d H:i:s'),
		];
	}
}
