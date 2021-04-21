<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SmsMessage extends Model
{
    protected $fillable = [
        'date_send',
        'text',
        'sender_name'
    ];

    protected $casts = [
        'date_send' => 'datetime'
    ];

    // /**
    //  * Get the user that owns the SmsMessage
    //  *
    //  * @return BelongsTo
    //  */
    // public function sender(): BelongsTo
    // {
    //     return $this->belongsTo(SmsSender::class, 'sms_sender_id', 'id');
    // }

    /**
     * Get the user that owns the SmsMessage
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get all of the contacts for the SmsMessage
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function contacts(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Contact::class, 'sms_message_id', 'id');
    }

    /**
     * Get the addressbook that owns the SmsMailing
     *
     * @return BelongsTo
     */
    public function addressbook(): BelongsTo
    {
        return $this->belongsTo(AddressBook::class, 'address_book_id', 'id');
    }
}
