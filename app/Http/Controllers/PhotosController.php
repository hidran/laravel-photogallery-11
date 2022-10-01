<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class PhotosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return Photo::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(Request $req)
    {
        $photo = new Photo();
        $album = $req->album_id ? Album::findOrFail($req->album_id) : new Album();
        $albums = $this->getAlbums();
        return view('images.editimage',
            compact('album', 'photo', 'albums'));
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function getAlbums(): Collection
    {
        return Album::orderBy('album_name')->select(['id', 'album_name'])->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $photo = new Photo();
        $photo->name = $request->input('name');
        $photo->description = $request->input('description');
        $photo->album_id = $request->input('album_id');
        $this->processFile($request, $photo);
        $photo->save();
        return redirect(route('albums.images', $photo->album));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Album $album
     *
     * @return void
     */
    public function processFile(Request $request, Photo $photo): void
    {
        $disk = config('filesystems.default');
        $file = $request->file('img_path');
        $name = preg_replace('@[^a-z]i@', '_', $photo->name);
        $filename = $name . '.' . $file->extension();
        $thumbnail = $file->storeAs(config('filesystems.img_dir'
            . $photo->album_id), $filename,
            ['disk' => $disk]);
        $photo->img_path = $thumbnail;
    }

    /**
     * Display the specified resource.
     *
     * @param Photo $photo
     *
     * @return Response
     */
    public function show(Photo $photo)
    {
        return $photo;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Photo $photo
     *
     * @return Response
     */
    public function edit(Photo $photo)
    {
        $album = $photo->album;
        $albums = $this->getAlbums();
        return view('images.editimage',
            compact('photo', 'album', 'albums'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Photo $photo
     *
     * @return Response
     */
    public function update(Request $request, Photo $photo)
    {

        $data = $request->only(['name', 'description', 'album_id']);
        $photo->name = $data['name'];
        $photo->description = $data['description'];
        if ($request->hasFile('img_path')) {
            $this->processFile($request, $photo);
        }
        $photo->album_id = $data['album_id'];
        $res = $photo->save();

        $messaggio = $res ? 'Photo   ' . $photo->name . ' Updated' : 'Album ' . $photo->name . ' was not updated';
        session()->flash('message', $messaggio);
        return redirect()->route('albums.images', ['album' => $photo->album]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Photo $photo
     *
     * @return int
     */
    public function destroy(Photo $photo)
    {
        $res = $photo->delete();
        return $res;
    }
}
