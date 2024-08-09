@extends('templates.default')
@section('content')
    <h1>ALBUMS</h1>

    @if(session()->has('message'))
        <x-alert-info>{{ session()->get('message') }}</x-alert-info>
    @endif


    <table class="table table-striped table-dark albums">
        <thead>
        <tr class="align-middle">
            <th>Album name</th>
            <th>Thumb</th>
            <th>Categories</th>
            <th>Author</th>
            <th>Date</th>
            <th>&nbsp;</th>
        </tr>
        </thead>
        @foreach($albums as $album)
            <tr class="align-middle" id="tr-{{$album->id}}">
                <td>({{$album->id}}) {{$album->album_name}}</td>
                <td>
                    @if($album->album_thumb)
                        <img width="120"
                             src="{{$album->path}}"
                             title="{{$album->album_name}}"
                             alt="{{$album->album_name}}">
                    @endif
                </td>
                <td>
                    @if($album->categories->count())
                        <ul>
                            @foreach($album->categories as $cat)
                                <li>{{$cat->category_name}}</li>
                            @endforeach
                        </ul>
                    @else
                        No categories
                    @endif
                </td>
                <td>{{$album->user->name}}</td>
                <td>{{$album->created_at->format('d/m/Y H:i')}}</td>
                <td>
                    <div class="row">
                        <div class="col-md-3">
                            <a title="Add new image"
                               href="{{route('photos.create')}}?album_id={{$album->id}}"
                               class="btn btn-primary">
                                <i class="bi bi-plus-circle"></i>
                            </a>
                        </div>
                        <div class="col-md-3">
                            @if($album->photos_count)
                                <a title="View images"
                                   href="{{route('albums.images',$album)}}"
                                   class="btn btn-primary">
                                    <i
                                        class="bi bi-zoom-in"></i>
                                    ({{$album->photos_count}})</a>
                            @else
                                <a disabled class="btn btn-primary pe-none"> <i
                                        class="bi bi-zoom-in"></i></a>
                            @endif
                        </div>
                        <div class="col-md-3">
                            <a href="{{route('albums.edit',$album)}}"
                               class="btn btn-primary"> <i
                                    class="bi bi-pen"></i></a>
                        </div>
                        <div class="col-md-3">
                            <form id="form{{$album->id}}" method="POST"
                                  action="{{route('albums.destroy',$album)}}"
                                  class="form-inline">
                                @method('DELETE')

                                @csrf
                                <button class="btn btn-danger"
                                        id="{{$album->id}}"><i
                                        class="bi bi-trash"></i></button>
                            </form>
                        </div>
                    </div>
                </td>
            </tr>
        @endforeach
        <tr>
            <td colspan="6">
                <div class="row">
                    <div

                        class="col-md-8 offset-md-2 d-flex justify-content-center">
                        {{$albums->links('vendor.pagination.bootstrap-5')}}
                    </div>
                </div>
            </td>
        </tr>
    </table>

@endsection
@section('footer')
    @parent
    <script>
        $('document').ready(function () {
            $('.alert').fadeOut(5000);
            $('table').on('click', 'button.btn-danger', function (ele) {
                ele.preventDefault();
                console.log(ele.target)
                const id = ele.target.id ? ele.target.id : ele.target.parentNode.id;
                alert(id)

                alert('#tr-' + id)
                const tr = $('#tr-' + id);
                console.log(tr)
                const f = $('#form' + id);
                const urlAlbum = f.attr('action');
                $.ajax(
                    urlAlbum,
                    {
                        method: 'DELETE',
                        data: {
                            _token: '{{csrf_token()}}'
                        },
                        complete: function (resp) {
                            console.log(resp);
                            if (+resp.responseText === 1) {
                                //   alert(resp.responseText)
                                tr.remove();
                                // $(li).remove();
                            } else {
                                alert('Problem contacting server');
                            }
                        }
                    }
                )
            });
        });
    </script>
@endsection
