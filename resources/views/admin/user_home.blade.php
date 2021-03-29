@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <h3><strong>Users</strong></h3>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 text-left">
                            <a href="/user/list" class="btn btn-secondary btn-rounded mb-4">User List</a>
                        </div>
                        <div class="col-md-6 text-right">
                            <a href="" class="btn btn-success btn-rounded mb-4" data-toggle="modal" data-target="#AddUserModal">Add User</a>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered datatable">
                            <thead>
                                <tr>
                                    <th width="200">Id</th>
                                    <th>Name</th>
                                    <th>Age</th>
                                    <th>Gender</th>
                                    <th>Email</th>
                                    <th width="200" class="text-center">Action</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('modal.add_user')
@include('modal.delete_user')
<script type="text/javascript">
    $(document).ready(function() {
        var dataTable = $('.datatable').DataTable({
            processing: true,
            serverSide: true,
            autoWidth: false,
            pageLength: 10,
            "order": [[ 0, "asc" ]],
            ajax: '{{ route('getUsers') }}',
            columns: [
                {data: 'id', name: 'id'},
                {data: 'name', name: 'name'},
                {data: 'age', name: 'age'},
                {data: 'gender', name: 'gender'},
                {data: 'email', name: 'email'},
                {data: 'Actions', name: 'Actions',orderable:false,serachable:false,sClass:'text-center'},
            ]
        });

        $('#AddUserModal').on('hidden.bs.modal', function () {
            $('.alert-danger').hide();
        });

        $('#AddUserModal').on('hidden.bs.modal', function (e) {
            $('#password').val('');
            $('#password_confirmation').val('');
        })

        $('#SubmitAddUserModal').click(function(e) {
            e.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: "{{ route('createUser') }}",
                method: 'post',
                data: {
                    name: $('#name').val(),
                    age: $('#age').val(),
                    gender: $('#gender option:selected').val(),
                    rol: $('#rol option:selected').val(),
                    email: $('#email').val(),
                    password: $('#password').val(),
                    password_confirmation: $('#password_confirmation').val(),
                },
                success: function(result) {
                    if(result.errors) {
                        $('.alert-danger').html('');
                        $.each(result.errors, function(key, value) {
                            $('.alert-danger').show();
                            $('.alert-danger').append('<strong><li>'+value+'</li></strong>');
                        });
                    } else {
                        $('.alert-danger').hide();
                        $('.datatable').DataTable().ajax.reload();
                        $('#AddUserModal').modal('hide');
                        $('#AddUserModal').find("input,textarea,select").val('').end()
                    }
                }
            });
        });

        var deleteID;
        $('body').on('click', '#getDeleteId', function(){
            deleteID = $(this).data('id');
            $.ajax({
                url: "user/"+deleteID+"/json",
                method: 'GET',
                success: function(result) {
                    var nombre = result.data.name;
                    $("#DeleteUserModal").modal('toggle');
                    $("#deleteName").text(nombre);
                }
            });
        })

        $('#SubmitDeleteUserModal').click(function(e) {
            e.preventDefault();
            var id = deleteID;
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "user/"+id,
                method: 'DELETE',
                success: function(result) {
                    $('.datatable').DataTable().ajax.reload();
                    $("#DeleteUserModal").modal('toggle');
                }
            });
        });
    });
</script>
@endsection
