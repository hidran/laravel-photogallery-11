@extends('templates.default')
@section('title')
    Albums
@endsection
@section('content')
    <h1>ALBUMS</h1>
    <ul class="list-group">
        @foreach($albums as $album)
            <li class="list-group-item d-flex justify-content-between">
                ({{$album->id}}) {{$album->album_name}}
                <a href="/albums/{{$album->id}}/delete" class="btn btn-danger">DELETE</a>
            </li>
        @endforeach
    </ul>
@endsection
