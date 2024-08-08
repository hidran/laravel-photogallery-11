@extends('templates.default')
@section('content')

    <table class="table table-striped">
        <thead>
        <tr>
            <th>ID</th>
            <th> CREATED DATE</th>
            <th> TITLE</th>
            <th> ALBUM</th>
            <th> THUMBNAIL</th>
            <th>&nbsp;</th>
        </tr>
        </thead>
        <tbody>
        @forelse($images as $image)

            <tr>
                <td>{{$image->id}}</td>
                <td>{{$image->created_at}}</td>
                <td>{{$image->name}}</td>
                <td>{{$album->album_name}}</td>
                <td>
                    <img width="120" src="{{asset($image->img_path)}}">
                </td>
                <td>
                    <a class="btn btn-danger" href="{{route('photos.destroy', $image)}}">DELETE</a>
                </td>
            </tr>

        @empty
            <tr>
                <td colspan="5">
                    No images found
                </td>
            </tr>
        @endforelse
        </tbody>
    </table>
@endsection
@section('footer')
    @parent
    <script>
        $('document').ready(function () {

            $('table').on('click', 'a.btn-danger', function (ele) {
                ele.preventDefault();
                var urlImg = $(this).attr('href');
                // we add another parentNode because of the div
                var tr = ele.target.parentNode.parentNode;
                $.ajax(
                    urlImg,
                    {
                        method: 'DELETE',
                        data: {
                            _token: "{{csrf_token()}}"
                        },
                        complete: function (resp) {
                            console.log(resp);
                            if (resp.responseText == 1) {
                                //   alert(resp.responseText)

                                tr.parentNode.removeChild(tr);
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
