@extends('admin.layout.master')
@section('title', 'Admincp | Idol Client')
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
                        <li class="breadcrumb-item"><a href="admincp/idolclient">Idol Client</a></li>
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
                        
                        <div class="card-body">
                            <form method="GET" action="{{url('admincp/idolclient/client')}}" autocomplete="off" enctype="multipart/form-data">
                                {{-- @csrf --}}
                                <div class="row">
                                    <div class="form-group col-2">
                                        <label > Tháng</label>
                                        <select class="form-control select2bs4" name="month" style="width: 100%;">
                                            <option value="0">ALL</option>
                                            @for ($i = 1; $i <= 12; $i++)
                                                <option value="{{$i}}" @if ($i == $month) selected @endif>tháng {{$i}}</option>
                                            @endfor
                                        </select>
                                    </div>
                                    <div class="form-group col-2">
                                        <label > Năm</label>
                                        <select class="form-control select2bs4" name="year" style="width: 100%;">
                                            <option value="0">ALL</option>
                                            @for ($i = date('Y'); $i >= 2020; $i--)
                                                <option value="{{$i}}" @if ($i == $year) selected @endif>năm {{$i}}</option>
                                            @endfor
                                            
                                        </select>
                                    </div>
                                    <div class="form-group col-1">
                                        <label > Xác nhận</label>
                                        <button type="submit" class="btn btn-primary btn-sm form-control">Submit</button>
                                    </div>
                                </div>
                            </form>
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Tài khoản</th>
                                        <th>Provider</th>
                                        <th>Phone</th>
                                        <th>Vote</th>
                                        <th>Like</th>
                                        <th class="text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($clients as $key => $item)
                                    <tr class="wraptr{{$item->id}}">
                                        <td>{{$key += 1}}</td>
                                        <td>{{$item->name}}</td>
                                        <td>{{$item->email}}</td>
                                        <td>{{$item->provider}}</td>
                                        <td>{{$item->phone}}</td>
                                        <td>{{$item->sumvote}}</td>
                                        <td>{{$item->sumlike}}</td>
                                        <td >
                                            <a href="admincp/idolclient/idol?id={{$item->id}}" class="badge badge-light">
                                                <i class="far fa-eye fa-2x"></i>
                                            </a>     
                                        </td>
                                    </tr>    
                                    @endforeach                                                
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Tài khoản</th>
                                        <th>Provider</th>
                                        <th>Phone</th>    
                                        <th>Vote</th>
                                        <th>Like</th>
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
                { "width": "10%", "targets": 3, "className": "text-center"},
                { "width": "10%", "targets": 4, "className": "text-center"},
                { "width": "10%", "targets": 5, "className": "text-center"},
            ],
        });
    });
</script>
<script src="public/admin/customs/function.js?v={{time()}}"></script>
<script> status_delete('idol'); </script>  
@endsection