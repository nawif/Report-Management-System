<?php

namespace App\Http\Resources;
use Illuminate\Http\Resources\Json\JsonResource;
use App\User;
use App\Http\Resources\User as UserResource;
use App\Http\Resources\Tag as TagResource;
use App\Http\Resources\Multimedia as MultimediaResource;
use App\Http\Resources\Group as GroupResource;



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
            'updated_at' => $this->updated_at->toDateTimeString(),
            'created_at' => $this->created_at->toDateTimeString(),

            'author' =>(new UserResource($this->author()->first()))->toArray($request),
            'tags' => TagResource::collection($this->tags()->get())->toArray($request),
            'multimedia' => MultimediaResource::collection($this->multimedia()->get())->toArray($request),
            // 'group' => new GroupResource($this->group()->first()),
        ];
    }
}
