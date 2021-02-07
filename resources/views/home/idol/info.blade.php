@extends('home.layout.master')
@section('title',' Best Idol')
@section('description', 'Ấn phẩm mang những thông tin giải trí và văn hóa Hàn Quốc hữu ích cho độc giả Việt Nam')
@section('header')
@include('home.layout.header-two')
@endsection
@section('content')
<section id="signup">

    <nav id="breadcrumb" >
		<ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="idol/statistic"><i class="fas fa-arrow-alt-circle-left"></i> BEST IDOL</a></li>
            <li class="breadcrumb-item active" aria-current="page">Thông tin tài khoản</li>
		</ol>
        @if(Auth::user())
        <div class="dropdown">
            <div class="bread-right " id="dropdownMenuButton" data-toggle="dropdown"> 
                <span>{{Auth::user()->name}}</span> 
                @if (Auth::user()->avatar != '')
                    <img src="{{Auth::user()->avatar}}" alt="{{Auth::user()->name}}"  onerror="this.onerror=null; this.src='public/home/image/non_avatar.png'">
                @else
                    <i class="far fa-user"></i>
                @endif
            </div>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" href="logauth/info/{{Auth::user()->id}}"><i class="far fa-user"></i> Tên: {{Auth::user()->name}}</a>
                <a class="dropdown-item" href="logauth/info/{{Auth::user()->id}}"><i class="fas fa-people-arrows"></i> Tài khoản: {{Auth::user()->provider}}</a>
                <a class="dropdown-item" href="logauth/logout"><i class="fas fa-sign-out-alt"></i> Đăng xuất</a>
            </div>
        </div>
        @else
        <div class="dropdown" data-toggle="modal" data-target="#loginModal">
            <div  class="bread-right "> 
                <span>Đăng nhập</span> <i class="far fa-user"></i>
            </div>
        </div>
        @endif
	</nav>
    <div class="row">
        <div class="col-12">
            @if(session('error'))
                <div class="alert alert-danger">
                    {{session('error')}}
                </div>
            @endif
            @if(session('success'))
                <div class="alert alert-success">
                    {{session('success')}}
                </div>
            @endif
        </div>        
        
        <div class="col-md-4 col-12">
            <div class="form-title text-left">
                <h2 class="mt-4">Thông tin</h2>
            </div>
            <div class="row">
                <div class="col-md-4 col-4" ><img style="max-width: 100px" src="{{$user->avatar}}" onerror="this.onerror=null; this.src='public/home/image/non_avatar.png'" alt=""></div>
                <div class="col-md-8 col-8">
                    <p><i class="far fa-user"></i> : {{$user->name}}</p>
                    <p><i class="fas fa-people-arrows"></i> : {{Auth::user()->provider}}</p>
                    <p><i class="fas fa-envelope-square"></i> : <span style="font-size: 12px"> {{Auth::user()->email}}</span></p>
                </div>
                <div class="col-12">
                    <h6>Đổi mật khẩu</h6>
                    @if ( ($user->provider == 'system') )
                    <form action="logauth/info/changepassword/{{$user->id}}" method="post" id="loginLogAuth">
                        @csrf
                        <div class="form-group">
                            <input type="password" name="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : ''}}" placeholder="Mật khẩu mới..." >
                            <div class="invalid-feedback">{{$errors->first('password')}}</div>
                        </div>
                        <div class="form-group">
                            <input type="password" name="passwordVerify" class="form-control {{ $errors->has('passwordVerify') ? 'is-invalid' : ''}}" placeholder="Xác nhận mật khẩu..." >
                            <div class="invalid-feedback">{{$errors->first('passwordVerify')}}</div>
                        </div>
                        <button type="submit" class="btn btn-info btn-block btn-round">Xác nhận</button>
                    </form>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-md-8 col-12">
            <div class="form-title text-center">
                <h2 class="m-4">Xem lược sử vote</h2>
            </div>
            <table class="col-md-12 table-striped ">
                <thead >
                    <tr>
                        <th width="10%">Hình</th>
                        <th width="32%">Tên</th>
                        <th width="30%" class="text-right">Ngày bỏ phiếu</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($lists as $item)
                    <tr>
                        <td data-title="Hình" class="img-rank"><img height="50" src="public/uploads/idol/{{year($item->created_at)}}/{{month($item->created_at)}}/{{$item->avatar}}" alt=""></td>
                        <td data-title="Tên"> {{$item->nickname}}</td>
                        <td data-title="" class="text-right"><a href="idol/detail/{{$item->id}}" class="btn btn-sm btn-secondary">{{$item->datevote}}</a></td>
                    </tr>	
                    @endforeach
                    
                </tbody>
            </table>
            <nav aria-label="Page navigation example " >
				<div class="pagination justify-content-center mt-3">
				  {{ $lists->onEachSide(2)->links() }}
				</div>
			  </nav>
        </div>
    </div>
</section>    
@endsection
@push('script')
@endpush