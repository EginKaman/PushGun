<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Push extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'icon',
        'image',
        'text',
        'link'
    ];

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function site(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Site::class);
    }
    public function autoMailings(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(AutoMailing::class);
    }
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function transitions(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Transition::class);
    }
}
