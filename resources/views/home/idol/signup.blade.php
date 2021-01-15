@extends('home.layout.master')
@section('title',' Best Idol')
@section('description', 'Ấn phẩm mang những thông tin giải trí và văn hóa Hàn Quốc hữu ích cho độc giả Việt Nam')
@section('header')
@include('home.layout.header-two')
@endsection
@section('content')
<section id="signup">
    <nav aria-label="breadcrumb">
		<ol class="breadcrumb">
		  <li class="breadcrumb-item"><a href="idol/statistic">BEST IDOL</a></li>
		  <li class="breadcrumb-item active" aria-current="page">Đăng ký</li>
		</ol>
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
        
        <div class="col-md-4 col-12"></div>
        <div class="col-md-4 col-12">
            <div class="form-title text-center">
                <h2 class="m-4">Đăng ký</h2>
            </div>
            <div class="d-flex flex-column">
                <form action="logauth/signup" method="post" id="loginLogAuth">
                    @csrf
                    <div class="form-group">
                        <input type="text" name="name" class="form-control {{ $errors->has('name') ? 'is-invalid' : ''}}" id="nameLogAuth" placeholder="Tên của bạn..." value="{{old('name')}}" >
                        <div class="invalid-feedback">{{$errors->first('name')}}</div>
                    </div>
                    <div class="form-group">
                        <input type="email" name="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : ''}}" id="emailLogAuth" placeholder="Email của bạn..." value="{{old('email')}}">
                        <div class="invalid-feedback">{{$errors->first('email')}}</div>
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : ''}}" id="passwordLogAuth" placeholder="Mật khẩu..." >
                        <div class="invalid-feedback">{{$errors->first('password')}}</div>
                    </div>
                    <div class="form-group">
                        <input type="password" name="passwordVerify" class="form-control {{ $errors->has('passwordVerify') ? 'is-invalid' : ''}}" id="passwordVerify" placeholder="Xác nhân mật khẩu..." >
                        <div class="invalid-feedback">{{$errors->first('passwordVerify')}}</div>
                    </div>
                    <div class="form-group">
                        <div class="icheck-secondary">
                            <input type="checkbox" name="remember" id="rememberLogAuth" checked >
                            <label for="remember">
                                Remember Me
                            </label>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-info btn-block btn-round">Signup</button>
                </form>
            </div>
        </div>
    </div>
</section>    
@endsection
@push('script')
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
    <script>
		$(document).ready(function() {
			var remember = $.cookie('rememberLogAuth');
			if (remember == 'true') 
			{
				var email = $.cookie('emailLogAuth');
				var password = atob($.cookie('passwordLogAuth'));
				$('#emailLogAuth').val(email);
				$('#passwordLogAuth').val(password);
				$('#rememberLogAuth').prop('checked', true);
			}
			$("#loginLogAuth").submit(function() {
				if ($('#rememberLogAuth').is(':checked')) {
					var email = $('#emailLogAuth').val();
					var password = btoa($('#passwordLogAuth').val());
					$.cookie('emailLogAuth', email, { expires: 365 });
					$.cookie('passwordLogAuth', password, { expires: 365 });
					$.cookie('rememberLogAuth', true, { expires: 365 });
				}
				else
				{
					$.cookie('emailLogAuth', null);
					$.cookie('passwordLogAuth', null);
					$.cookie('rememberLogAuth', null);
				}
			});

			$("#resetLogAuth").click(function() {
				$.cookie('emailLogAuth', null);
				$.cookie('passwordLogAuth', null);
				$.cookie('rememberLogAuth', null);
			});

		});
	</script>
@endpush