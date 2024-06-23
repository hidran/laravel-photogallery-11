@extends('templates.default')
@section('content')
    @php
        /**
     * * @var $album App\Models\Album
     */
    @endphp
    <h3>EDIT ALBUM {{$album->album_name}}</h3>
    <form method="post">
        <div class="form-group">
            <label for="album_name">Name</label>
            <input class="form-control" name="album_name" id="album_name"
                   value="{{$album->album_name}}">
        </div>
        <div class='form-group'>
            <label for='description'>Description</label>
            <textarea class='form-control' name='description'
                      id='description'>{{$album->description}}</textarea>
        </div>
        <div class="form-group">
            <button class="btn btn-primary">INVIA</button>
        </div>
    </form>
@endsection
