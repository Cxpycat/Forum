<?php

namespace App\Http\Resources\Section;

use Illuminate\Http\Request;
use App\Http\Resources\Branch\ThemeResource;
use App\Http\Resources\Branch\BranchResource;
use Illuminate\Http\Resources\Json\JsonResource;

class SectionWithBranchesResource extends JsonResource
{

    public function toArray (Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'branches' => BranchResource::collection($this->parentBranches)->resolve(),
        ];
    }

}
