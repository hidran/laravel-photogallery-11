@extends('templates.default')
@section('content')
    <style>
        .navigation{
            justify-content-center;
        }
    </style>
    <table class="table tablr-striped table-dark">

        <thead>
         <tr>
             <th>ID</th>
             <th>Name</th>
             <th>Created</th>
             <th>Updated</th>
             <th>Albums</th>
         </tr>
        </thead>
        <tbody>
        @forelse( $categories as $category)
            <tr>
                <td>{{$category->id}}</td>
                <td>{{$category->category_name}}</td>
                <td>{{$category->created_at->format('Y-m-d H:i')}}</td>
                <td>{{$category->updated_at->format('Y-m-d H:i')}}</td>
                <td>{{$category->albums_count}}</td>
            </tr>
        @empty
          <tfoot>
          <tr><th colspan="5">No categories</th> </tr>
          </tfoot>
        @endforelse

        </tbody>
            <tfoot>
            <tr class=""><th colspan="5">{{$categories->links('vendor.pagination.bootstrap-4')}}</th> </tr>
            </tfoot>
    </table>
@endsection
