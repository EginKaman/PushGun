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
}
