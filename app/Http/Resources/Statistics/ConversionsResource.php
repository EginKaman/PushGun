<?php

namespace App\Http\Resources\Statistics;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ConversionsResource extends ResourceCollection
{
    /**
     * The "data" wrapper that should be applied.
     *
     * @var string
     */
    public static $wrap = 'conversions';

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
