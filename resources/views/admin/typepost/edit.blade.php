@extends('admin.layout.master')
@section('title', 'Admincp | Edit Type of Post')
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
                    <h1>Edit Type of Post</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="admincp/typepost">Type of Post</a></li>
                        <li class="breadcrumb-item active">Edit</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <form method="POST" action="{{url('admincp/typepost/'.$typepost->id.'/update')}}" autocomplete="off" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-5">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="title"> Title </label>
                                <input type="text" name="title" value="{{$typepost->title}}" class="form-control" id="title" placeholder="title" required >
                                @if($errors->first('title'))  
                                    <small class="form-text text-danger" >
                                        {!! $errors->first('title') !!}
                                    </small>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="sort"> Sort </label>
                                <input type="number" name="sort" value="{{$typepost->sort}}" class="form-control " id="title" placeholder="sort" style="width:100px" >
                            </div> 
                            <div class="form-group">
                                <label for=""> Status</label>
                                <input type="checkbox" name="status" @if ($typepost->status == 1) checked @endif data-bootstrap-switch data-on-color="success">
                            </div> 
                            
                            <div>
                                <button class="btn btn-primary" type="submiti"> Confirm </button>
                                <button class="btn btn-secondary"type="reset"> Cancel </button>
                                <a class="btn btn-dark" href="admincp/typepost"> Back list </a>
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