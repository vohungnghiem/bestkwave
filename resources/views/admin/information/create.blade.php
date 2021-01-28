@extends('admin.layout.master')
@section('title', 'Admincp | Create Information')
@section('content')
@if (session('error'))
    <div class="alert alert-danger">
        {{session('error')}}
    </div>
@endif
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Create Information</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="admincp/information">Information</a></li>
                        <li class="breadcrumb-item active">Create</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <form method="POST" action="{{url('admincp/information/store')}}" autocomplete="off" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-5">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group" id="type">
                                <label> Type</label>
                                <select class="form-control select2bs4" name="type"  style="width: 100%;">
                                    <option value="1">Website</option>
                                    <option value="2">Phone</option>
                                    <option value="3">Email</option>
                                    <option value="4">Address</option>     
                                    <option value="5">E-MAGAZINE</option>
                                    <option value="6">IDOL</option>                                                                          
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="title"> Title </label>
                                <input type="text" name="title" value="{{old('title')}}" class="form-control @if ($errors->first('title')) is-invalid @endif" placeholder="title" required>
                                @if($errors->first('title'))  
                                    <small class="form-text text-danger" >
                                        {!! $errors->first('title') !!}
                                    </small>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="link"> Link </label>
                                <input type="text" name="link" value="{{old('link')}}" class="form-control @if ($errors->first('link')) is-invalid @endif" placeholder="link" >
                                @if($errors->first('link'))  
                                    <small class="form-text text-danger" >
                                        {!! $errors->first('link') !!}
                                    </small>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="sort"> Sort </label>
                                <input type="number" name="sort" value="{{$sort}}" class="form-control " placeholder="sort" style="width:100px" >
                            </div> 
                            <div class="form-group">
                                <label for=""> Trạng thái</label>
                                <input type="checkbox" name="status" checked data-bootstrap-switch data-on-color="success">
                            </div> 
                            <div>
                                <button class="btn btn-primary" type="submiti"> Confirm </button>
                                <button class="btn btn-secondary"type="reset"> Cancel </button>
                                <a class="btn btn-dark" href="admincp/information"> Back list </a>
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