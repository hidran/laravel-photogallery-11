@extends('templates.default')
@section('title')
    Albums
@endsection
@section('content')
    <h1>ALBUMS</h1>
    @if(session()->has('message'))
        <x-alert-info/>
    @endif
    <form>
        @csrf
        <input id="_token" type="hidden" name="_token" value="{{csrf_token()}}">
    </form>

    <ul class="list-group">
        @foreach($albums as $album)
            <li class="list-group-item d-flex justify-content-between">
                ({{$album->id}}) {{$album->album_name}}
                <div>
                    <a href="/albums/{{$album->id}}/edit"
                       class="btn btn-primary">UPDATE</a>
                    <a href="/albums/{{$album->id}}"
                       class="btn btn-danger">DELETE</a>
                </div>
            </li>
        @endforeach
    </ul>

@endsection
@section('footer')
    @parent
    <script>
        $('document').ready(function () {
            $('div.alert-info').fadeOut(5000);


            $('ul').click(evt => {
                evt.preventDefault();
                const ele = evt.target;
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
                });

            });
        });

        // document.addEventListener('DOMContentLoaded', function () {
        //     alert('dom')
        //     document.querySelectorAll('li a.btn-danger').forEach(ele => {
        //         ele.addEventListener('click', (evt) => {
        //             evt.preventDefault();
        //             alert(evt.target.getAttribute('href'))
        //         })
        //     })
        // });
    </script>
@endsection
