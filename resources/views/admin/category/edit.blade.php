@extends('admin.layout.master')
@section('title', 'Admincp | Edit Category')
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
                    <h1>Edit Category</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="admincp/category/0/list">Category</a></li>
                        <li class="breadcrumb-item active">Edit</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <form method="POST" action="{{url('admincp/category/'.$category->id.'/update')}}" autocomplete="off" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-5">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <label> Category Parent</label>
                                <select class="form-control select2bs4" name="parent" style="width: 100%;">
                                    <option selected="selected" value="0">ROOT CATEGORY</option>
                                    {{showCategoriesSelected($categories,0,'',$category->parent)}}
                                  </select>
                            </div>
                            <div class="form-group">
                                <label for="title"> Title </label>
                                <input type="text" name="title" value="{{$category->title}}" class="form-control @if ($errors->first('title')) is-invalid @endif" id="title" placeholder="title" >
                                @if($errors->first('title'))  
                                    <small class="form-text text-danger" >
                                        {!! $errors->first('title') !!}
                                    </small>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for=""> Status</label>
                                <input type="checkbox" name="status" @if ($category->status == 1) checked @endif data-bootstrap-switch data-on-color="success">
                            </div> 
                            <div>
                                <button class="btn btn-primary" type="submiti"> Confirm </button>
                                <button class="btn btn-secondary"type="reset"> Cancel </button>
                                <a class="btn btn-dark" href="admincp/category/0/list"> Back list </a>
                            </div>  
                        </div>
                    </div>   
                </div>
                <div class="col-md-5">
                    <div class="card">
                        <div class="card-header">
                            <strong>Category Tree</strong>
                        </div>
                        <div class="card-body">
                            <div class="tree"> 
                                {{editCategoriesSelected($categories,0,'',$category->parent)}}
                            </div>
                        </div>
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