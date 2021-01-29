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
        'link',
        'delay',
        'prev_push_id'
    ];

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Legacy relationship for backward compatibility
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function site(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Site::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function sites(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Site::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\belongsToMany
     */
    public function autoMailings(): \Illuminate\Database\Eloquent\Relations\belongsToMany
    {
        return $this->belongsToMany(AutoMailing::class, 'auto_mailing_push', 'push_id', 'automailing_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function transitions(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Transition::class);
    }
    /**
         * @return
     */
    public function time() {
        return $this->belongsTo(Time::class);
    }
}
