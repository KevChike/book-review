<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class BookCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        'status' => 'success',
        'code' => 200,
        'title' => 'OK',
        'message' => 'Done successfully',
        'method' => request()->method(),
        'url' => request()->fullUrl(),
        'data' => BookResource::collection($this->collection)
    }
}
