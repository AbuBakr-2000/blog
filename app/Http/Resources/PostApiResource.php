<?php

namespace App\Http\Resources;

use App\Http\Resources\Tag\TagApiResource;
use App\Http\Resources\User\UserApiResource;
use Illuminate\Http\Resources\Json\JsonResource;

class PostApiResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'=> $this->id,
            'user' => new UserApiResource($this->user),
            'title'=>$this->title,
            'short_content' => $this->short_content,
            'tags' => TagApiResource::collection($this->tags),
            'category' => $this->category->name,
        ];
    }
}
