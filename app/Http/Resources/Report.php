<?php

namespace App\Http\Resources;
use Illuminate\Http\Resources\Json\JsonResource;
// use App\Http\Resources\Supplier as SupplierResource;

class Report extends JsonResource
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
            'title' => $this->title,
            'body' => $this->body,
            'updated_at' => $this->title,
            'created_at' => $this->title,

            'author' => User($this->author_id),
            'tags' => Tag::collection($this->tags()),
            'attachment' => Multimedia::collection($this->multimedia()),
            'group' => Group($this->group()),
        ];
    }
}
