<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmailMailing extends Model
{
    protected $fillable = [
        'subject',
        'date_send',
        'is_sent'

    ];

    protected $casts = [
        'date_send' => 'datetime'
    ];
    /**
     * Get the user that owns the EmailMailing
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the addressbook that owns the Contact
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function addressBook(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(AddressBook::class, 'address_book_id', 'id');
    }

    /**
     * Get the emailMessage that owns the EmailMailing
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function emailMessage(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(EmailMessage::class, 'email_message_id', 'id');
    }

    /**
     * Get the emailSender that owns the EmailMailing
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function emailSender(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(EmailSender::class, 'email_sender_id', 'id');
    }
}
