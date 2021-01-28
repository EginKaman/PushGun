<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Collection;
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
        'request',
        'visit',
        'delay',
        'mobile',
        'hint',
        'script',
    ];


    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'installed' => 'bool',
        'mobile' => 'bool'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function transitions()
    {
        $transitions = [];
        $pushes = $this->pushes()->with('transitions')->get();
        foreach($pushes as $push) {
            foreach($push->transitions as $transition) {
                array_push($transitions, $transition);
            }
        }
        return collect($transitions);
       /**
         * 
         */
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function todayTransitions(): \Illuminate\Database\Eloquent\Relations\HasManyThrough
    {
        return $this->transitions()->whereBetween('transitions.created_at', [
            now()->startOfDay(),
            now()->endOfDay()
        ]);
    }
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function pushes(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Push::class);
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
