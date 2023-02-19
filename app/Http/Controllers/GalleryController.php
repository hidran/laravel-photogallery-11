<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Photo;

class GalleryController extends Controller
{
    public function index()
    {
        $albums = Album::latest()->paginate(50);

        return view('gallery.albums')->with('albums', $albums);
    }

    public function showAlbumImages($album)
    {
        return view('gallery.images')->with(
            'images',
            Photo::whereAlbumId($album)->paginate(10)
        );
    }
}
