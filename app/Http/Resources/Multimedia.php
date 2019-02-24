<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Multimedia extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return asset(Storage::url($$this->path));
    }

}
