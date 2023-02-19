@extends('templates.default')
@section('content')
    <h1>ALBUMS</h1>

    @if(session()->has('message'))
        <x-alert-info>{{ session()->get('message') }}</x-alert-info>
    @endif

    <form>
        <input type="hidden" name="_token" id="_token" value="{{csrf_token()}}">
        <table class="table table-striped table-dark albums">
            <thead>
            <tr class="align-middle">
                <th>Album name</th>
                <th>Thumb</th>
                <th>Author</th>
                <th>Date</th>
                <th>&nbsp;</th>
            </tr>
            </thead>
            @foreach($albums as $album)
                <tr class="align-middle">
                    <td>({{$album->id}}) {{$album->album_name}}</td>
                    <td>
                        @if($album->album_thumb)
                            <img width="120"
                                 src="{{$album->path}}"
                                 title="{{$album->album_name}}"
                                 alt="{{$album->album_name}}">
                        @endif
                    </td>
                    <td>{{$album->user->name}}</td>
                    <td>{{$album->created_at->format('d/m/Y H:i')}}</td>
                    <td>
                        <a title="Add new image" href="{{route('photos.create')}}?album_id={{$album->id}}"
                           class="btn btn-primary">
                            <i class="bi bi-plus-circle"></i>
                        </a>
                        <a title="View images" href="{{route('albums.images',$album)}}" class="btn btn-primary"> <i
                                class="bi bi-zoom-in"></i> ({{$album->photos_count}})</a>
                        <a href="{{route('albums.edit',$album)}}"
                           class="btn btn-primary"> <i class="bi bi-pen"></i></a>
                        <a href="{{route('albums.destroy',$album)}}" class="btn btn-danger"> <i class="bi bi-trash"></i></a>
                    </td>
                </tr>
            @endforeach
            <tr>
                <td colspan="5">
                    <div class="row">
                        <div

                            class="col-md-8 offset-md-2 d-flex justify-content-center">
                            {{$albums->links('vendor.pagination.bootstrap-4')}}
                        </div>
                    </div>
                </td>
            </tr>
        </table>
    </form>
@endsection
@section('footer')
    @parent
    <script>
        $('document').ready(function () {
            $('.alert').fadeOut(5000);
            $('ul').on('click', 'a.btn-danger', function (ele) {
                ele.preventDefault();
                var urlAlbum = $(this).attr('href');
                var li = ele.target.parentNode.parentNode;
                $.ajax(
                    urlAlbum,
                    {
                        method: 'DELETE',
                        data: {
                            _token: $('#_token').val()
                        },
                        complete: function (resp) {
                            console.log(resp);
                            if (resp.responseText == 1) {
                                //   alert(resp.responseText)
                                li.parentNode.removeChild(li);
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
