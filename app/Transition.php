<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transition extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'ip',
        'user_agent'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function push(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Push::class);
    }
}
