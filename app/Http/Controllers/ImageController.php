<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\Image\ImageResource;
use App\Http\Requests\Image\StoreImageRequest;
use App\Http\Requests\Image\UpdateImageRequest;

class ImageController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index ()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create ()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store (StoreImageRequest $request)
    {
        $data = $request->validated();

        $path = Storage::disk('public')->put('/images', $data['image']);

        $image = Image::create([
            'path' => $path,
            'user_id' => auth()->id(),
        ]);

        return ImageResource::make($image)->resolve();
    }

    /**
     * Display the specified resource.
     */
    public function show (Image $image)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit (Image $image)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update (UpdateImageRequest $request, Image $image)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy (Image $image)
    {
        //
    }

}
