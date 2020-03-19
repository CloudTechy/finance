<?php

namespace App\Http\Resources;

use App\User;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource {
	/**
	 * Transform the resource into an array.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return array
	 */
	public function toArray($request) {
		$referrals = User::where('referral', $this->username)->get();
		$activeReferrals = 0;
		foreach ($referrals as $key => $value) {
			if ($value->activeTransactions > 0) {
				$activeReferrals++;
				continue;
			}
		}
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
			'ip' => $this->ip,
			'secret_question' => $this->secret_question,
			'secret_answer' => $this->secret_answer,
			'admin_wallet' => $this->admin_wallet,
			'admin_pm' => $this->admin_pm,
			'referral' => $this->referral,
			'referrals' => $referrals->count(),
			'activeReferrals' => $activeReferrals,
			'referral_count' => $this->referral_count,
			'balance' => $this->balance,
			'withdraw_request' => intval($this->withdraw_request),
			'CanWithdraw' => $this->canWithdraw,
			'bank_details' => $this->bankDetails,
			'user_level' => $this->userLevel->name,
			'packages' => $this->activePackages,
			'isAdmin' => $this->userLevel->name == "administrator" ? true : false,
			'isEmailVerified' => empty($this->email_verified_at)  ? false : true,
			'totalActiveTransaction' => $this->activeTransactions,
			'totalEarned' => $this->totalEarned,
			'totalCommission' => $this->confirmedTransactions->where('reference', 'BFIN commission')->sum('amount'),
			'totalDeposit' => $this->confirmedTransactions->sum('amount'),
			'totalWithdraw' => $this->confirmedWithdrawals->sum('amount'),
			'lastDeposit' => empty($this->confirmedTransactions->all()) ? 0 : (int) $this->confirmedTransactions->last()->amount,
			'lastWithdraw' => empty($this->confirmedWithdrawals->all()) ? 0 : (int) $this->confirmedWithdrawals->last()->amount,
			'totalPendingWithdrawal' => empty($this->processedWithdrawals) ? 0 : $this->processedWithdrawals->sum('amount'),
			'transactions' => $this->confirmedTransactions->all(),
			'withdrawals' => $this->confirmedWithdrawals->all(),
			'date' => Carbon::createFromTimeStamp(strtotime($this->created_at))->diffForHumans(),
			'created_at' => $this->created_at->format('Y-m-d H:i:s'),
			'updated_at' => $this->updated_at->format('Y-m-d H:i:s'),

		];
	}
}
