<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use NotificationChannels\WebPush\HasPushSubscriptions;

class Site extends Model
{
    use SoftDeletes, Notifiable, HasPushSubscriptions;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'link',
        'image',
        'installed',
        'subscription',
        'visit',
        'delay',
        'mobile',
        'hint',
        'script',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pushes(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Push::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function todaySubscriptions(): \Illuminate\Database\Eloquent\Relations\MorphMany
    {
        return $this->pushSubscriptions()->whereBetween('created_at', [
            now()->startOfDay(),
            now()->endOfDay()
        ]);
    }
}
