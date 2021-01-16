@extends('admin.layout.master')
@section('title', 'Admincp | Create Idol')
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
                    <h1>Create Idol</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="admincp/idol">Idol</a></li>
                        <li class="breadcrumb-item active">create</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <form method="POST" action="{{url('admincp/idol/store')}}" autocomplete="off" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="avatar_hidden" value="">
            <div class="row">
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <label> Avatar</label>
                            <div class="text-center">
                                <label class="cabinet">
                                    <figure>
                                        <img src="public/admin/images/non_image.png" 
                                            onerror="this.onerror=null; this.src='public/admin/images/non_image.png'" 
                                            class="gambar img-responsive img-thumbnail" id="item-img-output" 
                                        />
                                        <figcaption><i class="icon-camera"></i> <i class="icon-trash" style="z-index: 100"></i></figcaption>
                                        <label class="custom-upload"><input type="file" class="item-img file center-block" name="file_photo" accept="image/x-png,image/gif,image/jpeg"/>upload file</label>
                                        <label class="icon-trash">Cancel</label>
                                        <input type="hidden" class="avatar file center-block" name="avatar"/>
                                    </figure>     
                                </label>
                            </div>  
                            
                            <div class="form-group">
                                <label for=""> Status</label>
                                <input type="checkbox" name="status" checked data-bootstrap-switch data-on-color="success">
                            </div> 
                             
                        </div>
                    </div>   
                </div>
                <div class="col-md-5">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name"> Name (Tên thật)</label>
                                <input type="text" name="name" value="{{old('name')}}"
                                        class="form-control @if ($errors->first('name')) is-invalid @endif" id="name" placeholder="name" >
                            </div>
                            <div class="form-group">
                                <label for="nickname"> Nickname (Tên)</label>
                                <input class="form-control @if ($errors->first('nickname')) is-invalid @endif " id="nickname" name="nickname" placeholder="Nickname" value="{{old('nickname')}}">
                            </div>
                            <div class="form-group">
                                <label for="agency_name"> Agency name (Tên công ty quản lý)</label>
                                <input type="text" name="agency_name" value="{{old('agency_name')}}" class="form-control " id="agency_name" placeholder="Agency name">
                            </div>
                            <div class="form-group">
                                <label for="group_name"> Group name (Tên nhóm nhạc)</label>
                                <input type="text" name="group_name" value="{{old('group_name')}}" class="form-control " id="group_name" placeholder="Group name">
                            </div>
                          
                            <div class="form-group">
                                <label > Profession (Nghề)</label>
                                <select class="form-control select2bs4" name="profession_id" style="width: 100%;">
                                    @foreach ($professions as $item)
                                        <option value="{{$item->id}}">{{$item->title}}</option>                                    
                                    @endforeach
                                  </select>
                            </div>
                            <div class="form-group">
                                <label for="nature"> Quê quán</label>
                                <input type="text" name="nature" value="{{old('nature')}}" class="form-control " id="nature" placeholder=" Quê quán">
                            </div>
                            <div class="form-group">
                                <label > Gender (Giới tính)</label>
                                <select class="form-control select2bs4" name="gender_id" style="width: 100%;">
                                    @foreach ($genders as $item)
                                        <option value="{{$item->id}}">{{$item->title}}</option>                                    
                                    @endforeach
                                  </select>
                            </div>
                            <div class="form-group">
                                <label > Height (chiều cao)</label>
                                <div class="input-group">
                                    <input type="text" name="height" class="form-control" placeholder="Height (chiều cao)" value="{{old('height')}}">
                                    <div class="input-group-append">
                                    <span class="input-group-text">cm</span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label > Weight (cân nặng)</label>
                                <div class="input-group">
                                    <input type="text" name="weight" class="form-control" placeholder="Weight (cân nặng)" value="{{old('weight')}}">
                                    <div class="input-group-append">
                                    <span class="input-group-text">kg</span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Birthday: ngày / tháng / năm</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                    </div>
                                    <input type="text" name="birthday" value={{old('birthday')}} class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask="" im-insert="false">
                                </div>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary" type="submiti"> Confirm </button>
                                <button class="btn btn-secondary"type="reset"> Cancel </button>
                                <a class="btn btn-dark" href="admincp/idol"> Back list </a>
                            </div>  
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                    <a class="iframe-btn fancy" href="public/tinymce/filemanager/dialog.php?type=0&field_id=none_img" data-fancybox-type="iframe">
                                        <i class="fas fa-upload"></i> Tải Gallery </a>
                                <br>
                                <div class="grid-container row">
                                    {{-- image here --}}
                                </div>
                                <input type="hidden" id="none_img">
                            </div>
                        </div>
                    </div>
                </div>
            </div> 
        </form>
        <div id="cropImagePop" class="modal fade" tabindex="-1">
            <div class="modal-dialog">
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
    <script>
        $(document).ready(function() {
            $('[data-mask]').inputmask()
        });
    </script>
    <script src="public/admin/plugins/croppie/croppie.js"></script>
    <link rel="stylesheet" href="public/admin/plugins/croppie/croppie.css">
    <script src="public/admin/customs/image_avatar.js?v={{time()}}"></script>
    <script>cutimage(250,345)</script>
    <link rel="stylesheet" href="public/fancybox/jquery.fancybox.css">
    <link rel="stylesheet" href="public/fancybox/vhn_customs/preview-img.css">
    {{-- <script src="public/fancybox/vhn_customs/preview-img.js"></script> --}}
    <script src="public/fancybox/jquery.fancybox.pack.js"></script>
    <script src="public/fancybox/vhn_customs/config_Fancybox_gallery.js"></script>
@endsection