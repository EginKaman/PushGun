<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EmailMailingResource extends JsonResource
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
            'email_message_id' => $this->email_message_id,
            'email_message' => new EmailMessageResource($this->whenLoaded('emailMessage')),
            'address_book_id' => $this->address_book_id,
            'address_book' => new AddressBookResource($this->whenLoaded('addressBook')),
            'subject' => $this->subject,
            'sender_name' => $this->sender_name,
            'date_send' => $this->date_send,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
