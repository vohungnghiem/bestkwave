@extends('admin.layout.master')
@section('title', 'Admincp | Edit Job Subscribe')
@section('content')

<div class="content-wrapper">
    @if (session('success'))
        <div class="alert alert-success">
            {{session('success')}}
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger">
            {{session('error')}}
        </div>
    @endif
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Job Subscribe</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="admincp/sub/subjob">Job Subscribe</a></li>
                        <li class="breadcrumb-item active">Edit</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <form method="POST" action="{{url('admincp/sub/subjob/'.$subjob->id.'/update')}}" autocomplete="off" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-5">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="title"> Title </label>
                                <input type="text" name="title" value="{{$subjob->title}}" class="form-control" placeholder="title" required>
                                @if($errors->first('title'))  
                                    <small class="form-text text-danger" >
                                        {!! $errors->first('title') !!}
                                    </small>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="sort"> Sort </label>
                                <input type="number" name="sort" value="{{$subjob->sort}}" class="form-control" placeholder="sort" style="width:100px" >
                            </div> 
                            <div class="form-group">
                                <label for=""> Status</label>
                                <input type="checkbox" name="status" @if ($subjob->status == 1) checked @endif data-bootstrap-switch data-on-color="success">
                            </div> 
                            
                            <div>
                                <button class="btn btn-primary" type="submiti"> Confirm </button>
                                <button class="btn btn-secondary"type="reset"> Cancel </button>
                                <a class="btn btn-dark" href="admincp/sub/subjob"> Back list </a>
                            </div>  
                        </div>
                    </div>   
                </div>
                <div class="col-md-5">
                    <div class="card">
                       
                    </div>
                </div>
                <div class="col-md-2">
                </div>
            </div> 
        </form>
    </section>
</div>

@endsection
@section('javascript')

@endsection