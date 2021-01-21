<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AutoMailing extends Model
{
    protected $attributes = [
        'monday' => 0,
        'tuesday' => 0,
        'wednesday' => 0,
        'thursday' => 0,
        'friday' => 0,
        'saturday' => 0,
        'sunday' => 0
    ];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'monday',
        'tuesday',
        'wednesday',
        'thursday',
        'friday',
        'saturday',
        'sunday',
        'time',
        "name"
    ];
    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'name' => "string",
        'monday' => 'boolean',
        'tuesday' => 'boolean',
        'wednesday' => 'boolean',
        'thursday' => 'boolean',
        'friday' => 'boolean',
        'saturday' => 'boolean',
        'sunday' => 'boolean'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function push(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Push::class, 'push_id','id');
    }
}
