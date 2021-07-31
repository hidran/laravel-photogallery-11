@extends('templates.admin')
@section('content')
    <h1>Users list</h1>
    <table class="table table-striped table-dark data-table">
        <thead>
        <tr>
            <th>NAME</th>
            <th>EMAIL</th>
            <th>ROLE</th>
            <th>CREATED</th>
            <th>DELETED</th>
            <th>&nbsp;</th>
        </tr>
        </thead>
        <tbody>
    @foreach($users as $user)
        <tr>
            <td>{{$user->name}}</td>
            <td>{{$user->email}}</td>
            <td>{{$user->user_role}}</td>
            <td>{{$user->created_at->format('Y-m-d H:i')}}</td>
            <td>{{$user->deleted_at? $user->deleted_at->format('Y-m-d H:i'): ''}}</td>
            <td>
                <div class="row">
                    <div class="col-sm-4">
                        <button class="btn btn-primary btn-sm"  title="update">
                            <i class="bi bi-pen"></i>
                        </button>
                    </div>
                    <div class="col-sm-4">
                        @if($user->deleted_at)
                            <i class="bi bi-trash"></i>
                            @else
                        <button class="btn btn-warning btn-sm"  title="Logical delete">
                            <i class="bi bi-trash"></i>
                        </button>
                            @endif
                    </div>
                    <div class="col-sm-4">
                        <button class="btn btn-danger btn-sm"  title="force delete">
                            <i class="bi bi-trash"></i>
                        </button>
                    </div>
                </div>
            </td>
        </tr>
    @endforeach
        </tbody>
        <tfoot>

        </tfoot>
    </table>
@endsection
