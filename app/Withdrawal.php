<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Withdrawal extends Model
{
    protected $fillable = ['user_id', 'pop', 'amount', 'processed', 'confirmed', 'currency_code'];
    protected $appends = array('processedWithdrawals', 'confirmedWithdrawals', 'nullWithdrawals');

    public function getConfirmedWithdrawalsAttribute()
    {
        return $this->where('processed', true)->where('confirmed', true);
    }
    public function getNullWithdrawalsAttribute()
    {
        return $this->where('processed', false)->where('confirmed', false);
    }
    public function getProcessedWithdrawalsAttribute()
    {
        return $this->where('processed', true)->where('confirmed', false);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function scopeFilter($query, $filter)
    {

        try {

            $fields = ['user_id', 'amount', 'processed', 'confirmed', 'currency_code'];

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
