<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request) {
        return [
            'id'    => $this->id,
            'title' => $this->title,
            'slug'  => $this->slug,
            'body'  => Str::limit($this->body, 50)
        ];
    }
}
