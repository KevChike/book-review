<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource
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
            'isbn' => $this->isbn,
            'title' => $this->title,
            'author' => $this->author,
            'edition' => $this->edition,
            'summary' => $this->summary,
            'publication_year' => $this->publication_year,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
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
