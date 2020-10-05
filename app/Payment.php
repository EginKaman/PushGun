<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'transaction_id',
        'amount',
        'currency',
        'currency_code',
        'email',
        'description',
        'json_data',
        'ip_address',
        'name',
        'card_first_six',
        'card_last_four',
        'card_exp_date',
        'card_type',
        'card_type_code',
        'status',
        'status_code',
        'reason',
        'reason_code',
        'card_holder_message'

    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
