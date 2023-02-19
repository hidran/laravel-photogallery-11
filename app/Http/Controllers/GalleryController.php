<?php

namespace App\Http\Controllers;

use App\Models\Album;

class GalleryController extends Controller
{
    public function index()
    {
        $albums = Album::latest()->paginate(50);

        return view('gallery.albums')->with('albums', $albums);
    }
}
