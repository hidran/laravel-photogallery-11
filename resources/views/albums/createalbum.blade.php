@extends('templates.default')
@section('content')

    <h3>CREATE NEW ALBUM </h3>


    <form method="post" action="{{route('albums.store')}}">
        @csrf

        <div class="form-group √">
            <label for="album_name" class="form-label">Name</label>
            <input required class="form-control" name="album_name"
                   id="album_name" value="">
        </div>
        <div class='form-group √'>
            <label for='description' class="form-label">Description</label>
            <textarea class='form-control' name='description'
                      id='description'></textarea>
        </div>
        <div class="form-group mb-3">
            <button class="btn btn-primary">INVIA</button>
        </div>
    </form>
@endsection
