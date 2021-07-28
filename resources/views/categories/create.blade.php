@extends('templates.default')
@section('content')

    <div class="row d-flex justify-content-center">
        <div class="col-auto">
            @include('partials.inputerrors')
            <h1>{{$category->category_name ? 'Modify category': 'Create new Category' }}</h1>
    @include('categories.categoryform')
        </div>
    </div>
@endsection
