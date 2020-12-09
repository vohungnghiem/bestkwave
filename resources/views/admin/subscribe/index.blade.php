@extends('admin.layout.master')
@section('title', 'Admincp | Subscribe')
@section('content')

<div class="content-wrapper">
    @if (session('error'))
        <div class="alert alert-danger">
            {{session('error')}}
        </div>
    @endif
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>List</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="admincp/subscribe">Subscribe</a></li>
                        <li class="breadcrumb-item active">List</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"><a class="btn btn-primary" href="admincp/subscribe/create">Create Subscribe</a></h3>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered" id="example1">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Address</th>
                                        <th>Message</th>
                                        <th>Sort</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection
@section('javascript')
<script>
    $(document).ready(function() {
        $.fn.dataTable.ext.errMode = 'throw';
        $('#example1').DataTable({
            processing: true,
            serverSide: true,
            "responsive": true, "lengthChange": false, "autoWidth": false,
            ajax: 'admincp/datatables/subscribe',
            columns: [
                { data: 'id', name: 'id', "width": "5%" },
                { data: 'name', name: 'name', "width": "15%" },
                { data: 'email', name: 'email', "width": "15%" },
                { data: 'address', name: 'address', "width": "25%", "className": "text-center" },
                { data: 'message', name: 'message', "width": "10%", "className": "text-center" },
                { data: 'sort', name: 'sort', "width": "10%", "className": "text-center" },
                { data: 'status', name: 'status', "width": "5%", "className": "text-center" },
                { data: 'action', name: 'action', "width": "15%", "className": "text-center" },
            ],
            order: [0, "desc"],
            "fnRowCallback": function(nRow, aData, iDisplayIndex, iDisplayIndexFull) {
              var index = iDisplayIndexFull + 1;
              $('td:eq(0)',nRow).html(index);
              return nRow;
          },
        });
    });
</script>
<script src="public/admin/customs/function.js?v={{time()}}"></script>
<script> status_delete('subscribe'); </script>  
@endsection