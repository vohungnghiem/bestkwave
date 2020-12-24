@extends('admin.layout.master')
@section('title', 'Admincp | Edit Advertisement')
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
                    <h1>Edit Advertisement</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="admincp/advertisement">Advertisement</a></li>
                        <li class="breadcrumb-item active">Edit</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <form method="POST" action="{{url('admincp/advertisement/'.$advertisement->id.'/update')}}" autocomplete="off" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-5">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group" id="standad">
                                <label> Vị trí</label>
                                <select class="form-control select2bs4" name="standad"  style="width: 100%;">
                                    @foreach ($standads as $item)
                                        <option value="{{$item->id}}" @if($item->id == $advertisement->standad) selected @endif>{{$item->title}}</option>                                        
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="title"> Title </label>
                                <input type="text" name="title" value="{{$advertisement->title}}" class="form-control" placeholder="title" required>
                                @if($errors->first('title'))  
                                    <small class="form-text text-danger" >
                                        {!! $errors->first('title') !!}
                                    </small>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="link"> Link </label>
                                <input type="text" name="link" value="{{$advertisement->link}}" class="form-control @if ($errors->first('link')) is-invalid @endif" placeholder="link" >
                                @if($errors->first('link'))  
                                    <small class="form-text text-danger" >
                                        {!! $errors->first('link') !!}
                                    </small>
                                @endif
                            </div>

                            <div class="form-group">
                                <div class="">
                                    <a class="btn btn-primary iframe-btn fancy" href="public/tinymce/filemanager/dialog.php?type=0&field_id=none_img" data-fancybox-type="iframe"><i class="upload icon"></i> Tải Hình Ảnh</a>
                                    <span onclick="clear_img()"><i class="fas fa-trash-alt fa-1x"> </i> HỦY</span>
                                </div>
                                <br>
                                
                                @if ($advertisement->image)
                                    <img src="{{$advertisement->image}}" alt="" id="prev_img" class="medium  ui image bordered img-thumbnail">
                                @else
                                    <img src="public/admin/images/non_image.png'" alt="" id="prev_img" class="medium  ui image bordered img-thumbnail">
                                @endif
                                <input name="image" type="hidden" value="{{$advertisement->image}}" id="none_img" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="sort"> Sort </label>
                                <input type="number" name="sort" value="{{$advertisement->sort}}" class="form-control" placeholder="sort" style="width:100px" >
                            </div> 
                            <div class="form-group">
                                <label for=""> Status </label>
                                <input type="checkbox" name="status" @if ($advertisement->status == 1) checked @endif data-bootstrap-switch data-on-color="success">
                            </div> 
                            
                            <div>
                                <button class="btn btn-primary" type="submiti"> Confirm </button>
                                <button class="btn btn-secondary"type="reset"> Cancel </button>
                                <a class="btn btn-dark" href="admincp/advertisement"> Back list </a>
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
<style type="text/css">
    .form-group img {
        max-height: 400px;
    }
</style>
<link rel="stylesheet" href="public/fancybox/jquery.fancybox.css">
{{-- <script src="fancybox/vhn_customs/preview-img.js"></script> --}}
<link  href="public/fancybox/vhn_customs/preview-img.css">
<script src="public/fancybox/jquery.fancybox.pack.js"></script>
<script src="public/fancybox/vhn_customs/config_Fancybox.js"></script>
@endsection