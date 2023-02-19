@extends('templates.default')
@section('content')
    <div class="row">
        @foreach($images as $image)
            <div class="col-sm-4 col-md-3 col-lg-2">
                <div class="card m-2">
                    <a href="{{asset($image->path)}}" data-lightbox="{{$album->album_name}}">
                        <img src="{{asset($image->path)}}" class="card-img-top img-fluid rounded" alt="{{$image->name}}"
                             title="{{$image->name}}">
                    </a>
                    <div class="card-body">
                        <h5 class="card-title">{{$image->name}}</h5>

                    </div>
                </div>
            </div>

        @endforeach

    </div>
    <div class="row d-flex justify-content-center">
        <div class="col-sm-6">
            {{$images->links()}}
        </div>
    </div>
@endsection
