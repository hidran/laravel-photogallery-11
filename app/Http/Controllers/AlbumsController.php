<?php

namespace App\Http\Controllers;

use App\Models\Album;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AlbumsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $queryBuilder = DB::table('albums')->orderBy('id', 'DESC');
        if ($request->has('id')) {
            $queryBuilder->where('id', '=', $request->input('id'));
        }
        if ($request->has('album_name')) {
            $queryBuilder->where('album_name', 'like',
                $request->input('album_name') . '%');
        }
        $albums = $queryBuilder->get();

        return view('albums.albums', ['albums' => $albums]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('albums.createalbum');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $data = $request->only(['album_name', 'description']);
        $data['user_id'] = 1;
        $data['album_thumb'] = '';
        $query = 'INSERT INTO albums (album_name, description, user_id,album_thumb)  values (:album_name, :description, :user_id,:album_thumb)';
        $res = DB::insert($query, $data);
        $message = 'Album ' . $data['album_name'];
        $message .= $res ? ' created' : ' not created';
        session()->flash('message', $message);

        return redirect()->route('albums.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Album $album): Album
    {
        return $album;
    }

    /**
     * Show the form for editing the specified resource.
     */
    //public function edit(int $album)
    public function edit(Album $album)
    {
        //        $sql = 'select * from albums  where id=:id';
        //        $albumEdit = Db::select($sql, ['id' => $album]);
        //$album = $albumEdit[0];

        return view('albums.editalbum')->withAlbum($album);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        Request $request,
        int $album
    ): RedirectResponse {
        $data = $request->only(['album_name', 'description']);
        $data['id'] = $album;
        $query = 'UPDATE albums set album_name=:album_name, description=:description where id=:id';
        $res = Db::update($query, $data);
        $message = 'Album with id= ' . $album;
        $message .= $res ? ' Updated' : ' not updated';
        session()->flash('message', $message);

        return redirect()->route('albums.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $album): int
    {
        return DB::table('albums')->where('id', $album)->delete();
    }

    public function delete(int $album): int
    {
        return DB::table('albums')->where('id', $album)->delete();
    }
}
