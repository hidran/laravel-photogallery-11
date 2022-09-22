@extends('templates.default')
@section('content')

    <h3>CREATE NEW ALBUM </h3>


    <form method="post" action="{{route('albums.store')}}" enctype="multipart/form-data">
        @csrf

        <div class="form-group mb-3">
            <label for="album_name" class="form-label">Name</label>
            <input required class="form-control" name="album_name"
                   id="album_name" value="">
        </div>
        @include('albums.partials.fileupload')
        <div class='form-group mb-3'>
            <label for='description' class="form-label">Description</label>
            <textarea class='form-control' name='description'
                      id='description'></textarea>
        </div>
        <div class="form-group mb-3">
            <button class="btn btn-primary">INVIA</button>
        </div>
    </form>
@endsection
