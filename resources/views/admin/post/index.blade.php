@extends('admin.layout.master')
@section('title', 'Admincp | Posts')
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
                    @if (isset($type) && ($type == 2))
                        <h1>Banner</h1>
                    @else 
                        <h1>Post</h1>
                    @endif
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="admincp/post">Post</a></li>
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
                        <h3 class="card-title">
                            @if (isset($type) && ($type == 2))
                                <a class="btn btn-primary" href="admincp/post/create?type=2">Create banner</a>
                            @else
                                <a class="btn btn-primary" href="admincp/post/create">Create post</a>                                
                            @endif
                        </h3>
                        </div>
                        <div class="card-body">
                            
                            <table class="table table-bordered" id="example1">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Title</th>
                                        <th>Category</th>
                                        <th>Image</th>
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
            stateSave: true,
            processing: true,
            serverSide: true,
            "responsive": true, "lengthChange": false, "autoWidth": false,
            ajax: 'admincp/datatables/post',
            columns: [
                { data: 'id', name: 'id', "width": "5%" },
                { data: 'title', name: 'title', "width": "25%" },
                { data: 'category', name: 'category', "width": "20%" },
                { data: 'image', name: 'image', "width": "10%", "className": "text-center" },
                { data: 'sort', name: 'sort', "width": "10%", "className": "text-center" },
                { data: 'status', name: 'status', "width": "10%", "className": "text-center" },
                { data: 'action', name: 'action', "width": "10%", "className": "text-center" },
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
<script> status_delete('post'); </script>  
<style>
    img {
        height: 40px;
    }
    a {
        color: black;
    }
</style>
@endsection