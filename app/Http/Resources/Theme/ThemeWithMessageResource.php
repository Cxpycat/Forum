<?php

namespace App\Http\Resources\Theme;

use Illuminate\Http\Request;
use App\Http\Resources\Message\MessageResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ThemeWithMessageResource extends JsonResource
{

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray (Request $request): array
    {
        $messageIds = auth()->user()->likedMessages()->get()->pluck('id');

        $this->messages->each(function ($message) use ($messageIds) {
            $message->is_liked = $messageIds->contains($message->id);
        });

        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'messages' => MessageResource::collection($this->messages->load('user'))->resolve(),
        ];
    }

}
