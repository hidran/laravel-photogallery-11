@extends('templates.default')
@section('content')

    </style>


<div class="row">
    <div class="col-sm-8">
        <h1>Categories list</h1>
        @if(session()->has('message'))
            <x-alert-info>{{ session()->get('message') }}</x-alert-info>
        @endif
        @include('partials.inputerrors')
        <table class="table tablr-striped table-dark">

            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Created</th>
                <th>Updated</th>
                <th>Albums</th>
                <th>&nbsp;&nbsp;</th>
            </tr>
            </thead>
            <tbody>
            @forelse( $categories as $cat)
                <tr id="tr-{{$cat->id}}">
                    <td>{{$cat->id}}</td>
                    <td>{{$cat->category_name}}</td>
                    <td>{{$cat->created_at->format('Y-m-d H:i')}}</td>
                    <td>{{$cat->updated_at->format('Y-m-d H:i')}}</td>
                    <td>
                        @if($cat->albums_count > 0)
                            <a class="btn btn-success"
                               href="{{route('albums.index')}}?category_id={{$cat->id}}"> {{$cat->albums_count}}</a>
                        @else
                            {{$cat->albums_count}}
                        @endif
                    </td>
                    <td class="d-flex justify-content-center">
                        <a class="btn btn-outline-info m-1"
                           href="{{route('categories.edit',$cat->id )}}"
                           title="UPDATE CATEGORY"><i class="bi bi-pen"></i>
                        </a>
                        <form action="{{route('categories.destroy', $cat->id)}}"
                              method="post">
                            @csrf
                            @method('delete')
                            <button id="btnDelete-{{$cat->id}}" class="btn btn-danger  m-1"
                                    title="DELETE CATEGORY"><i
                                    class="bi bi-trash"></i></button>
                        </form>
                    </td>
                </tr>
            @empty
                <tfoot>
                <tr>
                    <th colspan="6">No categories</th>
                </tr>
                </tfoot>
                @endforelse

                </tbody>
                <tfoot>
                <tr class="">
                    <th colspan="6">{{$categories->links('vendor.pagination.bootstrap-4')}}</th>
                </tr>
                </tfoot>
        </table>
    </div>
    <div class="col-sm-4">
        @include('categories.categoryform')
    </div>
</div>
@endsection
@section('footer')
    @parent
    <script>
        $('document').ready(function () {
            $('div.alert').fadeOut(5000);
            $('form .btn-danger ').on('click',function (ele) {
                ele.preventDefault();

                var f = this.parentNode;
                var categoryId = this.id.replace('btnDelete-','')*1;
                var Trid ='tr-'+ categoryId;
                var urlCategory = f.action;

                $.ajax(
                    urlCategory,
                    {
                        method: 'DELETE',
                        data : {
                            '_token' : window.Laravel.csrf_token
                        },
                        complete : function (resp) {
                           console.log(resp)
                            if(resp.responseText == 1){

                            } else {
                                alert('Problem contacting server');
                            }
                        }
                    }
                )
            });
            return false;
        });
    </script>
@endsection
