<!doctype html>
<html lang="en" class="fullscreen-bg">

<head>
	<title>SILOG GROUP - Login</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<!-- VENDOR CSS -->
	<link rel="stylesheet" href="{{ asset('assetsAuth/css/bootstrap.min.css') }}">
	<link rel="stylesheet" href="{{ asset('assetsAuth/vendor/font-awesome/css/font-awesome.min.css') }}">
	<link rel="stylesheet" href="{{ asset('assetsAuth/vendor/linearicons/style.css') }}">
	<!-- MAIN CSS -->
	<link rel="stylesheet" href="{{ asset('assetsAuth/css/main.css') }}">
	<!-- FOR DEMO PURPOSES ONLY. You should remove this in your project -->
	<link rel="stylesheet" href="{{ asset('assetsAuth/css/demo.css') }}">
	<!-- GOOGLE FONTS -->
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">
</head>

<body>
	<!-- WRAPPER -->
	<div id="wrapper">
		<div class="vertical-align-wrap">
			<div class="vertical-align-middle">
				<div class="auth-box ">
					<div class="left">
						<div class="content">
							<div class="header">
								<div class="logo text-center"><img src="assetsAuth/img/silogGroup.png" width="150" height="30"alt="SILOG GROUP"></div>
								<p class="lead">Login Sistem</p>
							</div>
                                                        @if (session('pesan'))
                                                                <div class="alert alert-danger">
                                                                        {{ session('pesan') }}
                                                                </div>
                                                        @endif
							<form class="form-auth-small" method="post" action="{{url('/postlogin')}}">
                                                            @csrf
                                                            <div class="form-group @error('username') has-error @enderror">
                                                                    <label for="signin-username" class="control-label sr-only">Username</label>
                                                                    <input type="text" class="form-control" name="username" id="auth-username" placeholder="Username">
                                                                    @error('username')                                                                       
                                                                        <div class="help-block col-xs-12 col-sm-reset inline">{{ $message }}</div>
                                                                    @enderror
                                                            </div>
                                                            <div class="form-group @error('password') has-error @enderror"">
                                                                    <label for="signin-password" class="control-label sr-only">Password</label>
                                                                    <input type="password" class="form-control is-invalid" name="password" id="auth-password" placeholder="Password">
                                                                    @error('password')                                                                       
                                                                        <div class="help-block col-xs-12 col-sm-reset">{{ $message }}</div>
                                                                    @enderror
                                                            </div>
                                                            <button type="submit" class="btn btn-primary btn-lg btn-block">LOGIN</button>
                                                            <!--<div class="bottom">
                                                                    <span class="helper-text"><i class="fa fa-lock"></i> <a href="#">Forgot password?</a></span>
                                                            </div>-->
							</form>
						</div>
					</div>
					<div class="right">
						<div class="overlay"></div>
						<div class="content text">
							<h1 class="heading">SEMEN INDONESIA LOGISTIK GROUP</h1>
							<p>by SILOG GROUP &copy; 2020</p>
						</div>
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
		</div>
	</div>
	<!-- END WRAPPER -->
</body>

</html>