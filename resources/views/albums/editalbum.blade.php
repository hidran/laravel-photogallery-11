@extends('templates.default')
@section('content')
    @php
        /**
     * * @var $album App\Models\Album
     */
    @endphp
    <h3>EDIT ALBUM {{$album->album_name}}</h3>
    <form method="post" action="{{route('albums.update',['album' => $album->id])}}" enctype="multipart/form-data">
        @method('PATCH')
        @csrf
        <!-- {{method_field('PATCH')}}
        <input type="hidden" name="_method" value="PATCH">
        -->
        <div class="form-group  mb-3">
            <label for="album_name" class="form-label">Name</label>
            <input class="form-control" name="album_name" id="album_name"
                   value="{{$album->album_name}}">
        </div>

        <div class="mb-3">
            <label for="album_thumb" class="form-label">Thumbnail</label>
            <input type="file" class="form-control" name="album_thumb" id="album_thumb" value="{{$album->album_name}}">
        </div>

        @if($album->album_thumb)
            <div class="mb-3">
                <img width="300" src="{{asset($album->path)}}" alt="{{$album->name}}" title="{{$album->name}}">
            </div>
        @endif
        <div class="mb-3">
            <label for='description' class="form-label">Description</label>
            <textarea class='form-control' name='description'
                      id='description'>{{$album->description}}</textarea>
        </div>
        <div class="form-group  mb-3">
            <button class="btn btn-primary">INVIA</button>
        </div>
    </form>
@endsection
