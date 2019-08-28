<?php

namespace App\Http\Resources;

use Carbon\Carbon;
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
        $this->processMaturePackages;
        return [
            'id' => $this->id,
            'username' => $this->username,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'number' => $this->number,
            'email' => $this->email,
            'wallet' => $this->wallet,
            'pm' => $this->pm,
            'referral' => $this->referral,
            'referral_count' => $this->referral_count,
            'account' => $this->balance,
            'bank_details' => $this->bankDetails,
            'user_level' => $this->userLevel->name,
            'packages' => $this->activePackages,
            'transactions' => $this->confirmedTransactions,
            'withdrawals' => $this->confirmedWithdrawals,
            'date' => Carbon::createFromTimeStamp(strtotime($this->created_at))->diffForHumans(),
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at->format('Y-m-d H:i:s'),

        ];
    }
}
