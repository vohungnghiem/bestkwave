@extends('admin.layout.master')
@section('title', 'Admincp | Client Idol')
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
                        <li class="breadcrumb-item"><a href="admincp/idol">Idol</a></li>
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
                            <h3 class="card-title"><a class="btn btn-primary" href="admincp/idolclient/client">Về Danh sách khách hàng</a></h3>
                        </div>
                        <div class="card-body">
                            <form method="GET" action="{{url('admincp/idolclient/idol')}}" autocomplete="off" enctype="multipart/form-data">
                                {{-- @csrf --}}
                                <input type="hidden" name="id" value="{{$id}}">
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
                                        <th>Nickname</th>
                                        <th>Avatar</th>
                                        <th>Vote</th>
                                        <th>Like</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($idols as $key => $item)
                                    <tr class="wraptr{{$item->id}}">
                                        <td>{{$key += 1}}</td>
                                        <td>{{$item->name}}</td>
                                        <td>{{$item->nickname}}</td>
                                        <td>
                                            <img   src="{{'public/uploads/idol/'.year($item->created_at).'/'.month($item->created_at).'/'.$item->avatar}}?rand={{md5(time())}}" 
                                            onerror="this.onerror=null; this.src='public/admin/images/non_image.png'" height="30px"/>
                                        </td>
                                        <td>{{$item->sumvote}}</td>
                                        <td>{{$item->sumlike}}</td>
                                    </tr>    
                                    @endforeach                                                
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Nickname</th>
                                        <th>Avatar</th>
                                        <th>Vote</th>
                                        <th>Like</th>
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