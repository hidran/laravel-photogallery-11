<?php

namespace App\Http\Controllers;

use App\Models\Album;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class AlbumsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $queryBuilder = Album::orderBy('id', 'DESC');
        if ($request->has('id')) {
            $queryBuilder->where('id', '=', $request->input('id'));
        }
        if ($request->has('album_name')) {
            $queryBuilder->where('album_name', 'like',
                $request->input('album_name').'%');
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
        $album = new Album();
        $album->album_name = $data['album_name'];
        $album->description = $data['description'];
        $album->user_id = 1;
        $album->album_thumb = '/';
        $res = $album->save();
        //$res =  Album::create($data);
        $messaggio = $res ? 'Album   '.$data['album_name'].' Created' : 'Album '.$data['album_name'].' was not crerated';
        session()->flash('message', $messaggio);

        return redirect()->route('albums.index');
    }

    /**
     * Display the specified resource.
     *
     *
     * @return void
     */
    public function show(Album $album)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     *
     * @return Response
     */
    public function edit(Album $album): View
    {
        /*
      $sql = 'select * from albums  where id=:id';
      $albumEdit = Db::select($sql, ['id' => $album->id]);
*/
        return view('albums.editalbum')->withAlbum($album);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Album $album): RedirectResponse
    {
        $data = $request->only(['album_name', 'description']);
        $album->album_name = $data['album_name'];
        $album->description = $data['description'];
        $res = $album->save();
        $messaggio = $res ? 'Album   '.$album->album_name.' Updated' : 'Album '.$album->album_name.' was not updated';
        session()->flash('message', $messaggio);

        return redirect()->route('albums.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Album $album): int
    {
        // $res = DB::table('albums')->delete($album);
        // $res = Album::where('id',$album)->delete();
        //   Album::findOrFail($album)->delete();
        //  Album::destroy($album);
        return +$album->delete();
    }

    public function delete(Album $album): int
    {
        return $this->destroy($album);
    }
}
