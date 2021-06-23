<?php

namespace App\Http\Resources\Resource;

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
            'id'=>(string)$this->id,
                'type'=>'Books',
                'attributes'=>[
                    'title'=>$this->title,
                    'author'=>$this->bookAuthor,
                    'description'=>$this->description,
                    'cover_image'=>$this->cover_image,
                    'price'=>(string)$this->price,
                    'created_at'=>$this->created_at,
                    'updated_at'=>$this->updated_at
                ]
        ];
    }
}
