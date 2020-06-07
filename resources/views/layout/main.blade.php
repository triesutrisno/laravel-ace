<!DOCTYPE html>
<html lang="en">

<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<meta charset="utf-8" />
	<title>SILOG GROUP</title>

	<meta name="description" content="overview &amp; stats" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

	<!-- bootstrap & fontawesome -->
	<link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}" />
	<link rel="stylesheet" href="{{ asset('assets/font-awesome/4.5.0/css/font-awesome.min.css') }}" />

	<!-- page specific plugin styles -->

	<!-- text fonts -->
	<link rel="stylesheet" href="{{ asset('assets/css/fonts.googleapis.com.css') }}" />

	<!-- ace styles -->
	<link rel="stylesheet" href="{{ asset('assets/css/ace.min.css') }}" class="ace-main-stylesheet" id="main-ace-style" />
        
	<!--[if lte IE 9]>
			<link rel="stylesheet" href="assets/css/ace-part2.min.css" class="ace-main-stylesheet" />
		<![endif]-->
	<link rel="stylesheet" href="{{ asset('assets/css/ace-skins.min.css') }}" />
	<link rel="stylesheet" href="{{ asset('assets/css/ace-rtl.min.css') }}" />
        
        @stack('styles')

	<!--[if lte IE 9]>
		  <link rel="stylesheet" href="assets/css/ace-ie.min.css" />
		<![endif]-->

	<!-- inline styles related to this page -->

	<!-- ace settings handler -->
	<script src="{{ asset('assets/js/ace-extra.min.js') }}"></script>

	<!-- HTML5shiv and Respond.js for IE8 to support HTML5 elements and media queries -->

	<!--[if lte IE 8]>
		<script src="assets/js/html5shiv.min.js"></script>
		<script src="assets/js/respond.min.js"></script>
		<![endif]-->
</head>

<body class="no-skin">
	<div id="navbar" class="navbar navbar-default ace-save-state navbar-fixed-top">
		<div class="navbar-container ace-save-state" id="navbar-container">
			<button type="button" class="navbar-toggle menu-toggler pull-left" id="menu-toggler" data-target="#sidebar">
				<span class="sr-only">Toggle sidebar</span>

				<span class="icon-bar"></span>

				<span class="icon-bar"></span>

				<span class="icon-bar"></span>
			</button>

			<div class="navbar-header pull-left">
				<a href="{{url('/')}}" class="navbar-brand">
					<small>
						PT Semen Indonesia Distributor
					</small>
				</a>
			</div>
			<div class="navbar-buttons navbar-header pull-right" role="navigation">
				<ul class="nav ace-nav">
					<li class="prImary dropdown-modal">
						<a data-toggle="dropdown" class="dropdown-toggle" href="#">
							<i class="ace-icon fa fa-bell icon-animated-bell"></i>
							<span class="badge badge-important">8</span>
						</a>

						<ul class="dropdown-menu-right dropdown-navbar navbar-pink dropdown-menu dropdown-caret dropdown-close">
							<li class="dropdown-header">
								<i class="ace-icon fa fa-exclamation-triangle"></i>
								8 Notifications
							</li>

							<li class="dropdown-content">
								<ul class="dropdown-menu dropdown-navbar navbar-primary">
									<li>
										<a href="#">
											<div class="clearfix">
												<span class="pull-left">
													<i class="btn btn-xs no-hover btn-pink fa fa-comment"></i>
													New Comments
												</span>
												<span class="pull-right badge badge-info">+12</span>
											</div>
										</a>
									</li>

									<li>
										<a href="#">
											<i class="btn btn-xs btn-primary fa fa-user"></i>
											Bob just signed up as an editor ...
										</a>
									</li>

									<li>
										<a href="#">
											<div class="clearfix">
												<span class="pull-left">
													<i class="btn btn-xs no-hover btn-success fa fa-shopping-cart"></i>
													New Orders
												</span>
												<span class="pull-right badge badge-success">+8</span>
											</div>
										</a>
									</li>

									<li>
										<a href="#">
											<div class="clearfix">
												<span class="pull-left">
													<i class="btn btn-xs no-hover btn-info fa fa-twitter"></i>
													Followers
												</span>
												<span class="pull-right badge badge-info">+11</span>
											</div>
										</a>
									</li>
								</ul>
							</li>

							<li class="dropdown-footer">
								<a href="#">
									See all notifications
									<i class="ace-icon fa fa-arrow-right"></i>
								</a>
							</li>
						</ul>
					</li>

					<li class="light-blue dropdown-modal">
						<a data-toggle="dropdown" href="#" class="dropdown-toggle">
							<img class="nav-user-photo" src="{{ asset('assets/images/avatars/user.jpg') }}" alt="Jason's Photo" />
							<span class="user-info">
								@php
								if(auth()->user()->name!=""){
								$arrNama = explode(' ',auth()->user()->name);
								}else{
								$arrNama = array('Noname','Noname');
								}
								@endphp
								<small>{{$arrNama[0]}}</small>

							</span>

							<i class="ace-icon fa fa-caret-down"></i>
						</a>

						<ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
							<!--<li>
							
							
									


									<a href="#">
										<i class="ace-icon fa fa-cog"></i>
										Settings
									</a>
								</li>-->

							<li>
								<a href="profile.html">
									<i class="ace-icon fa fa-user"></i>
									Profile
								</a>
							</li>

							<li class="divider"></li>

							<li>
								<a href="{{url('/logout')}}">
									<i class="ace-icon fa fa-power-off"></i>
									Logout
								</a>
							</li>
						</ul>
					</li>
				</ul>
			</div>
		</div><!-- /.navbar-container -->
	</div>

	<div class="main-container ace-save-state" id="main-container">
		<script type="text/javascript">
			try {
				ace.settings.loadState('main-container')
			} catch (e) {}
		</script>

		<div id="sidebar" class="sidebar responsive ace-save-state sidebar-fixed">
			<script type="text/javascript">
				try {
					ace.settings.loadState('sidebar')
				} catch (e) {}
			</script>

			<ul class="nav nav-list">
				<li class="active highlight">
					<a href="{{ url('/') }}">
						<i class="menu-icon fa fa-home"></i>
						<span class="menu-text"> Home </span>
					</a>

					<b class="arrow"></b>
				</li>
				@php
                                $path = explode("/",\Request::path());
				$hakAkses = Session::get('hakAkses');
				foreach ($hakAkses as $key => $val){
                                foreach ($val['data1'] as $keys => $datae){
                                    if($path[0]==$datae['menu_link']){
                                        $active = "active open";
                                        break;  
                                    }else{
                                        $active = "";
                                    }
                                }
				echo "
				<li class='".$active."'>
					<a href='#' class='dropdown-toggle'>
						<i class='menu-icon fa fa-desktop'></i>
						<span class='menu-text'> $val[menu_nama] </span>
						<b class='arrow fa fa-angle-down'></b>
					</a>

					<b class='arrow'></b>";
                                        
					if(isset($val['data1'])){                                        
					echo"<ul class='submenu'>";
						foreach ($val['data1'] as $key2 => $val2){
                                                $aktif = $path[0]==$val2['menu_link'] ? 'active' : '';
						echo"
						<li class='".$aktif."'>
							<a href='".url("/$val2[menu_link]")."'>
								<i class='menu-icon fa fa-caret-right'></i>
								$val2[menu_nama]
							</a>

							<b class='arrow'></b>
						</li>";
						}
						echo"</ul>";
					}
					echo"</li>";
				}
				@endphp
			</ul><!-- /.nav-list -->

			<div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
				<i id="sidebar-toggle-icon" class="ace-icon fa fa-angle-double-left ace-save-state" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
			</div>
		</div>

		<div class="main-content">
			<div class="main-content-inner">
				<div class="breadcrumbs ace-save-state breadcrumbs-fixed" id="breadcrumbs">
					<ul class="breadcrumb">
						<li>
							<i class="ace-icon fa fa-home home-icon"></i>
							<a href="{{url('/')}}">Home</a>
						</li>
						@if(trim($__env->yieldContent('subBreadcrumb')))
						<li class="active">
							<a href="{{url('/')}}/@yield('link')">@yield('breadcrumb')</a>
						</li>
						<li class="active">
							@yield('subBreadcrumb')
						</li>
						@else
						<li class="active">
							@yield('breadcrumb')
						</li>
						@endif
					</ul><!-- /.breadcrumb -->


				</div>

				<div class="page-content">

					<div class="page-header">
						<h1>
							@yield('title')
							<small>
								<i class="ace-icon fa fa-angle-double-right"></i>
								@yield('subTitle')
							</small>
							<small>
								<i class="ace-icon fa fa-angle-double-right"></i>
								<font style="color:red">@yield('subsubTitle')</font>
							</small>
						</h1>
					</div><!-- /.page-header -->

					<div class="row">
						<div class="col-xs-12">
							<!-- PAGE CONTENT BEGINS -->
							@yield('container')
							<!-- PAGE CONTENT ENDS -->
						</div><!-- /.col -->
					</div><!-- /.row -->
				</div><!-- /.page-content -->
			</div>
		</div><!-- /.main-content -->

		<div class="footer">
			<div class="footer-inner">
				<div class="footer-content">
					<span class="bigger-120">
						<span class="red bolder">SILOG </span>
						<span class="blue bolder">Group</span>
						&copy; {{ now()->format('Y')}}
					</span>

					&nbsp; &nbsp;
				</div>
			</div>
		</div>

		<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
			<i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
		</a>
	</div><!-- /.main-container -->

	@include('layout.javascript')
	@stack('scripts')
</body>

</html>