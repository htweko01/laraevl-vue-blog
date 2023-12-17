<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */

    public static $wrap="post";
    
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'body' => $this->body,
            'image' => $this->image,
            'categories' => $this->categories()->pluck('categories.id'),
            'active' => $this->active != 0,
            'publishedAt' => $this->published_at ? : '',
            'createdBy' => $this->createdBy->name,
            'editedBy' => $this->editedBy->name,
         ];
        // return parent::toArray($request);
    }
}
