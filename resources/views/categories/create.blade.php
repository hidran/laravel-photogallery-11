@extends('templates.default')
@section('content')

    <div class="row d-flex justify-content-center">
        <div class="col-auto">
            @include('partials.inputerrors')

    @include('categories.categoryform')
        </div>
    </div>
@endsection
