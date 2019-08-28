<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class PortfolioResource extends JsonResource {
	/**
	 * Transform the resource into an array.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return array
	 */
	public function toArray($request) {
		return [
			'name' => $this->name,
			'packages' => $this->packages,
			'date' => Carbon::createFromTimeStamp(strtotime($this->created_at))->diffForHumans(),
		];
	}
}
