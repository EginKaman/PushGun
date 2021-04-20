<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SmsSender extends Model
{
    protected $fillable = [
        'name'
    ];


    /**
     * Get all of the smsMessages for the SmsSender
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function smsMessages(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(SmsMessage::class, 'id', 'sms_sender_id');
    }
}
