@extends('templates.default')
@section('content')
    <div class="row">
        @foreach($albums as $album)
            <div class="col-sm-4 col-md-3 col-lg-2">
                <div class="card m-2">
                    <a href="{{route('gallery.album.images', $album->id)}}">
                        <img src="{{asset($album->path)}}" class="card-img-top img-fluid rounded"
                             alt="{{$album->album_name}}"
                             title="{{$album->album_name}}">
                    </a>
                    <div class="card-body">
                        <h5 class="card-title"> <a href="{{route('gallery.album.images', $album->id)}}">{{$album->album_name}}</a></h5>
                        <p class="card-text">{{$album->album_description}}</p>
                        <p class="card-text">{{$album->created_at->diffForHumans()}}</p>
                        <p class="card-text">
                            @foreach($album->categories as $cat)
                                @if($cat->id !== $category_id)
                                <a href="{{route('gallery.categories.albums', $cat->id)}}">{{$cat->category_name}}</a>
                                @else
                                    {{$cat->category_name}}
                                @endif
                            @endforeach
                        </p>
                    </div>
                </div>
            </div>

    @endforeach

    </div>
@endsection
