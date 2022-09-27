@extends('templates.default')
@section('content')
    @php
        /**
     * * @var $photo App\Models\Photo
     */
    @endphp
    <h3>EDIT image {{$photo->name}}</h3>
    <form method="post" action="{{route('photos.update',$photo)}}" enctype="multipart/form-data">
        @method('PATCH')
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input class="form-control" name="name" id="name" value="{{$photo->name}}">
        </div>

        @include('images.partials.fileupload')

        <div class="mb-3">
            <label for='description' class="form-label">Description</label>
            <textarea class='form-control' name='description' id='description'>{{$photo->description}}</textarea>
        </div>
        <div class="mb-3">
            <button class="btn btn-primary">INVIA</button>
        </div>
    </form>
@endsection
