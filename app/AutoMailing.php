<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
class AutoMailing extends Model
{
    //
    protected $fillable = [
        'monday',
        'tuesday',
        'wednesday',
        'thursday',
        'friday',
        'saturday',
        'sunday',
        'time',
        'push'
    ];
    protected $casts = [
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
        return $this->belongsTo(Push::class);
    }
}
