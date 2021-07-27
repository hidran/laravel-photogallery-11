<div class="form-group">
    <label for="">Categories</label>
    @json($selectedCategories)
    <select   name="categories[]" id="categories" class="form-control" multiple>
        @foreach($categories as $cat)
            <option {{in_array($cat->id, $selectedCategories, true)? 'selected':''}} value="{{$cat->id}}">{{$cat->category_name}}</option>
        @endforeach
    </select>
</div>
