<?php

namespace App\Http\Resources\Resource;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
                'attributes'=>[
                    'name'=>$this->name,
                    'username'=>$this->username,
                    'author_pseudonym'=>$this->author_pseudonym,
                    'created_at'=>$this->created_at
                ]
        ];
    }

    public function with($request)
    {
        return [
            'Status' => 'OK'
        ];
    }
}
