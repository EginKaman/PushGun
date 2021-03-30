<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmailMessage extends Model
{
    protected $fillable = [
        'preheader',
        'image'
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
     * Get all of the emailMailings for the EmailMessage
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function emailMailings(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(EmailMailing::class, 'id', 'email_message_id');
    }
}
