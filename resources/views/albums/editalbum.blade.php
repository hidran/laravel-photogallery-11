@php
    /**
 * @var $album App\Models\Album;
*/
@endphp
@extends('templates.default')
@section('content')
    <h1>Edit Album</h1>
    @include('partials.inputerrors')
    <form action="{{route('albums.update',['album' => $album->id])}}"
          method="POST" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        @csrf
        <!-- {{method_field('PATCH')}}
        <input type="hidden" name="_method" value="PATCH">
        -->
        <div class="mb-3">
            <label for="album_name" class="form-label">Name</label>
            <input class="form-control" name="album_name" id="album_name"
                   value="{{$album->album_name}}">
        </div>
        @include('albums.partials.fileupload')
        <div class="form-group">
            <label for="">Description</label>
            <textarea name="description" id="description" class="form-control"
                      placeholder="Album description">{{$album->description}}</textarea>

        </div>
        <div class="mt-3 d-flex justify-content-end border">
            <button type="submit" class="btn btn-primary mx-1">Submit</button>
            <a href="{{route('albums.index')}}"
               class="btn btn-outline-info  mx-1">Back</a>
            <a href="{{route('albums.images', $album->id)}}"
               class="btn btn-outline-success  mx-1">Images</a>
        </div>
    </form>
@stop
