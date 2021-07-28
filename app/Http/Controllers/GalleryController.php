<?php

namespace App\Http\Controllers;

use App\Models\{Album, Category, Photo};

class GalleryController extends Controller
{
    public function index()
    {
        //  \DB::enableQueryLog();
        $albums = Album::with('categories')->latest()->paginate(50);

        return view('gallery.albums')->with([
            'albums' => $albums,
            'category_id' => null
        ]);
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

    public function showCategoryAlbums(Category $category)
    {
        return view('gallery.albums')->with([
                'category_id' => $category->id,
                'albums' => $category->albums()->with('categories')->latest()->paginate(50)
            ]

        );
    }
}
