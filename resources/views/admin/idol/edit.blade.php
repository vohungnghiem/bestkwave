@extends('admin.layout.master')
@section('title', 'Admincp | Edit Idol')
@section('content')

<div class="content-wrapper">
    @if (session('success'))
        <div class="alert alert-success">
            {{session('success')}}
        </div>
    @endif

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Idol</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="admincp/idol">Idol</a></li>
                        <li class="breadcrumb-item active">Edit</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <form method="POST" action="{{url('admincp/idol/'.$idol->id.'/update')}}" autocomplete="off" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <label><i class="icon-arrow-right15"></i> Avatar</label>
                            <div class="text-center">
                                <label class="cabinet">
                                    <figure>                
                                        <img  @if($idol->avatar) src="{{'public/uploads/idol/'.year($idol->created_at).'/'.month($idol->created_at).'/'.$idol->avatar}}?rand={{md5(time())}}" @else src="public/admin/images/non_image.png" @endif
                                            onerror="this.onerror=null; this.src='public/admin/images/non_image.png'" 
                                            class="gambar img-responsive img-thumbnail" id="item-img-output" 
                                        />
                                        <figcaption><i class="icon-camera"></i> <i class="icon-trash" style="z-index: 100"></i></figcaption>
                                        <label class="custom-upload"><input type="file" class="item-img file center-block" name="file_photo" accept="image/x-png,image/gif,image/jpeg"/>Upload image</label>
                                        <label class="icon-trash">cancel</label>
                                        <input type="hidden" class="avatar file center-block" name="avatar"/>
                                    </figure>     
                                </label>
                            </div>  
                            <div class="form-group">
                                <label for=""> Status</label>
                                <input type="checkbox" name="status" @if ($idol->status == 1) checked @endif data-bootstrap-switch data-on-color="success">
                            </div> 
                        </div>
                    </div>   
                </div>
                <div class="col-md-5">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name"> Name (Tên thật)</label>
                                <input type="text" name="name" value="{{$idol->name}}" class="form-control " id="name" placeholder="name" >
                            </div>
                            <div class="form-group">
                                <label for="nickname"> Nickname (Tên)</label>
                                <input class="form-control " id="nickname" name="nickname" placeholder="Nickname" value="{{$idol->nickname}}">
                            </div>
                            <div class="form-group">
                                <label for="agency_name"> Agency name (Tên đại lý)</label>
                                <input type="text" name="agency_name" value="{{$idol->agency_name}}" class="form-control " id="agency_name" placeholder="Agency name">
                            </div>
                            <div class="form-group">
                                <label for="group_name"> Group name (Tên nhóm nhạc)</label>
                                <input type="text" name="group_name" value="{{$idol->group_name}}" class="form-control " id="group_name" placeholder="Group name">
                            </div>
                          
                            <div class="form-group">
                                <label > Profession (Nghề)</label>
                                <select class="form-control select2bs4" name="profession_id" style="width: 100%;">
                                    @foreach ($professions as $item)
                                        <option @if ($idol->profession_id == $item->id) selected @endif value="{{$item->id}}">{{$item->title}}</option>                                    
                                    @endforeach
                                  </select>
                            </div>
                            <div class="form-group">
                                <label for="nature"> Quê quán</label>
                                <input type="text" name="nature" value="{{$idol->nature}}" class="form-control " id="nature" placeholder=" Quê quán">
                            </div>
                            <div class="form-group">
                                <label > Gender (Giới tính)</label>
                                <select class="form-control select2bs4" name="gender_id" style="width: 100%;">
                                    @foreach ($genders as $item)
                                        <option @if ($idol->gender_id == $item->id) selected @endif value="{{$item->id}}">{{$item->title}}</option>                                    
                                    @endforeach
                                  </select>
                            </div>
                            <div class="form-group">
                                <label > Height (chiều cao)</label>
                                <div class="input-group">
                                    <input type="text" name="height" class="form-control" placeholder="Height (chiều cao)" value="{{$idol->height}}">
                                    <div class="input-group-append">
                                    <span class="input-group-text">cm</span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label > Weight (cân nặng)</label>
                                <div class="input-group">
                                    <input type="text" name="weight" class="form-control" placeholder="Weight (cân nặng)" value="{{$idol->weight}}">
                                    <div class="input-group-append">
                                    <span class="input-group-text">kg</span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Birthday: </label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                    </div>
                                    @php
                                        $date = date_create($idol->birthday);
                                        $birthday = date_format($date,"d/m/Y");
                                    @endphp
                                    <input type="text" name="birthday" value={{$birthday}} class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask="" im-insert="false">
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
                                    <a class="iframe-btn fancy" href="tinymce/filemanager/dialog.php?type=0&field_id=none_img" data-fancybox-type="iframe">
                                        <i class="fas fa-upload"></i> Tải Gallery </a>
                                <br>
                                <div class="grid-container row">
                                    {{-- image here --}}
                                    @foreach ($gallery as $item)
                                        <article class="location-listing col-6" >
                                            <span class="location-title">
                                                <div>  <i class="fas fa-trash-alt trash"></i> </div>
                                                {{-- <div> <i class="flag outline icon" linkimg="'+res[i]+'"></i> </div> --}}
                                            </span>
                                            <div class="location-image"><img src="{{$item->image}}"  class="prev_img"></div>
                                            <input name="gallery[]" type="hidden" value="{{$item->image}}">
                                        </article>
                                    @endforeach
                                        
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