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
        $sql = 'select * from albums WHERE 1=1 ';
        $where = [];
        if ($request->has('id')) {
            $where['id'] = $request->get('id');
            $sql .= ' AND ID=:id';
        }
        if ($request->has('album_name')) {
            $where['album_name'] = $request->get('album_name');
            $sql .= ' AND album_name=:album_name';
        }

        $albums = DB::select($sql, $where);

        return view('albums.albums', ['albums' => $albums]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        $sql = 'DELETE FROM albums WHERE id=:id';

        return DB::delete($sql, ['id' => $album]);
    }

    public function delete(int $album): int
    {
        $sql = 'DELETE FROM albums WHERE id = :id';

        return DB::delete($sql, ['id' => $album]);
    }
}
