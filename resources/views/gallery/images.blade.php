@extends('templates.default')
@section('content')
    <div class="row">
        @foreach($images as $image)
            <div class="col-sm-4 col-md-3 col-lg-2">
                <div class="card m-2">

                    <img src="{{asset($image->path)}}" class="card-img-top img-fluid rounded" alt="{{$image->name}}"
                         title="{{$image->name}}">

                    <div class="card-body">
                        <h5 class="card-title">{{$image->name}}</h5>

                    </div>
                </div>
            </div>

        @endforeach

    </div>
    <div class="row d-flex justify-content-center">
        <div class="col-sm-8">
            {{$images->links('vendor.pagination.bootstrap-5')}}
        </div>
    </div>
@endsection
