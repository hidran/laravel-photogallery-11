@extends('templates.default')
@section('content')
    <h1>ALBUMS</h1>
    @if(session()->has('message'))
        <x-alert-info>{{session()->get('message')}}</x-alert-info>
    @endif
    <form>
        <input id="_token" type="hidden" name="_token" value="{{csrf_token()}}">
        <ul class="list-group">
            @foreach($albums as $album)
                <li class="list-group-item d-flex justify-content-between">
                    ({{$album->id}}) {{$album->album_name}}
                    @if($album->album_thumb)
                        <div class="mb-3">
                            <img width="300"
                                 src="{{$album->path}}"
                                 alt="{{$album->name}}"
                                 title="{{$album->name}}">
                        </div>
                    @endif
                    <div>
                        @if($album->photos_count)
                            <a href="{{route('albums.images',$album)}}" class="btn btn-primary">VIEW IMAGES
                                ({{$album->photos_count}})</a>
                        @else
                            <a href="#" disabled class="btn btn-default">NO IMAGES
                            </a>
                        @endif
                        <a href="{{route('albums.edit',$album)}}"
                           class="btn btn-primary">UPDATE</a>
                        <a href="/albums/{{$album->id}}" class="btn btn-danger">DELETE</a>
                    </div>
                </li>
            @endforeach
        </ul>
    </form>
@endsection
@section('footer')
    @parent
    <script>
        $('document').ready(function () {
            $('div.alert-info').fadeOut(5000);
            $('ul').on('click', 'a.btn-danger', function (ele) {
                ele.preventDefault();
                var urlAlbum = $(this).attr('href');
                // we add another parentNode because of the div
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
