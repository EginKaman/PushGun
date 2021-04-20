<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SmsMessageResource extends JsonResource
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
            'sms_sender_id' => $this->sms_sender_id,
            'sms_sender' => new SmsSenderResource($this->whenLoaded('sender')),
            'address_book_id' => $this->address_book_id,
            'address_book' => new AddressBookResource($this->whenLoaded('addressbook')),
            'text' => $this->text,
            'is_sent' => $this->is_sent,
            'date_send' => $this->date_send,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
