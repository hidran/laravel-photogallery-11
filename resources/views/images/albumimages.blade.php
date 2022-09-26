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
