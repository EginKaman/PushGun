<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AutoMailingStatuses extends Model
{
     /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title'
    ];
    protected $casts = [
        'title' => 'string'
    ];
    /**
         * 
     */
    public function automailings(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(AutoMailing::class, 'status_id', 'id');
    }
}
