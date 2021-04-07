<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SentLetter extends Model
{


    /**
     * Get the contact that owns the SentLetter
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function contact(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Contact::class);
    }

    /**
     * Get the message that owns the SentLetter
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function emailMessage(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(EmailMessage::class, 'email_message_id', 'id');
    }

    /**
     * Get the user that owns the SentLetter
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
