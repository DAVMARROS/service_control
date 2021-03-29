@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-danger">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <h3><strong>Services</strong></h3>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 text-right">
                            <a href="" class="btn btn-success btn-rounded mb-4" data-toggle="modal" data-target="#AddServiceModal">Add Service</a>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered datatable">
                            <thead>
                                <tr>
                                    <th width="200">Id</th>
                                    <th>Name</th>
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

@include('modal.add_service')
@include('modal.edit_service')
@include('modal.delete_service')
<script type="text/javascript">
    $(document).ready(function() {
        var dataTable = $('.datatable').DataTable({
            processing: true,
            serverSide: true,
            autoWidth: false,
            pageLength: 10,
            "order": [[ 0, "asc" ]],
            ajax: '{{ route('getServices') }}',
            columns: [
                {data: 'id', name: 'id'},
                {data: 'name', name: 'name'},
                {data: 'Actions', name: 'Actions',orderable:false,serachable:false,sClass:'text-center'},
            ]
        }); 

        $('#AddServiceModal').on('hidden.bs.modal', function () {
            $('.alert-danger').hide();
        });
        $('#SubmitAddServiceModal').click(function(e) {
            e.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ route('createService') }}",
                method: 'post',
                data: {
                    name: $('#name').val(),
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
                        $('#AddServiceModal').modal('hide');
                        $('#AddServiceModal').find("input,textarea,select").val('').end()
                    }
                }
            });
        });

        $('.modalEditClose').on('click', function(){
            $('#EditServiceModal').hide();
        });

        var id;
        $('body').on('click', '#getEditService', function(e) {
            $('.alert-danger').html('');
            $('.alert-danger').hide();
            id = $(this).data('id');
            $.ajax({
                url: "/service/"+id,
                method: 'GET',
                success: function(result) {
                    var nombre = result.data.name;
                    $("#EditServiceModal").modal('toggle');
                    $("#editName").val(nombre);
                }
            });
        });

        $('#SubmitEditServiceModal').click(function(e) {
            e.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "/service/"+id,
                method: 'PUT',
                data: {
                    name: $('#editName').val(),
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
                        $('#EditServiceModal').modal('hide');
                    }
                }
            });
        });

        var deleteID;
        $('body').on('click', '#getDeleteId', function(){
            deleteID = $(this).data('id');
            $.ajax({
                url: "/service/"+deleteID,
                method: 'GET',
                success: function(result) {
                    var nombre = result.data.name;
                    $("#DeleteServiceModal").modal('toggle');
                    $("#deleteName").text(nombre);
                }
            });
        })

        $('#SubmitDeleteServiceModal').click(function(e) {
            e.preventDefault();
            var id = deleteID;
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "/service/"+id,
                method: 'DELETE',
                success: function(result) {
                    $('.datatable').DataTable().ajax.reload();
                    $("#DeleteServiceModal").modal('toggle');
                }
            });
        });
    });
</script>
@endsection
