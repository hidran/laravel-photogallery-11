@extends('templates.default')
@section('content')
    <div class="row">
        @foreach($albums as $album)
            <div class="col-sm-4 col-md-3 col-lg-2">
                <div class="card" style="width: 18rem;">
                    <img src="{{asset($album->path)}}" class="card-img-top" alt="{{$album->album_name}}"
                         title="{{$album->album_name}}">
                    <div class="card-body">
                        <h5 class="card-title">{{$album->album_name}}</h5>
                        <p class="card-text">{{$album->album_description}}</p>
                        <p class="card-text">{{$album->created_at->diffForHumans()}}</p>
                        <a href="#" class="btn btn-primary">Go somewhere</a>
                    </div>
                </div>
            </div>

        @endforeach
    </div>
@endsection
