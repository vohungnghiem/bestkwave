<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <base href="{{asset('')}}">
	<title>@yield('title') Login</title>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="public/admin/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="public/admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <link rel="stylesheet" href="public/admin/dist/css/adminlte.min.css">
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <a href="admincp"><b>Admin</b> control panel</a>
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Sign in to start your session</p>
                @if (count($errors) >0)
                    <div class="alert alert-danger">
                        @foreach($errors->all() as $error)
                        {{$error}}<br>
                        @endforeach
                        Errors !
                    </div>
                @endif
                @if (session('status'))
                    <ul>
                        <li class="text-danger"> {{ session('status') }}</li>
                    </ul>
                @endif
                <form action="{{ route('getLogin') }}" method="post" id="login">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="email" name="txtEmail" value="{{old('txtEmail')}}" id="email" class="form-control" placeholder="Email">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" name="txtPassword" id="password" class="form-control" placeholder="Password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-8">
                            <div class="icheck-secondary">
                                <input type="checkbox" name="remember" id="remember" checked >
                                <label for="remember">
                                    Remember Me
                                </label>
                            </div>
                        </div>
                        <div class="col-4">
                            <button type="submit" class="btn btn-dark btn-block">Sign In</button>
                        </div>
                    </div>
                </form>
                <p class="mb-1">
                    <a href="{{ Request::root() }}" class="text-secondary"><i class="fas fa-home"></i> Go back home page</a>
                </p>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="public/admin/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="public/admin/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="public/admin/dist/js/adminlte.min.js"></script>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
	<script>
		$(document).ready(function() {
			var remember = $.cookie('rememberadmin');
			if (remember == 'true') 
			{
				var email = $.cookie('emailadmin');
				var password = atob($.cookie('passwordadmin'));
				$('#email').val(email);
				$('#password').val(password);
				$('#remember').prop('checked', true);
			}
			$("#login").submit(function() {
				if ($('#remember').is(':checked')) {
					var email = $('#email').val();
					var password = btoa($('#password').val());
					$.cookie('emailadmin', email, { expires: 365 });
					$.cookie('passwordadmin', password, { expires: 365 });
					$.cookie('rememberadmin', true, { expires: 365 });
				}
				else
				{
					$.cookie('emailadmin', null);
					$.cookie('passwordadmin', null);
					$.cookie('rememberadmin', null);
				}
			});

			$("#reset").click(function() {
				$.cookie('emailadmin', null);
				$.cookie('passwordadmin', null);
				$.cookie('rememberadmin', null);
			});

		});
	</script>
</body>

</html>