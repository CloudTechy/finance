<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bank extends Model {
	public $timestamps = false;
	protected $fillable = ['name'];

	public function bankDetails() {

		return $this->hasMany(BankDetail::class);
	}
}
