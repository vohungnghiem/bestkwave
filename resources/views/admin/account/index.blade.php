@extends('admin.layout.master')
@section('title', 'Admincp | Account')
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
                        <li class="breadcrumb-item"><a href="admincp/account">Account</a></li>
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
                            <h3 class="card-title"><a class="btn btn-primary" href="admincp/account/create">Create Account</a></h3>
                        </div>
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Avatar</th>
                                        <th>Status</th>    
                                        <th class="text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($accounts as $key => $item)
                                    <tr class="wraptr{{$item->id}}">
                                        <td>{{$key += 1}}</td>
                                        <td>{{$item->name}}</td>
                                        <td>{{$item->email}}</td>
                                        <td>{{$item->phone}}</td>
                                        <td>
                                            <img   src="{{'public/uploads/account/'.year($item->created_at).'/'.month($item->created_at).'/'.$item->avatar}}?rand={{md5(time())}}" 
                                            onerror="this.onerror=null; this.src='public/admin/images/non_image.png'" height="30px"/>
                                        </td>
                                        <td>
                                            <div class="wrapstatus">
                                                <a class="status" idstatus="{{$item->id}}"rootstatus="{{$item->status}}" status="">
                                                    @if ($item->status == 1)
                                                        <span class="text-success"> </span>
                                                    @else
                                                        <span class="text-warning"> </span>
                                                    @endif 
                                                </a>
                                            </div>
                                        </td>
                                        <td class="project-actions">
                                            <a  href="{{url('admincp/account/'.$item->id.'/edit')}}" data-popup="popover" data-trigger="hover" data-content="edit">
                                                <span class="badge badge-light"><i class="fas fa-pen-nib fa-2x"></i></span>
                                            </a>
                                            <a class="badge badge-light swalDefaultSuccess" idmethod="destroy" iddeleted="{{$item->id}}" idmodule="account" data-popup="popover" data-trigger="hover" data-content="remove">
                                                <i class="fas fa-trash-alt fa-2x"></i>
                                            </a>     
                                        </td>
                                    </tr>    
                                    @endforeach                                                
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Avatar</th>
                                        <th>Status</th>    
                                        <th class="text-center">Actions</th>
                                    </tr>
                                </tfoot>
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
    $(document).ready( function () {
        $("#example1").DataTable({
            "responsive": true, "lengthChange": false, "autoWidth": false,
            columnDefs: [
                {	orderable: false},
                { "width": "5%", "targets": 0},
                { "width": "10%", "targets": 4, "className": "text-center"},
                { "width": "10%", "targets": 5, "className": "text-center"},
                { "width": "10%", "targets": 6, "className": "text-center"},
            ],
        });
    });
</script>
<script src="public/admin/customs/function.js?v={{time()}}"></script>
<script> status_delete('account'); </script>  
@endsection