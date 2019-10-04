<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model {
	protected $fillable = ['name'];

	public function packages() {
		return $this->hasMany(Package::class);
	}
	public function scopeFilter($query, $filter) {

		try {

			$fields = ['name'];

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
