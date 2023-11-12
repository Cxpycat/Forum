<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\User\UserResource;
use App\Http\Requests\User\UpdateAvatarRequest;

class UserController extends Controller
{

    public function personal ()
    {
        $user = UserResource::make(auth()->user())->resolve();
        return Inertia::render('User/Personal', compact('user'));
    }

    public function updateAvatar (UpdateAvatarRequest $request)
    {
        $data = $request->validated();

        if (auth()->user()->avatar) {
            Storage::disk('public')->delete(auth()->user()->avatar);
        }

        $path = Storage::disk('public')->put('/avatars', $data['avatar']);

        auth()->user()->update([
            'avatar' => $path,
        ]);
        $path = Image::make('storage/' . $path)->fit(100, 100);
        $path->save();

        return UserResource::make(auth()->user())->resolve();
    }

}
