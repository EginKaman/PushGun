<?php

namespace App;

use App\Site;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use jeremykenedy\LaravelRoles\Traits\HasRoleAndPermission;
use NotificationChannels\WebPush\PushSubscription;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable, SoftDeletes, HasRoleAndPermission;

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
        'referrer_id',
        'referral_token',
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
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['referral_link'];
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
     * Get all of the emailSenders for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function emailSenders(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(EmailSender::class);
    }

    /**
     * Get all of the emailMailings for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function emailMailings(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(EmailMailing::class);
    }

    /**
     * Get all of the emailMessages for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function emailMessages(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(EmailMessage::class);
    }


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
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function payments(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Payment::class)->latest();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function automailings(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(AutoMailing::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function payment(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Payment::class)->latest();
    }

    /**
     * Get all of the sentLetters for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function sentLetters(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(SentLetter::class);
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

    /**
     * Get all of the addressbooks for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function addressBooks(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(AddressBook::class);
    }


    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }

    /**
     * A user has a referrer.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function referrer()
    {
        return $this->belongsTo(User::class, 'referrer_id', 'id');
    }
    /**
     * A user has many referrals.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function referrals()
    {
        return $this->hasMany(User::class, 'referrer_id', 'id');
    }
    /**
     * Get the user's referral link.
     *
     * @return string
     */
    public function getReferralLinkAttribute()
    {
        return $this->referral_link = route('index', ['ref' => $this->referral_token]);
    }
}
