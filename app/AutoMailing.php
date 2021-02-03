<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class AutoMailing extends Model
{
    protected $attributes = [
        'monday' => 0,
        'tuesday' => 0,
        'wednesday' => 0,
        'thursday' => 0,
        'friday' => 0,
        'saturday' => 0,
        'sunday' => 0,
        'series'=>0
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
        "name",
        'series',
        'status_id'
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
        'sunday' => 'boolean',
        'series' => 'integer'
    ];
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo 
    {
        return $this->belongsTo(User::class);
    }
    /**
         * @return Illuminate\Database\Eloquent\Relations\BelongsTo 
     */
    public function status(): \Illuminate\Database\Eloquent\Relations\BelongsTo 
    {
        return $this->belongsTo(AutoMailingStatuses::class, 'status_id', 'id');
    }
    /**
         * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function pushes(): \Illuminate\Database\Eloquent\Relations\belongsToMany
    {
        return $this->belongsToMany(Push::class, 'auto_mailing_push', 'auto_mailing_id', 'push_id');
    }
     /**
         * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function sites(): \Illuminate\Database\Eloquent\Relations\belongsToMany
    {
        return $this->belongsToMany(Site::class);
    }
    /**
     * @return integer
     */
    public function getNumberSentPush() {
        $pushes = $this->pushes()->get();
        $count = 0;
        foreach($pushes as $push) {
            $count += $push->sent;
        }
        $this->countSentPushes = $count;
    }
    // public function destroy($id) {
    //     $user = Auth::user();
    //     $user->automailings()->where('id', $id)->delete();
    //     return 1;
    // }
}