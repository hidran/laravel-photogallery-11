@extends('templates.default')
@section('title')
    Albums
@endsection
@section('content')
    <h1>ALBUMS</h1>
    <ul class="list-group">
        @foreach($albums as $album)
            <li class="list-group-item d-flex justify-content-between">
                ({{$album->id}}) {{$album->album_name}}
                <a href="/albums/{{$album->id}}/delete" class="btn btn-danger">DELETE</a>
            </li>
        @endforeach
    </ul>
@endsection
@section('footer')
    @parent
    <script>
        $('document').ready(function () {
            $('ul').on('click', 'a.btn-danger', function (evt) {
                evt.preventDefault();
                const urlAlbum = $(this).attr('href');
                const li = evt.target.parentNode;
                console.log(li)
                $.ajax(urlAlbum, {

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
