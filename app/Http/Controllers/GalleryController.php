<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Photo;
use Illuminate\Contracts\View\View;

class GalleryController extends Controller
{
    public function index(): View
    {
        $albums = Album::latest()->paginate(50);

        return view('gallery.albums')->with('albums', $albums);
    }

    public function showAlbumImages(Album $album)
    {
        return view('gallery.images', [
                'images' =>
                    Photo::whereAlbumId($album->id)->paginate(10),
                'album' => $album
            ]
        );
    }
}
