<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAlbumCategoryRequest;
use App\Http\Requests\UpdateAlbumCategoryRequest;
use App\Models\AlbumCategory;

class AlbumCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreAlbumCategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAlbumCategoryRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AlbumCategory  $albumCategory
     * @return \Illuminate\Http\Response
     */
    public function show(AlbumCategory $albumCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AlbumCategory  $albumCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(AlbumCategory $albumCategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAlbumCategoryRequest  $request
     * @param  \App\Models\AlbumCategory  $albumCategory
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAlbumCategoryRequest $request, AlbumCategory $albumCategory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AlbumCategory  $albumCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(AlbumCategory $albumCategory)
    {
        //
    }
}
