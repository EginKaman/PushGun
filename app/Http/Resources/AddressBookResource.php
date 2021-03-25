<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AddressBookResource extends JsonResource
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
            'user_id' => $this->user_id,
            'name' => $this->name,
            'contacts' => new ContactsResource($this->whenLoaded('contacts')),
            'mailsCount' => $this->mailsCount,
            'numbersCount' => $this->numbersCount,
            'contacts_count' => $this->contacts_count,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
