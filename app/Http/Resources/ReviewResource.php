<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ReviewResource extends JsonResource
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
            'book_id' => $this->book_id,
            'user_id' => $this->user_id,
            'rating' => $this->rating,
            'content' => $this->content,
        ];
    }

    public function with($request) 
    {
        return [
            'status' => 'success',
            'code' => request()->method() == 'GET' ? 200 : 201,
            'title' => request()->method() == 'GET' ? 'OK' : 'Created',
            'message' => request()->method() == 'GET' ? 'Done successfully' : 'Created successfully',
            'method' => request()->method(),
            'url' => request()->fullUrl(),
        ];
    }
}
