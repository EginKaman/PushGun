<?php

namespace App\ModelFilters;

use EloquentFilter\ModelFilter;

class AddressBookFilter extends ModelFilter
{
    /**
     * Related Models that have ModelFilters as well as the method on the ModelFilter
     * As [relationMethod => [input_key1, input_key2]].
     *
     * @var array
     */
    public $relations = [];

    public function sort($sort): AddressBookFilter
    {
        switch ($sort) {
            case 'date_decreasing':
                return $this->orderByDesc('created_at');
                break;
            case 'date_ascending':
                return $this->orderBy('created_at', 'asc');
                break;
            case 'quantity_decreasing':
                return $this->withCount('contacts')->orderByDesc('contacts_count');
                break;
            case 'quantity_ascending':
                return $this->withCount('contacts')->orderBy('contacts_count', 'asc');
                break;
        }
        return $this;
    }

    public function name($name): AddressBookFilter
    {
        return $this->where('name', 'like', "%{$name}%");
    }
}
