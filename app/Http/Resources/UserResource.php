<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'username' => $this->username,
            'names' => $this->first_name . ' ' . $this->last_name,
            // 'number' => $this->number,
            'email' => $this->email,
            // 'address' => $this->address,
            // 'activated' => $this->activated,
            // 'user_level' => $this->userLevel->name,
            // 'date' => Carbon::createFromTimeStamp(strtotime($this->created_at))->diffForHumans(),

        ];
    }
}
