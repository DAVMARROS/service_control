@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                	<div class="row">
                        <div class="col-md-12 text-left">
                            <a href="/admin" class="btn btn-secondary btn-rounded mb-4" >Back</a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <h3><strong>User</strong></h3>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 text-center">
                            <h5>Name: {{ $data["name"] }}</h5>
                        </div>
                        <div class="col-md-6 text-center">
                            <h5>Email: {{ $data["email"] }}</h5>
                        </div>
                    </div><br>
                    <div class="row">
                        <div class="col-md-6 text-center">
                            <h5>Age: {{ $data["age"] }}</h5>
                        </div>
                        <div class="col-md-6 text-center">
                            <h5>Gender: {{ $data["gender"] }}</h5>
                        </div>
                    </div><br>
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <h5><strong>User's Services</strong></h5>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered admindatatable">
                            <thead>
                                <tr>
                                    <th width="200">Id</th>
                                    <th>Name</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('modal.edit_service')
@include('modal.delete_service')
<script type="text/javascript">
	$(document).ready(function() {
        var id = {{ $data['id'] }};
        var dataTable = $('.admindatatable').DataTable({
            processing: true,
            serverSide: true,
            autoWidth: false,
            pageLength: 10,
            "order": [[ 0, "asc" ]],
            ajax: "/admin/service/"+id,
            columns: [
                {data: 'id', name: 'id'},
                {data: 'name', name: 'name'},
            ]
        }); 
    }); 
</script>
@endsection