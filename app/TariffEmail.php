<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TariffEmail extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'price_per_month',
        'price_per_year',
        'max_contacts'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'price_per_month' => 'integer',
        'price_per_year' => 'integer',
        'max_contacts' => 'integer'
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
