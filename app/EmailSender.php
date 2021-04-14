<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmailSender extends Model
{
    protected $fillable = [
        'address',
        'name',
        'domain'
    ];

    /**
     * Get the user that owns the EmailSender
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get all of the emailMailings for the EmailSender
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function emailMailings(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(EmailMailing::class, 'id', 'email_sender_id');
    }
}
