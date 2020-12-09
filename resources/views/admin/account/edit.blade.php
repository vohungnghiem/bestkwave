@extends('admin.layout.master')
@section('title', 'Admincp | Edit account')
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
                    <h1>Edit account</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="admincp/account">Account</a></li>
                        <li class="breadcrumb-item active">Edit</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <form method="POST" action="{{url('admincp/account/'.$account->id.'/update')}}" autocomplete="off" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="oldemail" value="{{$account->email}}">
            <input type="hidden" name="update" value="1">
            <div class="row">
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <label><i class="icon-arrow-right15"></i> Avatar</label>
                            <div class="text-center">
                                <label class="cabinet">
                                    <figure>                
                                        <img  @if($account->avatar) src="{{'public/uploads/account/'.year($account->created_at).'/'.month($account->created_at).'/'.$account->avatar}}?rand={{md5(time())}}" @else src="public/admin/images/non_image.png" @endif
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
                                <input type="checkbox" name="status" @if ($account->status == 1) checked @endif data-bootstrap-switch data-on-color="success">
                            </div> 
                        </div>
                    </div>   
                </div>
                <div class="col-md-5">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name"> Name </label>
                                <input type="text" name="name" value="{{$account->name}}" class="form-control @if ($errors->first('name')) is-invalid @endif" id="name" placeholder="name" >
                                @if($errors->first('name'))  
                                    <small class="form-text text-danger" >
                                        {!! $errors->first('name') !!}
                                    </small>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="Email"> Email </label>
                                <input class="form-control @if ($errors->first('email')) is-invalid @endif " id="Email" name="email" type="email" placeholder="Email" value="{{$account->email}}">
                                @if($errors->first('email'))  
                                    <small class="form-text text-danger" >
                                        {!! $errors->first('email') !!}
                                    </small>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="Phone"> Phone</label>
                                <input type="text" name="phone" value="{{$account->phone}}" class="form-control " id="phone">
                                @if($errors->first('phone'))  
                                    <small class="form-text text-danger" >
                                        {!! $errors->first('phone') !!}
                                    </small>
                                @endif
                            </div>
                          
                            <div class="form-group">
                                <label > Role</label>
                                <select class="form-control select2bs4" name="level" style="width: 100%;">
                                    <option selected="selected" value="2" @if ($account->level == 2) selected @endif >staff</option>
                                    <option value="1" @if ($account->level == 1) selected @endif >Admin</option>
                                  </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <legend class="text-uppercase font-size-sm font-weight-bold"> Change Password</legend>
                            <div class="form-group">
                                <label for="Password"> Password </label>
                                <input class="form-control @if($errors->first('password')) is-invalid @endif " name="password" id="Password" type="password" placeholder="Mật khẩu">
                                @if($errors->first('password'))  
                                    <small class="form-text text-danger" >
                                        {!! $errors->first('password') !!}
                                    </small>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="RePassword"> Confirm password</label>
                                <input class="form-control @if($errors->first('passwordagain')) is-invalid @endif" name="passwordagain" id="RePassword" type="password" placeholder="Xác nhận mật khẩu">
                                @if($errors->first('passwordagain'))  
                                    <small class="form-text text-danger" >
                                        {!! $errors->first('passwordagain') !!}
                                    </small>
                                @endif
                            </div>
                            <div>
                                <button class="btn btn-primary" type="submiti"> Confirm </button>
                                <button class="btn btn-secondary"type="reset"> Cancel </button>
                                <a class="btn btn-dark" href="admincp/account"> Back list </a>
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
                        <button type="button" id="cropImageBtn">Change password</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection
@section('javascript')
    <script src="public/admin/plugins/croppie/croppie.js"></script>
    <link rel="stylesheet" href="public/admin/plugins/croppie/croppie.css">
    <script src="public/admin/customs/image_avatar.js?v={{time()}}"></script>
    <script>cutimage(200,200)</script>
@endsection