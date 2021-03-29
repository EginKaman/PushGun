<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EmailMessageResource extends JsonResource
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
            'preheader' => $this->preheader,
            'image' => $this->image,
            'email_mailings' => new EmailMailingsResource($this->whenLoaded('emailMailings')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
