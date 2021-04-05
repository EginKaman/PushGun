<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = [
        'address',
        'is_email',
        'address_book_id'
    ];
    /**
     * Get the addressbook that owns the Contact
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function addressBook(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(AddressBook::class, 'address_book_id', 'id');
    }
}
