<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TariffEmailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'price_per_month' => $this->price_per_month,
            'price_per_year' => $this->price_per_year,
            'max_contacts' => $this->max_contacts
        ];
    }
}
