<?php

namespace App;

use App\Site;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use NotificationChannels\WebPush\PushSubscription;

class User extends Authenticatable
{
    use Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'lastname',
        'phone',
        'email',
        'lang',
        'timezone',
        'country',
        'city',
        'address',
        'postcode',
        'photo',
        'balance',
        'tariff_expired_at',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'tariff_expired_at' => 'datetime',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tariff(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Tariff::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function sites(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Site::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pushes(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Push::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function subscriptions(): \Illuminate\Database\Eloquent\Relations\HasManyThrough
    {
        return $this->hasManyThrough(PushSubscription::class, Site::class, 'id', 'subscribable_id', 'id')
            ->where('subscribable_type', Site::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function todaySubscriptions(): \Illuminate\Database\Eloquent\Relations\HasManyThrough
    {
        return $this->subscriptions()
            ->whereBetween('push_subscriptions.created_at', [
                now()->startOfDay(),
                now()->endOfDay()
            ]);
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }
}
