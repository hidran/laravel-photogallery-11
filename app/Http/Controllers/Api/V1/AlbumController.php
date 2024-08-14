<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\AlbumResource;
use App\Models\Album;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class AlbumController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): ResourceCollection
    {
        return AlbumResource::collection(Album::paginate());
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
    public function show(Album $album): AlbumResource
    {
        return new AlbumResource($album);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Album $album)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Album $album)
    {
        //
    }
}
