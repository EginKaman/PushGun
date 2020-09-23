<?php

namespace App\Http\Resources\Statistics;

use Illuminate\Http\Resources\Json\ResourceCollection;

class MailsResource extends ResourceCollection
{

    /**
     * The "data" wrapper that should be applied.
     *
     * @var string
     */
    public static $wrap = 'mails';

    /**
     * Transform the resource collection into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return DataResource::collection($this->collection);
    }
}
