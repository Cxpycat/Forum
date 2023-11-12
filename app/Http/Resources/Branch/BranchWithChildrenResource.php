<?php

namespace App\Http\Resources\Branch;

use Illuminate\Http\Request;
use App\Http\Resources\Theme\ThemeResource;
use Illuminate\Http\Resources\Json\JsonResource;

class BranchWithChildrenResource extends JsonResource
{

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray (Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'section_id' => $this->section_id,
            'parent_id' => $this->parent_id,
            'children' => BranchResource::collection($this->children)->resolve(),
            'themes' => ThemeResource::collection($this->themes)->resolve(),

        ];
    }

}
