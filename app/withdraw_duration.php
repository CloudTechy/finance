<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class withdraw_duration extends Model
{


	protected $fillable = ['duration', 'expiration', 'user_id'];
    public function user() {

		return $this->belongsTo(User::class);
	}

    public function scopeFilter($query, $filter) {

		try {

			$fields = ['duration', 'expiration', 'user_id'];

			return $query->where(
				function ($query) use ($filter, $fields) {

					foreach ($filter as $key => $val) {

						if (in_array($key, $fields)) {

							if ($key == 'dateBefore') {
								$val = Carbon::parse($val);
								$query->where("created_at", "<=", $val);
								continue;
							} elseif ($key == 'dateAfter') {
								$val = Carbon::parse($val);
								$query->where("created_at", ">=", $val);
								continue;
							}

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
