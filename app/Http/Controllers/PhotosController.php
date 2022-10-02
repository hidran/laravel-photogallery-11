<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Photo;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class PhotosController extends Controller
{
    protected array $rules = [

        'album_id' => 'bail|required|integer|exists:albums,id',
        'name' => 'required',
        'img_path' => 'bail|required|image'
    ];
    protected array $messages = [
        'album_id.required' => 'Il campo album è obbligatorio',
        'description.required' => 'Il campo Descrizione è obbligatorio',
        'name.required' => 'Il campo Nome è obbligatorio',
        'img_path.required' => 'Il campo Immagine è obbligatorio'

    ];

    /**
     * Display a listing of the resource.
     *
     * @return Collection
     */
    public function index(): Collection
    {
        return Photo::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param \Illuminate\Http\Request $req
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create(Request $req): View
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
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request, $this->rules, $this->messages);
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
     * @return \App\Models\Photo
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
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
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
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Photo $photo)
    {
        unset($this->rules ['img_path']);
        $this->validate($request, $this->rules, $this->messages);
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
    public function destroy(Photo $photo): int
    {
        return $photo->delete();
    }
}
