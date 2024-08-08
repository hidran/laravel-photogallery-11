@extends('templates.default')
@section('content')
    <h1>ALBUMS</h1>
    @if(session()->has('message'))
        <x-alert-info/>
    @endif
    <form>
        @csrf
    </form>

    <ul class="list-group">
        @foreach($albums as $album)
            <li class="list-group-item d-flex justify-content-between">
                ({{$album->id}}) {{$album->album_name}}
                @if($album->album_thumb)
                    <div class="mb-3">
                      
                        <img width="300"
                             src="{{asset('storage/'.$album->album_thumb)}}"
                             alt="{{$album->name}}"
                             title="{{$album->name}}">
                    </div>
                @endif
                <div>
                    <a href="/albums/{{$album->id}}/edit"
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
            $('ul').click(evt => {

                const ele = evt.target;
                if (!ele.classList.contains('btn-danger')) {
                    return;
                }
                evt.preventDefault();
                const urlAlbum = ele.href;
                const li = ele.parentNode.parentNode;

                $.ajax(urlAlbum, {
                        method: 'DELETE',
                        data: {
                            _csrf: $('#_token').val()
                        },
                        complete: function (resp, status) {
                            if (status !== 'error' && Number(resp.responseText) === 1) {
                                $(li).remove();
                                // li.parentNode.removeChild(li);
                                alert('Record ' + resp.responseText + ' deleted ')
                            } else {
                                console.error(resp.responseText);
                                alert(resp.responseText)
                            }

                        }
                    }
                )


            })

        });


    </script>
@endsection
