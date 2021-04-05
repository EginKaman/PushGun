<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ContactResource extends JsonResource
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
            'address_book_id' => $this->address_book_id,
            'address' => $this->address,
            'is_email' => $this->is_email,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
