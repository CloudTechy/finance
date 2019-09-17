<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Package extends Model {
	public $timestamps = false;
	protected $fillable = ['portfolio_id', 'name', 'interest_rate', 'deposit', 'duration', 'referral_commission'];

	public function portfolio() {
		return $this->belongsTo(portfolio::class);
	}
	public function users() {
		return $this->belongsToMany(User::class)->withPivot('id', 'transaction_id', 'account', 'expiration', 'active')->as('subscription')->withTimestamps();

	}

	public function scopeFilter($query, $filter) {

		try {
			$fields = ['portfolio_id', 'name', 'interest_rate', 'deposit', 'duration', 'referral_commission'];

			return $query->where(
				function ($query) use ($filter, $fields) {

					foreach ($filter as $key => $val) {

						if (in_array($key, $fields)) {

							$query->where($key, $val);

						}
					}
					// dd($query->toSql());
					return $query;

				});

		} catch (Exception $bug) {

			return $this->exception($bug);
		}

	}

}
