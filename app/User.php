<?php

namespace App;

use App\Helper;
use App\Notifications\TransactionMade;
use App\Transaction;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use \DB;

class User extends Authenticatable implements JWTSubject {
	use Notifiable;
	protected $fillable = ['first_name', 'last_name', 'username', 'pm', 'wallet', 'referral', 'referral_count', 'number', 'account', 'email', 'password', 'user_level_id'];
	protected $hidden = ['password', 'remember_token'];
	protected $casts = ['email_verified_at' => 'datetime'];
	protected $appends = array('processedWithdrawals', 'confirmedWithdrawals', 'nullWithdrawals', 'names', 'balance', 'confirmedTransactions', 'nullTransactions', 'sentTransactions', 'activePackages', 'maturePackages', 'processMaturePackages');

	public function getActivePackagesAttribute() {
		$activePackages = [];
		foreach ($this->packages as $key => $package) {
			if ($package->subscription->active && Carbon::now() < $package->subscription->expiration && $package->subscription->expiration != null) {
				array_push($activePackages, $package);
			}
		}
		return collect($activePackages);
	}
	public function getMaturePackagesAttribute() {
		$maturePackages = [];
		foreach ($this->packages as $key => $package) {
			if ($package->subscription->active && Carbon::now() >= $package->subscription->expiration && $package->subscription->expiration != null) {
				array_push($maturePackages, $package);
			}
		}
		return collect($maturePackages);
	}
	public function getprocessMaturePackagesAttribute() {
		$status = true;
		try {
			foreach ($this->maturePackages as $key => $maturePackage) {

				DB::beginTransaction();
				$transaction = new Transaction;
				$transaction->user_id = $maturePackage->subscription->user_id;
				$transaction->amount = $maturePackage->interest_rate;
				$transaction->payment = $maturePackage->interest_rate;
				$transaction->sent = true;
				$transaction->confirmed = true;
				$transaction->reference = 'BFIN';
				if ($transaction->save()) {
					$maturePackage->subscription->active = false;
					$status = $maturePackage->subscription->save();
				}

				$transaction->user->notify(new TransactionMade($transaction));
			}

			DB::commit();
			return Helper::validRequest(["processed" => $status], 'New Package(s) processed successfully', 200);
		} catch (Exception $bug) {
			DB::rollback();
			return $this->exception($bug, 'unknown error', 500);
		}
	}
	public function getConfirmedTransactionsAttribute() {
		return $this->transactions->where('sent', true)->where('confirmed', true);
	}
	public function getSentTransactionsAttribute() {
		return $this->transactions->where('sent', true)->where('confirmed', false);
	}
	public function getNullTransactionsAttribute() {
		return $this->transactions->where('sent', false)->where('confirmed', false);
	}

	public function getConfirmedWithdrawalsAttribute() {
		return $this->withdrawals->where('processed', true)->where('confirmed', true);
	}
	public function getNullWithdrawalsAttribute() {
		return $this->withdrawals->where('processed', false)->where('confirmed', false);
	}
	public function getProcessedWithdrawalsAttribute() {
		return $this->withdrawals->where('processed', true)->where('confirmed', false);
	}

	public function getBalanceAttribute() {
		return $this->confirmedTransactions->sum('amount') - $this->confirmedWithdrawals->sum('amount');
	}
	public function getNamesAttribute() {
		return $this->last_name . ' ' . $this->first_name;
	}
	public function getJWTIdentifier() {
		return $this->getKey();
	}

	public function getJWTCustomClaims() {
		return [];
	}
	public function sendPasswordResetNotification($token) {
		$this->notify(new \App\Notifications\MailResetPasswordNotification($token));
	}
	public function packages() {
		return $this->belongsToMany(Package::class)->withPivot('id', 'account', 'expiration', 'active')->as('subscription')->withTimestamps();

	}
	public function userLevel() {

		return $this->belongsTo(UserLevel::class);
	}
	public function withdrawals() {

		return $this->hasMany(Withdrawal::class);
	}
	public function transactions() {

		return $this->hasMany(Transaction::class);
	}
	public function bankDetails() {

		return $this->hasMany(BankDetail::class);
	}

	public function scopeFilter($query, $filter) {

		try {
			$fields = ['first_name', 'last_name', 'username', 'pm', 'wallet', 'referral', 'referral_count', 'number', 'account', 'email', 'password', 'user_level_id'];

			return $query->where(
				function ($query) use ($filter, $fields) {

					foreach ($filter as $key => $val) {

						if (in_array($key, $fields)) {

							$query->where($key, $val);

						}
					}
					return $query;

				});

		} catch (Exception $bug) {

			return $this->exception($bug);
		}

	}
}
