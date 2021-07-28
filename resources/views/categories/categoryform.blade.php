<form action="{{route('categories.store')}}" method="post" class="row">
    @csrf
    <div class="form-group">

        <input type="text" required minlength="4" size="12" name="category_name" placeholder="category name" class="form-control" id="category_name">
    </div>
    <div class="form-group m-4 d-flex justify-content-center">
        <button class="btn btn-primary">SAVE</button>
    </div>
</form>
