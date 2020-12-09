@extends('admin.layout.master')
@section('title', 'Admincp | Create Banner')
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
                    <h1>Create Banner</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="admincp/banner">Banner</a></li>
                        <li class="breadcrumb-item active">Create</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <form method="POST" action="{{url('admincp/post/store')}}" autocomplete="off" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <strong>Article</strong>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label> Category</label>
                                <select class="form-control select2bs4" name="category" style="width: 100%;">
                                    {{showCategories($categories)}}
                                </select>
                            </div>
                            <div class="form-group" id="type_post">
                                <label> Type of post</label>
                                <select class="form-control select2bs4" name="type_post"  style="width: 100%;">
                                    @foreach ($typeposts as $item)
                                        <option value="{{$item->id}}">{{$item->title}}</option>                                        
                                    @endforeach
                                </select>
                            </div>
                            <label> Thumb</label>
                            <div class="text-center">
                                <label class="cabinet">
                                    <figure>
                                        <img src="public/admin/images/non_image.png" 
                                            onerror="this.onerror=null; this.src='public/admin/images/non_image.png'" 
                                            class="gambar img-responsive img-thumbnail" id="item-img-output" 
                                        />
                                        <figcaption><i class="icon-camera"></i> <i class="icon-trash" style="z-index: 100"></i></figcaption>
                                        <label class="custom-upload"><input type="file" class="item-img file center-block" name="file_photo" accept="image/x-png,image/gif,image/jpeg"/>Upload image</label>
                                        <label class="icon-trash">Cancel</label>
                                        <input type="hidden" class="avatar file center-block" name="image"/>
                                    </figure>     
                                </label>
                            </div>  
                            <div class="form-group">
                                <label for="title"> Title </label>
                                <input type="text" name="title" value="{{old('title')}}" class="form-control @if ($errors->first('title')) is-invalid @endif" id="title" placeholder="title" required>
                                @if($errors->first('title'))  
                                    <small class="form-text text-danger" >
                                        {!! $errors->first('title') !!}
                                    </small>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="caption"> Caption </label>
                                <textarea name="caption" class="form-control" rows="5">{{old('caption')}}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="link"> Link </label>
                                <input type="text" name="link" value="{{old('link')}}" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for=""> Status</label>
                                <input type="checkbox" name="status" checked data-bootstrap-switch data-on-color="success">
                            </div> 
                            <div>
                                <button class="btn btn-primary" type="submiti"> Confirm </button>
                                <button class="btn btn-secondary"type="reset"> Cancel </button>
                                <a class="btn btn-dark" href="admincp/banner"> Back list </a>
                            </div>  
                        </div>
                    </div>   
                    <div class="card">
                        <div class="card-header">
                            <strong>Social </strong>
                        </div>
                        <div class="card-body">
                            @foreach ($socials as $item)
                                <div class="form-group">
                                    <label> {{$item->title}} </label>
                                    <input type="text" name="social[{{$item->id}}]" class="form-control"> 
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <strong>SEO</strong>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="description"> Description </label>
                                <textarea name="description" class="form-control" rows="5">{{old('description')}}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="key"> Key </label>
                                <input type="text" name="key" value="{{old('key')}}" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <strong>Content</strong>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <textarea name="content" class="form-control textarea-400">{{old('content')}}</textarea>
                            </div>
                            <div class="ui bottom attached tab segment active" data-tab="first"> </div>
                        </div>
                    </div>
                </div>
            </div> 
        </form>
        <div id="cropImagePop" class="modal fade" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Crop image</h5>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div id="upload-demo" class="center-block"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                        <button type="button" id="cropImageBtn">Change</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
@section('javascript')
    <script src="public/tinymce/tinymce.min.js?v={{time()}}"></script>
    <script src="public/tinymce/config_Tinymce.js?v={{time()}}"></script>

    <script src="public/admin/plugins/croppie/croppie.js"></script>
    <link rel="stylesheet" href="public/admin/plugins/croppie/croppie.css">
    <script src="public/admin/customs/image_avatar.js?v={{time()}}"></script>
   {{-- <script>cutimage(830,320)</script> --}}
    <script>cutimage(970,400)</script>
    <style>
        .modal-lg {
            max-width: 1100px !important;
        }
    </style>
@endsection