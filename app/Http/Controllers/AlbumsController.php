<?php

namespace App\Http\Controllers;

use App\Events\NewAlbumCreated;
use App\Http\Requests\AlbumRequest;
use App\Models\Album;
use App\Models\Category;
use App\Models\Photo;
use Auth;
use Doctrine\DBAL\Query\QueryBuilder;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Storage;

class AlbumsController extends Controller
{
    public function __construct()
    {
        //   $this->authorizeResource(Album::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        /**
         * @var Builder $queryBuilder
         */
        $queryBuilder = Album::orderBy('id', 'DESC')
            ->withCount('photos');
        $queryBuilder->where('user_id', Auth::id());
        if ($request->has('id')) {
            $queryBuilder->where('id', '=', $request->input('id'));
        }
        if ($request->has('album_name')) {
            $queryBuilder->where('album_name', 'like',
                $request->input('album_name') . '%');
        }
        if ($request->has('category_id')) {
            $queryBuilder->whereHas('categories',
                fn($q) => $q->where('category_id', $request->category_id));
        }

        $albums = $queryBuilder->paginate(env('IMAGE_PER_PAGE', 20));

        return view('albums.albums', ['albums' => $albums]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $album = new Album();
        $selectedCategories = [];
        $categories = Category::orderBy('category_name')->get();
        return view('albums.createalbum', [
            'album' => $album,
            'categories' => $categories,
            'selectedCategories' => []
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(AlbumRequest $request)
    {
        $album = new Album();
        $album->album_name = request()->input('album_name');
        $album->album_thumb = '/';
        $album->description = request()->input('description');
        $album->user_id = Auth::id();
        $res = $album->save();
        if ($res) {
            if ($request->has('categories')) {
                $album->categories()->attach($request->input('categories'));
            }
            if ($this->processFile($album->id, $request, $album)) {
                $album->save();
            }
            event(new NewAlbumCreated($album));
        }

        $name = request()->input('name');
        $messaggio = $res ? 'Album   ' . $name . ' Created' : 'Album ' . $name . ' was not crerated';
        return redirect()->route('albums.index');
    }

    /**
     * @param Request $req
     * @param $id
     * @param $album
     */
    private function processFile($id, Request $req, $album): bool
    {
        if (!$req->hasFile('album_thumb')) {
            return false;
        }

        $file = $req->file('album_thumb');
        if (!$file->isValid()) {
            return false;
        }


        $filename = $id . '.' . $file->extension();
        $filename = $file->storeAs(env('IMG_DIR'), $filename);
        $album->album_thumb = $filename;
        return true;
    }

    /**
     * Display the specified resource.
     *
     * @param Album $album
     * @return Response
     */
    public function show(Album $album)
    {
        return $album;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Album $album
     * @return Response
     */
    public function edit(Album $album)
    {
        $categories = Category::orderBy('category_name')->get();
        $selectedCategories = $album->categories->pluck('id')->toArray();
        return view('albums.editalbum')->with(compact('categories', 'album',
            'selectedCategories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Album $album
     * @return Response
     */
    public function update(AlbumRequest $req, Album $album)
    {
        $album->album_name = $req->input('album_name');
        $album->description = $req->input('description');
        $album->user_id = Auth::id();
        $this->processFile($album->id, $req, $album);

        $res = $album->save();
        if ($req->has('categories')) {
            $album->categories()->sync($req->input('categories'));
        }
        $messaggio = $res ? 'Album con nome = ' . $album->album_name . ' Aggiornato' : 'Album ' . $album->album_name . ' Non aggiornato';
        session()->flash('message', $messaggio);
        return redirect()->route('albums.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Album $album
     * @return Response
     */


    public function destroy(Album $album, Request $req)
    {
        $thumbNail = $album->album_thumb;
        $res = $album->delete();
        if ($res && $thumbNail && Storage::exists($thumbNail)) {
            // no need to as there is ondelete cascade
            // $album->categories()->detach($album->categories->pluck('id'));
            Storage::delete($thumbNail);
        }

        if ($req->ajax()) {
            return $res;
        }
        session()->flash('message',
            'Album ' . $album->album_name . ' deleted!');
        return redirect()->route('albums.index');
    }

    public function getImages(Album $album)
    {
        $images = Photo::wherealbumId($album->id)->latest()->paginate(env('IMAGE_PER_PAGE',
            20));
        return view('images.albumimages', compact('album', 'images'));
    }
}
