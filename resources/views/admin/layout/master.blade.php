<!DOCTYPE html>
<html lang="en" dir="ltr">
	<head>

		<!-- Meta data -->
		<meta charset="UTF-8">
		<meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
		<meta content="DayOne - It is one of the Major Dashboard Template which includes - HR, Employee and Job Dashboard. This template has multipurpose HTML template and also deals with Task, Project, Client and Support System Dashboard." name="description">
		<meta content="Spruko Technologies Private Limited" name="author">
		<meta name="keywords" content="admin dashboard, admin panel template, html admin template, dashboard html template, bootstrap 4 dashboard, template admin bootstrap 4, simple admin panel template, simple dashboard html template,  bootstrap admin panel, task dashboard, job dashboard, bootstrap admin panel, dashboards html, panel in html, bootstrap 4 dashboard"/>

		<meta name="csrf-token" content="{{ csrf_token() }}">
		<base href="{{ asset('') }}">

		<!-- Title -->
		<title>Admin Hà Tĩnh có gì</title>

		<!--Favicon -->
        <link rel="icon" href="assets/images/web/logoht-daude.svg">

		<!-- Bootstrap css -->
		<link href="assets/plugins/bootstrap/css/bootstrap.css" rel="stylesheet" />

		<!-- Style css -->
		<link href="assets/css/style.css" rel="stylesheet" />
		<link href="assets/css/dark.css" rel="stylesheet" />
		<link href="assets/css/skin-modes.css" rel="stylesheet" />

		<!-- Animate css -->
		<link href="assets/css/animated.css" rel="stylesheet" />

		<!--Sidemenu css -->
        <link  href="assets/css/sidemenu.css" rel="stylesheet">

		<!-- P-scroll bar css-->
		<link href="assets/plugins/p-scrollbar/p-scrollbar.css" rel="stylesheet" />

		<!---Icons css-->
		<link href="assets/css/icons.css" rel="stylesheet" />

		<!---Sidebar css-->
		<link href="assets/plugins/sidebar/sidebar.css" rel="stylesheet" />

		<!-- Select2 css -->
		<link href="assets/plugins/select2/select2.min.css" rel="stylesheet" />

		<link href="assets/plugins/datatable/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
		<link href="assets/plugins/datatable/css/buttons.bootstrap4.min.css"  rel="stylesheet">
		<link href="assets/plugins/datatable/responsive.bootstrap4.min.css" rel="stylesheet" />

		<link href="assets/plugins/treeview/treeview.css" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" href="{{ asset('assets/css/stylefe.css') }}">
		<link rel="stylesheet" href="{{ asset('assets/css/devadmin.css') }}">

		<link rel="stylesheet" href="assets/plugins/summernote/summernote-bs4.css">

		<link href="assets/plugins/notify/css/notifIt.css" rel="stylesheet" />
		<link rel="stylesheet" href="assets/plugins/toastr/toastr.min.css">

		<link href="assets/plugins/wysiwyag/richtext.css" rel="stylesheet" />
		
		<link href="assets/plugins/tagsinput/bootstrap-tagsinput.css" rel="stylesheet" />

		<link href="assets/css/animated.css" rel="stylesheet" />

		<script src="assets/plugins/jquery/jquery.min.js"></script>
	</head>

	<body class="app sidebar-mini">

		<!---Global-loader-->
		<div id="global-loader" >
			<img src="assets/images/svgs/loader.svg" alt="loader">
		</div>

		<div class="page">
			<div class="page-main">

				<!--aside open-->
				<aside class="app-sidebar">
					<div class="app-sidebar__logo">
						<a class="header-brand" href="{{ route('home') }}">
                            <img src="assets/images/logo/logo@2x.png" class="header-brand-img desktop-lgo" alt="Hà Tĩnh có gì">
							<img style="height: 50px" src="assets/images/logo/logo@2x.png" class="header-brand-img dark-logo" alt="Hà Tĩnh có gì">
							<img src="assets/images/logo/daude.png" class="header-brand-img mobile-logo" alt="Hà Tĩnh có gì">
							<img src="assets/images/logo/daude.png" class="header-brand-img darkmobile-logo" alt="Hà Tĩnh có gì">
						</a>
					</div>
					<div class="app-sidebar3">
						<div class="app-sidebar__user">
							<div class="dropdown user-pro-body text-center">
								<div class="user-pic">
									<img style="object-fit: cover" src="{{ Auth::user()->img_profile }}" alt="user-img" class="avatar-xxl rounded-circle mb-1">
								</div>
								<div class="user-info">
									<h5 class="mb-2">{{ Auth::user()->name }}</h5>
									<span class="text-muted app-sidebar__user-name text-sm">{{ Auth::user()->group->group_name }}</span>
								</div>
							</div>
						</div>
                        
                        @include('admin.layout.sidebar')
						
						<div class="Annoucement_card">
							<div class="text-center">
								<div>
									<h5 class="title mt-0 mb-1 ml-2 font-weight-bold tx-12">Announcement</h5>
									<div class="bg-layer py-4">
										<img src="assets/images/photos/announcement-1.png" class="py-3 text-center mx-auto" alt="img">
									</div>
									<p class="subtext mt-0 mb-0 ml-2 fs-13 text-center my-2">Make an Announcement to Our Employee</p>
								</div>
							</div>
							<button class="btn btn-block btn-primary my-4 fs-12">Create Announcement</button>
							<button class="btn btn-block btn-outline fs-12">See history</button>
						</div>
					</div>
				</aside>
				<!--aside closed-->

				<div class="app-content main-content">
					<div class="side-app">

						<!--app header-->
						<div class="app-header header">
							<div class="container-fluid">
								<div class="d-flex">
									<a class="header-brand" href="index.html">
										<img src="assets/images/brand/logo.png" class="header-brand-img desktop-lgo" alt="Dayonelogo">
										<img src="assets/images/brand/logo-white.png" class="header-brand-img dark-logo" alt="Dayonelogo">
										<img src="assets/images/brand/favicon.png" class="header-brand-img mobile-logo" alt="Dayonelogo">
										<img src="assets/images/brand/favicon1.png" class="header-brand-img darkmobile-logo" alt="Dayonelogo">
									</a>
									<div class="app-sidebar__toggle" data-toggle="sidebar">
										<a class="open-toggle" href="#">
											<i class="feather feather-menu"></i>
										</a>
										<a class="close-toggle" href="#">
											<i class="feather feather-x"></i>
										</a>
									</div>
									<div class="mt-0">
										<form class="form-inline">
											<div class="search-element">
												<input type="search" class="form-control header-search" placeholder="Search…" aria-label="Search" tabindex="1">
												<button class="btn btn-primary-color" >
													<i class="feather feather-search"></i>
												</button>
											</div>
										</form>
									</div><!-- SEARCH -->
									<div class="d-flex order-lg-2 my-auto ml-auto">
										<a class="nav-link my-auto icon p-0 nav-link-lg d-md-none navsearch" href="#" data-toggle="search">
											<i class="feather feather-search search-icon header-icon"></i>
										</a>
										<div class="dropdown header-flags">
											<a class="nav-link icon" data-toggle="dropdown">
												<img src="assets/images/flags/flag-png/united-kingdom.png" class="h-24" alt="img">
											</a>
											<div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow animated">
												<a href="#" class="dropdown-item d-flex "> <span class="avatar  mr-3 align-self-center bg-transparent"><img src="assets/images/flags/flag-png/india.png" alt="img" class="h-24"></span>
													<div class="d-flex"> <span class="my-auto">India</span> </div>
												</a>
												<a href="#" class="dropdown-item d-flex"> <span class="avatar  mr-3 align-self-center bg-transparent"><img src="assets/images/flags/flag-png/united-kingdom.png" alt="img" class="h-24"></span>
													<div class="d-flex"> <span class="my-auto">UK</span> </div>
												</a>
												<a href="#" class="dropdown-item d-flex"> <span class="avatar mr-3 align-self-center bg-transparent"><img src="assets/images/flags/flag-png/italy.png" alt="img" class="h-24"></span>
													<div class="d-flex"> <span class="my-auto">Italy</span> </div>
												</a>
												<a href="#" class="dropdown-item d-flex"> <span class="avatar mr-3 align-self-center bg-transparent"><img src="assets/images/flags/flag-png/united-states-of-america.png" class="h-24" alt="img"></span>
													<div class="d-flex"> <span class="my-auto">US</span> </div>
												</a>
												<a href="#" class="dropdown-item d-flex"> <span class="avatar  mr-3 align-self-center bg-transparent"><img src="assets/images/flags/flag-png/spain.png" alt="img" class="h-24"></span>
													<div class="d-flex"> <span class="my-auto">Spain</span> </div>
												</a>
											</div>
										</div>
										<div class="dropdown header-fullscreen">
											<a class="nav-link icon full-screen-link">
												<i class="feather feather-maximize fullscreen-button fullscreen header-icons"></i>
												<i class="feather feather-minimize fullscreen-button exit-fullscreen header-icons"></i>
											</a>
										</div>
										<div class="dropdown header-message">
											<a class="nav-link icon" data-toggle="dropdown">
												<i class="feather feather-mail header-icon"></i>
												<span class="badge badge-success side-badge">5</span>
											</a>
											<div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow  animated">
												<div class="header-dropdown-list message-menu" id="message-menu">
													<a class="dropdown-item border-bottom" href="#">
														<div class="d-flex align-items-center">
															<div class="">
																<span class="avatar avatar-md brround align-self-center cover-image" data-image-src="assets/images/users/1.jpg"></span>
															</div>
															<div class="d-flex">
																<div class="pl-3">
																	<h6 class="mb-1">Jack Wright</h6>
																	<p class="fs-13 mb-1">All the best your template awesome</p>
																	<div class="small text-muted">
																		3 hours ago
																	</div>
																</div>
															</div>
														</div>
													</a>
													<a class="dropdown-item border-bottom" href="#">
														<div class="d-flex align-items-center">
															<div class="">
																<span class="avatar avatar-md brround align-self-center cover-image" data-image-src="assets/images/users/2.jpg"></span>
															</div>
															<div class="d-flex">
																<div class="pl-3">
																	<h6 class="mb-1">Lisa Rutherford</h6>
																	<p class="fs-13 mb-1">Hey! there I'm available</p>
																	<div class="small text-muted">
																		5 hour ago
																	</div>
																</div>
															</div>
														</div>
													</a>
													<a class="dropdown-item border-bottom" href="#">
														<div class="d-flex align-items-center">
															<div class="">
																<span class="avatar avatar-md brround align-self-center cover-image" data-image-src="assets/images/users/3.jpg"></span>
															</div>
															<div class="d-flex">
																<div class="pl-3">
																	<h6 class="mb-1">Blake Walker</h6>
																	<p class="fs-13 mb-1">Just created a new blog post</p>
																	<div class="small text-muted">
																		45 mintues ago
																	</div>
																</div>
															</div>
														</div>
													</a>
													<a class="dropdown-item border-bottom" href="#">
														<div class="d-flex align-items-center">
															<div class="">
																<span class="avatar avatar-md brround align-self-center cover-image" data-image-src="assets/images/users/4.jpg"></span>
															</div>
															<div class="d-flex">
																<div class="pl-3">
																	<h6 class="mb-1">Fiona Morrison</h6>
																	<p class="fs-13 mb-1">Added new comment on your photo</p>
																	<div class="small text-muted">
																		2 days ago
																	</div>
																</div>
															</div>
														</div>
													</a>
													<a class="dropdown-item border-bottom" href="#">
														<div class="d-flex align-items-center">
															<div class="">
																<span class="avatar avatar-md brround align-self-center cover-image" data-image-src="assets/images/users/6.jpg"></span>
															</div>
															<div class="d-flex">
																<div class="pl-3">
																	<h6 class="mb-1">Stewart Bond</h6>
																	<p class="fs-13 mb-1">Your payment invoice is generated</p>
																	<div class="small text-muted">
																		3 days ago
																	</div>
																</div>
															</div>
														</div>
													</a>
												</div>
												<div class=" text-center p-2">
													<a href="#" class="">See All Messages</a>
												</div>
											</div>
										</div>
										<div class="dropdown header-notify">
											<a class="nav-link icon" data-toggle="sidebar-right" data-target=".sidebar-right">
												<i class="feather feather-bell header-icon"></i>
												<span class="bg-dot"></span>
											</a>
										</div>
										<div class="dropdown profile-dropdown">
											<a href="#" class="nav-link pr-1 pl-0 leading-none" data-toggle="dropdown">
												<span>
													<img style="object-fit: cover;cursor: pointer;" src="{{ Auth::user()->img_profile }}" alt="img" class="avatar avatar-md bradius">
												</span>
											</a>
											<div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow animated">
												<div class="p-3 text-center border-bottom">
													<a href="#" class="text-center user pb-0 font-weight-bold">{{ Auth::user()->name }}</a>
													<p class="text-center user-semi-title">{{ Auth::user()->group->group_name }}</p>
												</div>
												<a class="dropdown-item d-flex" href="#">
													<i class="feather feather-user mr-3 fs-16 my-auto"></i>
													<div class="mt-1">Thông tin cá nhân</div>
												</a>
												<a class="dropdown-item d-flex" href="#">
													<i class="feather feather-settings mr-3 fs-16 my-auto"></i>
													<div class="mt-1">Settings</div>
												</a>
												<a class="dropdown-item d-flex" href="#">
													<i class="feather feather-mail mr-3 fs-16 my-auto"></i>
													<div class="mt-1">Messages</div>
												</a>
												<a class="dropdown-item d-flex" href="#" data-toggle="modal" data-target="#changepasswordnmodal">
													<i class="feather feather-edit-2 mr-3 fs-16 my-auto"></i>
													<div class="mt-1">Change Password</div>
												</a>
												<form method="POST" action="logout">
													@csrf
													<button class="dropdown-item d-flex" type="submit">
														<i class="feather feather-power mr-3 fs-16 my-auto"></i>
														<div class="mt-1">Đăng xuất</div>
													</button>
												</form>
												
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!--/app header-->

						<!-- app-content-->

                        @yield('content')
						
                		<!-- end app-content-->
			</div>

			<!--Footer-->
			<footer class="footer">
				<div class="container">
					<div class="row align-items-center flex-row-reverse">
						<div class="col-md-12 col-sm-12 mt-3 mt-lg-0 text-center">
							Copyright © 2021 <a href="#">Dayone</a>. Designed by <a href="#">Spruko Technologies Pvt.Ltd</a> All rights reserved.
						</div>
					</div>
				</div>
			</footer>
			<!-- End Footer-->

			<!--Sidebar-right-->
			<div class="sidebar sidebar-right sidebar-animate">
				<div class="card-header border-bottom pb-5">
					<h4 class="card-title">Notifications </h4>
					<div class="card-options">
						<a href="#" class="btn btn-sm btn-icon btn-light  text-primary"  data-toggle="sidebar-right" data-target=".sidebar-right"><i class="feather feather-x"></i> </a>
					</div>
				</div>
				<div class="">
					<div class="list-group-item  align-items-center border-0">
						<div class="d-flex">
							<span class="avatar avatar-lg brround mr-3" style="background-image: url(assets/images/users/4.jpg)"></span>
							<div class="mt-1">
								<a href="#" class="font-weight-semibold fs-16">Liam <span class="text-muted font-weight-normal">Sent Message</span></a>
								<span class="clearfix"></span>
								<span class="text-muted fs-13 ml-auto"><i class="mdi mdi-clock text-muted mr-1"></i>30 mins ago</span>
							</div>
							<div class="ml-auto">
								<a href="" class="mr-0 option-dots" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
									<span class="feather feather-more-horizontal"></span>
								</a>
								<ul class="dropdown-menu dropdown-menu-right" role="menu">
									<li><a href="#"><i class="feather feather-eye mr-2"></i>View</a></li>
									<li><a href="#"><i class="feather feather-plus-circle mr-2"></i>Add</a></li>
									<li><a href="#"><i class="feather feather-trash-2 mr-2"></i>Remove</a></li>
									<li><a href="#"><i class="feather feather-settings mr-2"></i>More</a></li>
								</ul>
							</div>
						</div>
					</div>
					<div class="list-group-item  align-items-center  border-bottom">
						<div class="d-flex">
							<span class="avatar avatar-lg brround mr-3" style="background-image: url(assets/images/users/10.jpg)"></span>
							<div class="mt-1">
								<a href="#" class="font-weight-semibold fs-16">Paul<span class="text-muted font-weight-normal"> commented on you post</span></a>
								<span class="clearfix"></span>
								<span class="text-muted fs-13 ml-auto"><i class="mdi mdi-clock text-muted mr-1"></i>1 hour ago</span>
							</div>
							<div class="ml-auto">
								<a href="" class="mr-0 option-dots" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
									<span class="feather feather-more-horizontal"></span>
								</a>
								<ul class="dropdown-menu dropdown-menu-right" role="menu">
									<li><a href="#"><i class="feather feather-eye mr-2"></i>View</a></li>
									<li><a href="#"><i class="feather feather-plus-circle mr-2"></i>Add</a></li>
									<li><a href="#"><i class="feather feather-trash-2 mr-2"></i>Remove</a></li>
									<li><a href="#"><i class="feather feather-settings mr-2"></i>More</a></li>
								</ul>
							</div>
						</div>
					</div>
					<div class="list-group-item  align-items-center  border-bottom">
						<div class="d-flex">
							<span class="avatar avatar-lg brround mr-3 bg-pink-transparent"><span class="feather feather-shopping-cart"></span></span>
							<div class="mt-1">
								<a href="#" class="font-weight-semibold fs-16">James<span class="text-muted font-weight-normal"> Order Placed</span></a>
								<span class="clearfix"></span>
								<span class="text-muted fs-13 ml-auto"><i class="mdi mdi-clock text-muted mr-1"></i>1 day ago</span>
							</div>
							<div class="ml-auto">
								<a href="" class="mr-0 option-dots" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
									<span class="feather feather-more-horizontal"></span>
								</a>
								<ul class="dropdown-menu dropdown-menu-right" role="menu">
									<li><a href="#"><i class="feather feather-eye mr-2"></i>View</a></li>
									<li><a href="#"><i class="feather feather-plus-circle mr-2"></i>Add</a></li>
									<li><a href="#"><i class="feather feather-trash-2 mr-2"></i>Remove</a></li>
									<li><a href="#"><i class="feather feather-settings mr-2"></i>More</a></li>
								</ul>
							</div>
						</div>
					</div>
					<div class="list-group-item  align-items-center  border-bottom">
						<div class="d-flex">
							<span class="avatar avatar-lg brround mr-3" style="background-image: url(assets/images/users/9.jpg)">
								<span class="avatar-status bg-green"></span>
							</span>
							<div class="mt-1">
								<a href="#" class="font-weight-semibold fs-16">Diane<span class="text-muted font-weight-normal"> New Message Received</span></a>
								<span class="clearfix"></span>
								<span class="text-muted fs-13 ml-auto"><i class="mdi mdi-clock text-muted mr-1"></i>1 day ago</span>
							</div>
							<div class="ml-auto">
								<a href="" class="mr-0 option-dots" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
									<span class="feather feather-more-horizontal"></span>
								</a>
								<ul class="dropdown-menu dropdown-menu-right" role="menu">
									<li><a href="#"><i class="feather feather-eye mr-2"></i>View</a></li>
									<li><a href="#"><i class="feather feather-plus-circle mr-2"></i>Add</a></li>
									<li><a href="#"><i class="feather feather-trash-2 mr-2"></i>Remove</a></li>
									<li><a href="#"><i class="feather feather-settings mr-2"></i>More</a></li>
								</ul>
							</div>
						</div>
					</div>
					<div class="list-group-item  align-items-center  border-bottom">
						<div class="d-flex">
							<span class="avatar avatar-lg brround mr-3" style="background-image: url(assets/images/users/5.jpg)">
								<span class="avatar-status bg-muted"></span>
							</span>
							<div class="mt-1">
								<a href="#" class="font-weight-semibold fs-16">Vinny<span class="text-muted font-weight-normal"> shared your post</span></a>
								<span class="clearfix"></span>
								<span class="text-muted fs-13 ml-auto"><i class="mdi mdi-clock text-muted mr-1"></i>2 days ago</span>
							</div>
							<div class="ml-auto">
								<a href="" class="mr-0 option-dots" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
									<span class="feather feather-more-horizontal"></span>
								</a>
								<ul class="dropdown-menu dropdown-menu-right" role="menu">
									<li><a href="#"><i class="feather feather-eye mr-2"></i>View</a></li>
									<li><a href="#"><i class="feather feather-plus-circle mr-2"></i>Add</a></li>
									<li><a href="#"><i class="feather feather-trash-2 mr-2"></i>Remove</a></li>
									<li><a href="#"><i class="feather feather-settings mr-2"></i>More</a></li>
								</ul>
							</div>
						</div>
					</div>
					<div class="list-group-item  align-items-center  border-bottom">
						<div class="d-flex">
							<span class="avatar avatar-lg brround mr-3 bg-primary-transparent">M</span>
							<div class="mt-1">
								<a href="#" class="font-weight-semibold fs-16">Mack<span class="text-muted font-weight-normal"> your admin lanuched</span></a>
								<span class="clearfix"></span>
								<span class="text-muted fs-13 ml-auto"><i class="mdi mdi-clock text-muted mr-1"></i>1 week ago</span>
							</div>
							<div class="ml-auto">
								<a href="" class="mr-0 option-dots" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
									<span class="feather feather-more-horizontal"></span>
								</a>
								<ul class="dropdown-menu dropdown-menu-right" role="menu">
									<li><a href="#"><i class="feather feather-eye mr-2"></i>View</a></li>
									<li><a href="#"><i class="feather feather-plus-circle mr-2"></i>Add</a></li>
									<li><a href="#"><i class="feather feather-trash-2 mr-2"></i>Remove</a></li>
									<li><a href="#"><i class="feather feather-settings mr-2"></i>More</a></li>
								</ul>
							</div>
						</div>
					</div>
					<div class="list-group-item  align-items-center  border-bottom">
						<div class="d-flex">
							<span class="avatar avatar-lg brround mr-3" style="background-image: url(assets/images/users/12.jpg)">
								<span class="avatar-status bg-green"></span>
							</span>
							<div class="mt-1">
								<a href="#" class="font-weight-semibold fs-16">Vinny<span class="text-muted font-weight-normal"> shared your post</span></a>
								<span class="clearfix"></span>
								<span class="text-muted fs-13 ml-auto"><i class="mdi mdi-clock text-muted mr-1"></i>04 Jan 2021 1:56 Am</span>
							</div>
							<div class="ml-auto">
								<a href="" class="mr-0 option-dots" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
									<span class="feather feather-more-horizontal"></span>
								</a>
								<ul class="dropdown-menu dropdown-menu-right" role="menu">
									<li><a href="#"><i class="feather feather-eye mr-2"></i>View</a></li>
									<li><a href="#"><i class="feather feather-plus-circle mr-2"></i>Add</a></li>
									<li><a href="#"><i class="feather feather-trash-2 mr-2"></i>Remove</a></li>
									<li><a href="#"><i class="feather feather-settings mr-2"></i>More</a></li>
								</ul>
							</div>
						</div>
					</div>
					<div class="list-group-item  align-items-center  border-bottom">
						<div class="d-flex">
							<span class="avatar avatar-lg brround mr-3" style="background-image: url(assets/images/users/8.jpg)">	</span>
							<div class="mt-1">
								<a href="#" class="font-weight-semibold fs-16">Anna<span class="text-muted font-weight-normal"> likes your post</span></a>
								<span class="clearfix"></span>
								<span class="text-muted fs-13 ml-auto"><i class="mdi mdi-clock text-muted mr-1"></i>25 Dec 2020 11:25 Am</span>
							</div>
							<div class="ml-auto">
								<a href="" class="mr-0 option-dots" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
									<span class="feather feather-more-horizontal"></span>
								</a>
								<ul class="dropdown-menu dropdown-menu-right" role="menu">
									<li><a href="#"><i class="feather feather-eye mr-2"></i>View</a></li>
									<li><a href="#"><i class="feather feather-plus-circle mr-2"></i>Add</a></li>
									<li><a href="#"><i class="feather feather-trash-2 mr-2"></i>Remove</a></li>
									<li><a href="#"><i class="feather feather-settings mr-2"></i>More</a></li>
								</ul>
							</div>
						</div>
					</div>
					<div class="list-group-item  align-items-center  border-bottom">
						<div class="d-flex">
							<span class="avatar avatar-lg brround mr-3" style="background-image: url(assets/images/users/14.jpg)">	</span>
							<div class="mt-1">
								<a href="#" class="font-weight-semibold fs-16">Kimberly<span class="text-muted font-weight-normal"> Completed one task</span></a>
								<span class="clearfix"></span>
								<span class="text-muted fs-13 ml-auto"><i class="mdi mdi-clock text-muted mr-1"></i>24 Dec 2020 9:30 Pm</span>
							</div>
							<div class="ml-auto">
								<a href="" class="mr-0 option-dots" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
									<span class="feather feather-more-horizontal"></span>
								</a>
								<ul class="dropdown-menu dropdown-menu-right" role="menu">
									<li><a href="#"><i class="feather feather-eye mr-2"></i>View</a></li>
									<li><a href="#"><i class="feather feather-plus-circle mr-2"></i>Add</a></li>
									<li><a href="#"><i class="feather feather-trash-2 mr-2"></i>Remove</a></li>
									<li><a href="#"><i class="feather feather-settings mr-2"></i>More</a></li>
								</ul>
							</div>
						</div>
					</div>
					<div class="list-group-item  align-items-center  border-bottom">
						<div class="d-flex">
							<span class="avatar avatar-lg brround mr-3" style="background-image: url(assets/images/users/3.jpg)">	</span>
							<div class="mt-1">
								<a href="#" class="font-weight-semibold fs-16">Rina<span class="text-muted font-weight-normal"> your account has Updated</span></a>
								<span class="clearfix"></span>
								<span class="text-muted fs-13 ml-auto"><i class="mdi mdi-clock text-muted mr-1"></i>28 Nov 2020 7:16 Am</span>
							</div>
							<div class="ml-auto">
								<a href="" class="mr-0 option-dots" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
									<span class="feather feather-more-horizontal"></span>
								</a>
								<ul class="dropdown-menu dropdown-menu-right" role="menu">
									<li><a href="#"><i class="feather feather-eye mr-2"></i>View</a></li>
									<li><a href="#"><i class="feather feather-plus-circle mr-2"></i>Add</a></li>
									<li><a href="#"><i class="feather feather-trash-2 mr-2"></i>Remove</a></li>
									<li><a href="#"><i class="feather feather-settings mr-2"></i>More</a></li>
								</ul>
							</div>
						</div>
					</div>
					<div class="list-group-item  align-items-center  border-bottom">
						<div class="d-flex">
							<span class="avatar avatar-lg brround mr-3 bg-success-transparent">J</span>
							<div class="mt-1">
								<a href="#" class="font-weight-semibold fs-16">Julia<span class="text-muted font-weight-normal"> Prepare for Presentation</span></a>
								<span class="clearfix"></span>
								<span class="text-muted fs-13 ml-auto"><i class="mdi mdi-clock text-muted mr-1"></i>18 Nov 2020 11:55 Am</span>
							</div>
							<div class="ml-auto">
								<a href="" class="mr-0 option-dots" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
									<span class="feather feather-more-horizontal"></span>
								</a>
								<ul class="dropdown-menu dropdown-menu-right" role="menu">
									<li><a href="#"><i class="feather feather-eye mr-2"></i>View</a></li>
									<li><a href="#"><i class="feather feather-plus-circle mr-2"></i>Add</a></li>
									<li><a href="#"><i class="feather feather-trash-2 mr-2"></i>Remove</a></li>
									<li><a href="#"><i class="feather feather-settings mr-2"></i>More</a></li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!--/Sidebar-right-->

			<!--Change password Modal -->
			<div class="modal fade"  id="changepasswordnmodal">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title">Change Password</h5>
							<button  class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">×</span>
							</button>
						</div>
						<div class="modal-body">
							<div class="form-group">
								<label class="form-label">New Password</label>
								<input type="password" class="form-control" placeholder="password" value="">
							</div>
							<div class="form-group">
								<label class="form-label">Confirm New Password</label>
								<input type="password" class="form-control" placeholder="password" value="">
							</div>
						</div>
						<div class="modal-footer">
							<a href="#" class="btn btn-outline-primary" data-dismiss="modal">Close</a>
							<a href="#" class="btn btn-primary">Confirm</a>
						</div>
					</div>
				</div>
			</div>
			<!-- End Change password Modal  -->

		</div>

		<!-- Back to top -->
		<a href="#top" id="back-to-top"><span class="feather feather-chevrons-up"></span></a>

		<!-- Modal -->
		<div class="modal fade"  id="modalimg">
			<div class="modal-dialog modal-lg modal-dialog-centered modalmedia" role="document">
			  <div class="modal-content modal-content-demo">
				<div style="padding: 0 0;height: 530px;position: relative;" class="modal-body">
				  <div class="panel panel-primary">
					<div style="border-bottom: 1px solid #8080804f;" class=" tab-menu-heading p-0 bg-light">
					  <div class="tabs-menu1 ">
						<!-- Tabs -->
						<button style="position: absolute;top: 14px;right: 15px;" aria-label="Close" class="close" data-dismiss="modal" ><span aria-hidden="true">&times;</span></button>
						<ul class="nav panel-tabs">
						  <li class=""><a href="#tabupload" data-toggle="tab">Tải file lên</a></li>
						  <li><a href="#tabmedia" class="active" data-toggle="tab">Media</a></li>
						</ul>
					  </div>
					</div>
					<div class="panel-body tabs-menu-body">
					  <div class="tab-content">
						<div class="tab-pane" style="padding: 130px 0;" id="tabupload">
						  <div class="h-100 d-flex justify-content-center align-items-center">
							<div>
							  <div style="text-align: center;font-size: 20px">Thả các tập tin để tải lên</div>
							  <div style="text-align: center;margin: 10px 0">hoặc</div>
							  <div style="text-align: center;">
								  <form enctype="multipart/form-data" action="" method="POST">
								  <input type="hidden" name="_token" value="EdIKpVwSTMu0O76YAdbKwoVPJushSAOge2CS0ndS">                                
								  <label style="border: 1px solid steelblue;color: steelblue;padding: 10px 30px;cursor: pointer;" for="mediaupload">Chọn tập tin</label>
								  <input multiple="" onchange="return uploadmediaadmin()" style="display: none" type="file" name="mediaupload" id="mediaupload">
								  </form>
							  </div>
							  <div style="text-align: center;margin: 10px 0">Kích thước tập tin tải lên tối đa: 800 MB</div>
							</div>
						  </div>
						</div>
						<div  style="overflow: scroll;height: 436px;overflow-x: hidden;" class="tab-pane active" id="tabmedia">
						  <div style="margin-left: 20px" class="row">
							<input style="display: none" type="text" id="check">
						  </div>
						  <div id="contentimg">
							<div id="listimg" class="row">
								@foreach ($media_unique as $item)
									<div onclick="return selectimage({{ $item->id }})" id="listmedia{{ $item->id }}" class="col-md-4 col-lg-4 col-xl-2 itemimg">
										<img id="img{{ $item->id }}" class="imgmodal" src="http://{{ $item->ftp->host }}{{ $item->image_url }}" alt="">
										<span onclick="return opennotifi({{ $item->id }})" class="deletebutton"><i class="fe fe-trash-2"></i></span>
									</div>
								@endforeach
							</div>
						  </div>
						</div>
					  </div>
					</div>
				  </div>
				</div>
				<div style="border-top: 1px solid #8080804f;" class="modal-footer">
		
				  <div id="numberselect" style="position: absolute;left: 10px;display: none">
					<span>Đã chọn <span id="numberimg">0</span> ảnh</span>
					<button id="unchecked" onclick="return unchecked()" class="btn btn-primary">Bỏ chọn</button> 
					<button id="deleteall" onclick="return deleteall()" class="btn btn-primary">Xóa tất cả</button> 
				  </div>
		
				  <div id="divinsertmedia"><button onclick="return insertmedia()" id="insertmedia" class="btn btn-primary" disabled>Chèn ảnh</button></div>
				  {{--  <button class="btn btn-light" data-dismiss="modal" >Close</button>  --}}
				</div>
			  </div>
			</div>
		</div>


		<div class="modal fade"  id="modalicon">
			<div style="max-width: 40%;" class="modal-dialog modal-lg modal-dialog-centered modalmedia" role="document">
			  <div style="height: 400px;" class="modal-content modal-content-demo">
				<div style="padding: 0 0;height: 330px;position: relative;" class="modal-body">
				  <div class="panel panel-primary">
					<div style="border-bottom: 1px solid #8080804f;" class=" tab-menu-heading p-0 bg-light">
					  <div class="tabs-menu1 ">
						<!-- Tabs -->
						<button style="position: absolute;top: 14px;right: 15px;" aria-label="Close" class="close" data-dismiss="modal" ><span aria-hidden="true">&times;</span></button>
						<ul class="nav panel-tabs">
							<li><a onclick="return loadicon()" href="#tabicon" class="active" data-toggle="tab">Icon</a></li>
						  	<li class=""><a href="#tabuploadicon" data-toggle="tab">Tải icon lên</a></li>
						  	<li class=""><a href="#tutorial" data-toggle="tab">Hướng dẫn</a></li>
						</ul>
					  </div>
					</div>
					<div style="border: none;" class="panel-body tabs-menu-body">
					  <div class="tab-content">
						<div style="overflow: scroll;height: 236px;overflow-x: hidden;" class="tab-pane active" id="tabicon">
						  <div style="margin-left: 20px" class="row">
							<input style="display: none" type="text" id="check">
						  </div>
						  <div id="contenticon">
							<style>
								.iconitem i {
									font-size: 25px;
									cursor: pointer;
								}

								.iconitem i:hover {
									color: rgb(29, 75, 175);
								}

								.selecticon i {
									color: rgb(29, 75, 175);
								}
							</style>
							<div id="listicon" class="row">
								@foreach ($icon as $item)
									<div onclick="return selecticon({{ $item->id }})" id="listicon{{ $item->id }}" class="col-lg-1 iconitem">
										{!! html_entity_decode($item->icon) !!}
									</div>
								@endforeach
							</div>
						  </div>
						</div>

						<div style="text-align: center;padding-top: 90px" class="tab-pane" style="" id="tabuploadicon">
							<input style="display: none" type="text" name="checkicon" id="checkicon">
							<input type="text" id="texticon" class="form-control">
							<button onclick="return saveicon()" style="padding: 5px 25px;margin-top: 15px;" class="btn btn-success" type="button">Lưu</button>
						</div>

						<div style="overflow: scroll;height: 236px;overflow-x: hidden;" class="tab-pane" style="" id="tutorial">
							<h3>Hướng dẫn upload icon</h3>
							<span>B1: Vào trang <a style="color: rgb(33, 63, 199);text-decoration: underline" target="_blank" href="https://fontawesome.com/v4.7/icons/">Fontawesome</a> tìm và chọn icon muốn thêm</span><br>
							<span>B2: Coppy toàn bộ class như hình dưới</span><br>
							<img src="assets/images/web/hd.png" alt=""><br>
							<span>B3: Dán toàn bộ vào ô input như bên dưới và nhấn nút lưu</span><br>
							<img src="assets/images/web/hd1.png" alt=""><br>
						</div>
					  </div>
					</div>
				  </div>
				</div>
				<div style="border-top: 1px solid #8080804f;" class="modal-footer">
				  <div id="divinserticon"><button onclick="return inserticon()" id="inserticon" class="btn btn-primary" disabled>Chọn icon</button></div>
				</div>
			  </div>
			</div>
		</div>

		<!--Moment js-->
		<script src="assets/plugins/moment/moment.js"></script>

		<!-- Bootstrap4 js-->
		<script src="assets/plugins/bootstrap/popper.min.js"></script>
		<script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>

		<!--Othercharts js-->
		<script src="assets/plugins/othercharts/jquery.sparkline.min.js"></script>

		<!-- Circle-progress js-->
		<script src="assets/plugins/circle-progress/circle-progress.min.js"></script>

		<!--Sidemenu js-->
		<script src="assets/plugins/sidemenu/sidemenu.js"></script>

		<!-- P-scroll js-->
		<script src="assets/plugins/p-scrollbar/p-scrollbar.js"></script>
		<script src="assets/plugins/p-scrollbar/p-scroll1.js"></script>

		<!--Sidebar js-->
		<script src="assets/plugins/sidebar/sidebar.js"></script>

		<!-- Select2 js -->
		<script src="assets/plugins/select2/select2.full.min.js"></script>

		<!-- Custom js-->
		<script src="assets/js/custom.js"></script>

		<!-- INTERNAL Data tables -->
		<script src="assets/plugins/datatable/js/jquery.dataTables.min.js"></script>
		<script src="assets/plugins/datatable/js/dataTables.bootstrap4.js"></script>
		<script src="assets/plugins/datatable/js/dataTables.buttons.min.js"></script>
		<script src="assets/plugins/datatable/js/buttons.bootstrap4.min.js"></script>
		<script src="assets/plugins/datatable/js/jszip.min.js"></script>
		<script src="assets/plugins/datatable/pdfmake/pdfmake.min.js"></script>
		<script src="assets/plugins/datatable/pdfmake/vfs_fonts.js"></script>
		<script src="assets/plugins/datatable/js/buttons.html5.min.js"></script>
		<script src="assets/plugins/datatable/js/buttons.print.min.js"></script>
		<script src="assets/plugins/datatable/js/buttons.colVis.min.js"></script>
		<script src="assets/plugins/datatable/dataTables.responsive.min.js"></script>
		<script src="assets/plugins/datatable/responsive.bootstrap4.min.js"></script>
		<script src="assets/js/datatables.js"></script>

		<script src="assets/plugins/treeview/treeview.js"></script>

		<script src="assets/js/functionjs.js"></script>
		<script src="assets/js/media.js"></script>
		<script src="assets/plugins/toastr/toastr.min.js"></script>

		<script src="assets/plugins/wysiwyag/jquery.richtext.js"></script>
		<script src="assets/js/form-editor.js"></script>

		<script src="assets/plugins/jQuerytransfer/jquery.transfer.js"></script>

		<script src="assets/plugins/tagsinput/bootstrap-tagsinput.min.js"></script>

		<script>
            toastr.options = {
                "closeButton": true,
                "debug": false,
                "newestOnTop": false,
                "progressBar": false,
                "positionClass": "toast-top-right",
                "preventDuplicates": false,
                "onclick": null,
                "showDuration": "200",
                "hideDuration": "1000",
                "timeOut": "5000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            }
        </script>
        @if (session('success'))
            <script>
                toastr.success("{{ Session::get('success') }}");
            </script>
         @elseif(session('error'))
            <script>
                toastr.error("{{ Session::get('error') }}");
            </script> 
        @elseif(session('warning'))
            <script>
                toastr.warning("{{ Session::get('warning') }}");
            </script>
        @endif

		{{--  <script>
			console.log($('.itemimg').width());
		</script>  --}}
    </body>
</html>