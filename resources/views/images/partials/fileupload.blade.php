<div class="mb-3">
    <label for="img_path" class="form-label">Thumbnail</label>
    <input type="file" class="form-control" name="img_path" id="img_path" value="{{$photo->img_path}}">
</div>

@if($photo->img_path)
    <div class="mb-3">
        <img width="300" src="{{asset($photo->path)}}" alt="{{$photo->name}}" title="{{$photo->name}}">
    </div>
@endif
