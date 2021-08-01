@extends('templates.admin')
@section('content')
    <h1>Users</h1>
    <table class="table table-striped" id="users-table">
        <thead>
        <tr>
            <th>ID</th>
            <th>NAME</th>
            <th>EMAIL</th>
            <th>CREATED AT</th>
            <th>DELETED</th>
            <th>&nbsp;</th>
        </tr>
        </thead>
        <tbody>


        </tbody>
    </table>
@endsection
@section('footer')
    @parent
    <script>
        $(
            function () {
                const dataTable =    $('#users-table').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: '{{route('admin.getUsers')}}',
                    columns: [
                        {data: 'id', name: 'ID'},
                        {data: 'name', name: 'name'},
                        {data: 'email', name: 'email'},
                        {data: 'created_at', name: 'created'},
                        {data: 'deleted_at', name: 'del'},
                        {data: 'action', name: 'action', orderable: false, searchable: false}
                    ]
                });
              $('#users-table').on('click', '.ajax', function (ele) {
                    ele.preventDefault();

                    if(!confirm('Do you really want to delete this record')){
                        return false;
                    }

                    var urlUsers =   $(this).attr('href');

                    var tr =this.parentNode.parentNode;
                    console.log(tr)
                    $.ajax(
                        urlUsers,
                        {
                            method: 'DELETE',
                            data : {
                                '_token' :  Laravel.csrfToken

                            },
                            complete : function (resp) {
                                console.log(resp);
                                if(resp.responseText == 1) {
                                    if (urlUsers.endsWith('hard=1')) {
                                        tr.parentNode.removeChild(tr);
                                    }

                                    alert('User deleted correctly');

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
