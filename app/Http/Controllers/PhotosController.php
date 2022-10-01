<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Photo;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

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
        return view('images.editimage', compact('album', 'photo'));
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
        dd($request->all());
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
        return view('images.editimage', compact('photo', 'album'));
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
        $data = $request->only(['name', 'description']);
        $photo->name = $data['name'];
        $photo->description = $data['description'];
        if ($request->hasFile('img_path')) {
            $this->processFile($request, $photo);
        }
        $res = $photo->save();

        $messaggio = $res ? 'Photo   ' . $photo->name . ' Updated' : 'Album ' . $photo->name . ' was not updated';
        session()->flash('message', $messaggio);
        return redirect()->route('albums.images', ['album' => $photo->album]);
    }

    /**
     * @param Request $request
     * @param Album $album
     *
     * @return void
     */
    public function processFile(Request $request, Photo $photo): void
    {
        $disk = config('filesystems.default');
        $file = $request->file('img_path');

        $filename = $photo->id . '.' . $file->extension();
        $thumbnail = $file->storeAs(config('filesystems.img_dir'
            . $photo->album_id), $filename,
            ['disk' => $disk]);
        $photo->img_path = $thumbnail;
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
