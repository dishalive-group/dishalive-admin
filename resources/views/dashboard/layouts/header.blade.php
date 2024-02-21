<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	@stack('meta')	
	<meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
	
    <!-- Favicon -->
    <link href="{{$favicon}}" rel="icon">
    
	<!-- Fonts and icons -->
	<script src="/assets/dashboard/js/plugin/webfont/webfont.min.js"></script>
	<script>
		WebFont.load({
			google: {"families":["Lato:300,400,700,900"]},
			custom: {"families":["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"], urls: ['/assets/dashboard/css/fonts.min.css']},
			active: function() {
				sessionStorage.fonts = true;
			}
		});
	</script>
	
	<!-- CSS Files -->
	<link rel="stylesheet" href="/assets/dashboard/css/bootstrap.min.css">
	<link rel="stylesheet" href="/assets/dashboard/css/atlantis.min.css">
	<!-- CSS Just for demo purpose, don't include it in your project -->
	<link rel="stylesheet" href="/assets/dashboard/css/demo.css">
</head>
<body>
	<div class="wrapper static-sidebar">
		<div class="main-header">
			<!-- Logo Header -->
			<div class="logo-header" data-background-color="blue">
				
				<a href="/" class="logo">
					<img src="{{ $logo }}" alt="{{ $businessName }}" height="50px" class="navbar-brand">
				</a>
				<button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse" data-target="collapse" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon">
						<i class="icon-menu"></i>
					</span>
				</button>
				<button class="topbar-toggler more"><i class="icon-options-vertical"></i></button>
				<div class="nav-toggle">
					<button class="btn btn-toggle toggle-sidebar">
						<i class="icon-menu"></i>
					</button>
				</div>
			</div>
			<!-- End Logo Header -->

			<!-- Navbar Header -->
			<nav class="navbar navbar-header navbar-expand-lg" data-background-color="blue2">			
				<div class="container-fluid">
					<!-- <div class="collapse" id="search-nav">
						<form class="navbar-left navbar-form nav-search mr-md-3">
							<div class="input-group">
								<div class="input-group-prepend">
									<button type="submit" class="btn btn-search pr-1">
										<i class="fa fa-search search-icon"></i>
									</button>
								</div>
								<input type="text" placeholder="Search ..." class="form-control">
							</div>
						</form>
					</div> -->
					<ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
						<!-- <li class="nav-item toggle-nav-search hidden-caret">
							<a class="nav-link" data-toggle="collapse" href="#search-nav" role="button" aria-expanded="false" aria-controls="search-nav">
								<i class="fa fa-search"></i>
							</a>
						</li>
						<li class="nav-item dropdown hidden-caret">
							<a class="nav-link dropdown-toggle" href="#" id="notifDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<i class="fa fa-bell"></i>
								<span class="notification">1</span>
							</a>
							<ul class="dropdown-menu notif-box animated fadeIn" aria-labelledby="notifDropdown">
								<li>
									<div class="dropdown-title">You have 1 new notification</div>
								</li>
								<li>
									<div class="notif-center">
										<a href="https://www.dishalive.com" target="_blank">
											<div class="notif-icon notif-primary"> <i class="fa fa-user-plus"></i> </div>
											<div class="notif-content">
												<span class="block">
													Welcome to DishaLive™ Family 
												</span>
												<span class="time">Thank you for choosing us</span> 
											</div>
										</a>
									</div>
								</li>
								<li>
									<a class="see-all" href="javascript:void(0);">See all notifications<i class="fa fa-angle-right"></i> </a>
								</li>
							</ul>
						</li>
						<li class="nav-item dropdown hidden-caret">
							<a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="false">
								<i class="fas fa-layer-group"></i>
							</a>
							<div class="dropdown-menu quick-actions quick-actions-info animated fadeIn">
								<div class="quick-actions-header">
									<span class="title mb-1">Quick Actions</span>
									<span class="subtitle op-8">Shortcuts</span>
								</div>
								<div class="quick-actions-scroll scrollbar-outer">
									<div class="quick-actions-items">
										<div class="row m-0">
											<a class="col-6 col-md-4 p-0" href="renewals">
												<div class="quick-actions-item">
													<i class="flaticon-file-1"></i>
													<span class="text">Renewals & Billing</span>
												</div>
											</a>
											<a class="col-6 col-md-4 p-0" href="../packages">
												<div class="quick-actions-item">
													<i class="flaticon-network"></i>
													<span class="text">Create New Website</span>
												</div>
											</a>
											<a class="col-6 col-md-4 p-0" href="../contact">
												<div class="quick-actions-item">
													<i class="flaticon-customer-support"></i>
													<span class="text">Help & Support</span>
												</div>
											</a>
										</div>
									</div>
								</div>
							</div>
						</li> -->
						<li class="nav-item dropdown hidden-caret">
							<a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#" aria-expanded="false">
								<div class="avatar-sm">
									<img src="{{$userImage}}" alt="..." class="avatar-img rounded-circle">
								</div>
							</a>
							<ul class="dropdown-menu dropdown-user animated fadeIn">
								<div class="dropdown-user-scroll scrollbar-outer">
									<li>
										<div class="user-box">
											<div class="avatar-lg"><img src="{{$userImage}}" alt="image profile" class="avatar-img rounded"></div>
											<div class="u-text">
												<h4>{{ Auth::user()->name }}</h4>
												<p class="text-muted">
												Role: {{ Auth::user()->userType }} <br>
												Customer ID: {{ Auth::user()->id }} </p>
											</div>
										</div>
									</li>
									<li>
										<div class="dropdown-divider"></div>
										<a class="dropdown-item" href="/change-password">Change Password</a>
										<div class="dropdown-divider"></div>
										<a class="dropdown-item" href="/logout">Logout</a>
									</li>
								</div>
							</ul>
						</li>
					</ul>
				</div>
			</nav>
			<!-- End Navbar -->
		</div>
		<!-- Sidebar -->
		<div class="sidebar sidebar-style-2">
			<div class="sidebar-wrapper scrollbar scrollbar-inner">
				<div class="sidebar-content">
					<div class="user">
						<div class="avatar-sm float-left mr-2">
							<img src="{{$userImage}}" alt="..." class="avatar-img rounded-circle">
						</div>
						<div class="info">
							<a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
								<span>
									{{ Auth::user()->name }}
									<span class="user-level">Customer ID: {{ Auth::user()->id }}</span>
									<span class="caret"></span>
								</span>
							</a>
							<div class="clearfix"></div>
						</div>
					</div>
					<ul class="nav nav-primary">
						<li class="nav-item">
							<a href="/dashboard">
								<i class="fas fa-desktop"></i>
								<p>Dashboard</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="/dashboard/schedule-campaign">
								<i class="fas fa-bullhorn"></i>
								<p>New Campaign</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="/dashboard/user-campaigns">
								<i class="fas fa-chart-line"></i>
								<p>Campaigns</p>
							</a>
						</li>

						<li class="nav-section">
							<span class="sidebar-mini-icon">
								<i class="fa fa-ellipsis-h"></i>
							</span>
							<h4 class="text-section">Others</h4>
						</li>
						<li class="nav-item">
							<a href="/change-password">
								<i class="fas fa-key"></i>
								<p>Change Password</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="/logout">
								<i class="fas fa-sign-out-alt"></i>
								<p>Log Out</p>
							</a>
						</li>
					</ul>
				</div>
			</div> 
		</div>
		
		<div class="main-panel">
			<div class="container">
		    @if($message = Session::get('message'))
			<div class="alert alert-info">
				{{ $message }}
			</div>
			@endif
		    @if($message = Session::get('error'))
			<div class="alert alert-danger">
				{{ $message }}
			</div>
			@endif
			<div class="content">
				<div class="page-inner">