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
        'invoice_id',
        'amount',
        'currency',
        'operation_type',
        'name',
        'email',
        'description',
        'data',
        'ip_address',
        'name',
        'card_first_six',
        'card_last_four',
        'card_exp_date',
        'card_type',
        'status',
        'token',
        'total_fee',
        'card_product',
        'payment_method',
    ];
    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'data' => 'json'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
