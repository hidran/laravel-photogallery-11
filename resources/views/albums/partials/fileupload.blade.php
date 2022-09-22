<div class="mb-3">
    <label for="album_thumb" class="form-label">Thumbnail</label>
    <input type="file" class="form-control" name="album_thumb" id="album_thumb" value="{{$album->album_name}}">
</div>

@if($album->album_thumb)
    <div class="mb-3">
        <img width="300" src="{{asset($album->path)}}" alt="{{$album->name}}" title="{{$album->name}}">
    </div>
@endif
