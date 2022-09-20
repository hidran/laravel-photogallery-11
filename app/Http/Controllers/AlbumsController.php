<?php

namespace App\Http\Controllers;

use App\Models\Album;
use DB;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

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
        // da aggiungere se c'è già la colonna album_thumb nella tabella
        $data['album_thumb'] = '/';

        $res = DB::table('albums')->insert($data);
        $messaggio = $res ? 'Album   ' . $data['album_name'] . ' Created' : 'Album ' . $data['album_name'] . ' was not crerated';
        session()->flash('message', $messaggio);

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
    public function edit(Album $album): View
    {
        return view('albums.editalbum')->withAlbum($album);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id): RedirectResponse
    {
        $data = $request->only(['album_name', 'description']);
        $res = DB::table('albums')->where('id', $id)->update($data);
        $messaggio = $res ? 'Album   ' . $id . ' Updated' : 'Album ' . $id . ' was not updated';
        session()->flash('message', $messaggio);

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
        return $this->destroy($album);
    }
}
