@extends('admin.layout.master')
@section('title', 'Admincp | Edit Information')
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
                    <h1>Edit Information</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="admincp/information">Information</a></li>
                        <li class="breadcrumb-item active">Edit</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <form method="POST" action="{{url('admincp/information/'.$information->id.'/update')}}" autocomplete="off" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-5">
                    <div class="card">
                        <div class="card-body">
                            <select class="form-control select2bs4" name="type"  style="width: 100%;">
                                <option value="1" @if ($information->type == 1) selected @endif>Website</option>
                                <option value="2" @if ($information->type == 2) selected @endif>Phone</option>
                                <option value="3" @if ($information->type == 3) selected @endif>Email</option>
                                <option value="4" @if ($information->type == 4) selected @endif>Address</option> 
                                <option value="5" @if ($information->type == 5) selected @endif>E-MAGAZINE</option>                                                                            
                            </select>
                            <div class="form-group">
                                <label for="title"> Title </label>
                                <input type="text" name="title" value="{{$information->title}}" class="form-control" placeholder="title" required>
                                @if($errors->first('title'))  
                                    <small class="form-text text-danger" >
                                        {!! $errors->first('title') !!}
                                    </small>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="link"> Link </label>
                                <input type="text" name="link" value="{{$information->link}}" class="form-control" placeholder="link" >
                                @if($errors->first('link'))  
                                    <small class="form-text text-danger" >
                                        {!! $errors->first('link') !!}
                                    </small>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="sort"> Sort </label>
                                <input type="number" name="sort" value="{{$information->sort}}" class="form-control" placeholder="sort" style="width:100px" >
                            </div> 
                            <div class="form-group">
                                <label for=""> Status </label>
                                <input type="checkbox" name="status" @if ($information->status == 1) checked @endif data-bootstrap-switch data-on-color="success">
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