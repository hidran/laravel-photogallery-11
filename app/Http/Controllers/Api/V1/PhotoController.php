<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\PhotoResource;
use App\Models\Photo;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class PhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): ResourceCollection
    {
        return PhotoResource::collection(Photo::paginate());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Photo $photo): PhotoResource
    {
        return new PhotoResource($photo);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Photo $photo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Photo $photo)
    {
        //
    }
}
