@extends('templates.admin')
@section('content')
    <ul class="nav flex-column">
    @foreach($users as $user)
        <li class="nav-item">{{$user->name}}</li>
    @endforeach
    </ul>
@endsection
