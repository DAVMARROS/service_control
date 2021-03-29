@extends('layouts.admin')

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
                    <div class="table-responsive">
                        <table class="table table-bordered admindatatable">
                            <thead>
                                <tr>
                                    <th width="200">Id</th>
                                    <th>Name</th>
                                    <th>User</th>
                                    <th>Email</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        var dataTable = $('.admindatatable').DataTable({
            processing: true,
            serverSide: true,
            autoWidth: false,
            pageLength: 10,
            "order": [[ 0, "asc" ]],
            ajax: '/admin/service/0',
            columns: [
                {data: 'id', name: 'id'},
                {data: 'name', name: 'name'},
                {data: 'user.name', name: 'user.name'},
                {data: 'user.email', name: 'user.email'},
            ]
        }); 
    }); 
</script>
@endsection