<h1>Categories list</h1>
<table class="table tablr-striped table-dark" id="categoryList">

    <thead>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Created</th>
        <th>Updated</th>
        <th>Albums</th>
        <th>&nbsp;</th>
    </tr>
    </thead>
    <tbody>
    @forelse( $categories as $cat)
        <tr id="tr-{{$cat->id}}">
            <td>{{$cat->id}}</td>
            <td  id="catid-{{$cat->id}}">{{$cat->category_name}}</td>
            <td>{{$cat->created_at->format('Y-m-d H:i')}}</td>
            <td>{{$cat->updated_at->format('Y-m-d H:i')}}</td>
            <td>
                @if($cat->albums_count > 0)
                    <a class="btn btn-success" href="{{route('albums.index')}}?category_id={{$cat->id}}"> {{$cat->albums_count}}</a>
                @else
                    {{$cat->albums_count}}
                @endif
            </td>
            <td class="d-flex justify-content-center">
                <a   id="upd-{{$cat->id}}" class="btn btn-outline-info m-1" href="{{route('categories.edit',$cat->id )}}" title="UPDATE CATEGORY"><i class="bi bi-pen"></i> </a>
                <form action="{{route('categories.destroy', $cat->id)}}" method="post">
                    @csrf
                    @method('delete')
                    <button id="btnDelete-{{$cat->id}}" class="btn btn-danger  m-1" title="DELETE CATEGORY"><i class="bi bi-trash"></i> </button>
                </form>
            </td>
        </tr>
    @empty
        <tfoot>
        <tr>
            <th colspan="5">No categories</th>
        </tr>
        </tfoot>
        @endforelse

        </tbody>
        <tfoot>
        <tr class="">
            <th colspan="6">{{$categories->links('vendor.pagination.bootstrap-4')}}</th>
        </tr>
        </tfoot>
</table>
