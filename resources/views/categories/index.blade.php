@extends('templates.default')
@section('content')

    </style>


<div class="row">
    <div class="col-sm-8">
        <h1>Categories list</h1>
        <div id="alert-container">
            @if(session()->has('message'))
                <x-alert-info>{{ session()->get('message') }}</x-alert-info>
            @endif
        </div>
        @include('partials.inputerrors')
        <table class="table tablr-striped table-dark" id="categoryList">

            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Created</th>
                <th>Updated</th>
                <th>Albums</th>
                <th>&nbsp;&nbsp;</th>
            </tr>
            </thead>
            <tbody>
            @forelse( $categories as $cat)
                <tr id="tr-{{$cat->id}}">
                    <td>{{$cat->id}}</td>
                    <td id="catid-{{$cat->id}}">{{$cat->category_name}}</td>
                    <td>{{$cat->created_at->format('Y-m-d H:i')}}</td>
                    <td>{{$cat->updated_at->format('Y-m-d H:i')}}</td>
                    <td>
                        @if($cat->albums_count > 0)
                            <a class="btn btn-success"
                               href="{{route('albums.index')}}?category_id={{$cat->id}}"> {{$cat->albums_count}}</a>
                        @else
                            {{$cat->albums_count}}
                        @endif
                    </td>
                    <td class="d-flex justify-content-center">
                        <a id="upd-{{$cat->id}}"
                           class="btn btn-outline-info m-1"
                           href="{{route('categories.edit',$cat->id )}}"
                           title="UPDATE CATEGORY"><i class="bi bi-pen"></i>
                        </a>
                        <form action="{{route('categories.destroy', $cat->id)}}"
                              method="post">
                            @csrf
                            @method('delete')
                            <button id="btnDelete-{{$cat->id}}"
                                    class="btn btn-danger  m-1"
                                    title="DELETE CATEGORY"><i
                                    class="bi bi-trash"></i></button>
                        </form>
                    </td>
                </tr>
            @empty
                <tfoot>
                <tr>
                    <th colspan="6">No categories</th>
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
    </div>
    <div class="col-sm-4">
        @include('categories.categoryform')
    </div>
</div>
@endsection
@section('footer')
    @parent
    <script>
        $(document).ready(function () {
            const categoryUrl = '{{ route('categories.store') }}';
            const csrfToken = window.Laravel.csrf_token;
            let selectedCategory = null;

            $('div.alert').fadeOut(5000);

            // Utility function to extract ID from an element's ID attribute
            function extractId(prefix, id) {
                return parseInt(id.replace(prefix, ''), 10);
            }

            // Function to handle the delete action
            function handleDeleteClick(event) {
                event.preventDefault();

                const button = event.currentTarget;
                const categoryId = extractId('btnDelete-', button.id);
                const rowId = `#tr-${categoryId}`;
                const urlCategory = button.closest('form').action;

                $.ajax(urlCategory, {
                    method: 'DELETE',
                    data: {'_token': csrfToken},
                    complete: function (response) {
                        const jsonResponse = JSON.parse(response.responseText);

                        if (jsonResponse.success) {
                            showAlert(jsonResponse.message);
                            $(rowId).fadeOut(500, function () {
                                $(this).remove();  // `this` refers to the element being faded out
                            });
                        } else {
                            alert('Problem contacting server');
                        }
                    }
                });
            }

            // Function to handle the update action
            function handleUpdateClick(event) {
                event.preventDefault();

                const button = event.currentTarget;
                const categoryId = extractId('upd-', button.id);

                const catRow = $(`#tr-${categoryId}`);
                $('#categoryList tr').css('border', '0px');
                catRow.css('border', '1px solid red');

                const urlUpdate = button.href.replace('/edit', '');
                selectedCategory = $(`#catid-${categoryId}`);

                const form = $('#manageCategoryForm');
                form.attr('action', urlUpdate);
                form.find('input[name="category_name"]').val(selectedCategory.text());

                if (!$('#methodType').length) {
                    $('<input>')
                        .attr({
                            type: 'hidden',
                            id: 'methodType',
                            name: '_method',
                            value: 'PATCH'
                        })
                        .appendTo(form);
                }
            }

            // Function to insert the new row
            function insertRow(data) {
                console.log('data', data)
                const tableBody = $('#categoryList tbody');
                const templateRow = $('#categoryList tbody tr:first').clone();
                console.log(templateRow)
                templateRow.attr('id', `tr-${data.id}`);
                templateRow.find('td:nth-child(1)').text(data.id);
                templateRow.find('td:nth-child(2)').attr('id', `catid-${data.id}`).text(data.category_name);
                templateRow.find('td:nth-child(3)').text(data.created_at.replace('T', ' ').slice(0, 16));
                templateRow.find('td:nth-child(4)').text(data.updated_at.replace('T', ' ').slice(0, 16));
                templateRow.find('td:nth-child(5)').text('0'); // Assuming a default value of 0 for albums
                templateRow.find('a[id^="upd"]').attr('id', `upd-${data.id}`).attr('href', `http://localhost:8000/dashboard/categories/${data.id}/edit`);
                templateRow.find('form').attr('action', `http://localhost:8000/dashboard/categories/${data.id}`);
                templateRow.find('button[id^="btnDelete"]').attr('id', `btnDelete-${data.id}`);

                tableBody.prepend(templateRow);

                // Attach event listeners to the new buttons
                templateRow.find('button.btn-danger').on('click', handleDeleteClick);
                templateRow.find('a.btn-outline-info').on('click', handleUpdateClick);
            }

            // Function to show a Bootstrap alert with a message
            function showAlert(message) {
                const alertDiv = $(`<div class="alert alert-info" role="alert">${message}</div>`);
                $('#alert-container').append(alertDiv);
                setTimeout(() => {
                    alertDiv.fadeOut(500, () => alertDiv.remove());
                }, 3000);
            }

            // Initial bindings on document ready
            $('form .btn-danger').on('click', handleDeleteClick);
            $('#categoryList a.btn-outline-info').on('click', handleUpdateClick);

            // Handle form submission for adding a new category
            $('#manageCategoryForm .btn-primary').on('click', function (event) {
                event.preventDefault();

                const form = $('#manageCategoryForm');
                const data = form.serialize();

                $.ajax(form.attr('action'), {
                    method: 'POST',
                    data: data
                }).done(function (response) {
                    $('#methodType').remove();
                    selectedCategory = null;
                    form[0].action = categoryUrl;

                    if (response.success) {
                        if (response.data) {
                            insertRow(response.data);
                        }

                        form[0].reset();
                        showAlert(response.message); // Show the alert with the message
                    } else {
                        alert('Problem contacting server');
                    }
                });
            });
        });

    </script>
@endsection
