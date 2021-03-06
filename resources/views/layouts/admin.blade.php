<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>{{ config('app.name', 'Survey') }}</title>
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/favicon.png') }}">
    
    <!-- Custom CSS -->
    <link href="{{ asset('libs/chartist/dist/chartist.min.css') }}" rel="stylesheet">
    <link href="{{ asset('extra-libs/c3/c3.min.css') }}" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

    @yield('styles')
</head>

<body>
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper  -->
    <!-- ============================================================== -->
    <div id="main-wrapper">
        <!-- ============================================================== -->

        <!-- ============================================================== -->
        <header class="topbar">
            <nav class="navbar top-navbar navbar-expand-md navbar-dark">
                <div class="navbar-header">
                    <!-- This is for the sidebar toggle which is visible on mobile only -->
                    <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"><i
						   class="ti-menu ti-close"></i></a>
                    <!-- ============================================================== -->
                    <!-- Logo -->
                    <!-- ============================================================== -->
                    <a class="navbar-brand" href="dashboard-classic.html">
                        <!-- Logo icon -->
                        <b class="logo-icon">
							<!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
							<!-- Dark Logo icon -->
							<img src="{{ asset('images/logo-icon.png') }}" alt="homepage" class="dark-logo" />
							<!-- Light Logo icon -->
							<img src="{{ asset('images/logo-light-icon.png') }}" alt="homepage" class="light-logo" />
						</b>
                        <!--End Logo icon -->
                        <!-- Logo text -->
                        <span class="logo-text">
							<!-- dark Logo text -->
							<img src="{{ asset('images/logo-text.png') }}" alt="homepage" class="dark-logo" />
							<!-- Light Logo text -->
							<img src="{{ asset('images/logo-light-text.png') }}" class="light-logo" alt="homepage" />
						</span>
                    </a>
                    <!-- ============================================================== -->
                    <!-- End Logo -->
                    <!-- ============================================================== -->
                    <!-- ============================================================== -->
                    <!-- Toggle which is visible on mobile only -->
                    <!-- ============================================================== -->
                    <a class="topbartoggler d-block d-md-none waves-effect waves-light" href="javascript:void(0)" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><i
						   class="ti-more"></i></a>
                </div>
                <!-- ============================================================== -->
                <!-- End Logo -->
                <!-- ============================================================== -->
                <div class="navbar-collapse collapse" id="navbarSupportedContent">
                    <!-- ============================================================== -->
                    <!-- toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav float-left mr-auto">
                        <li class="nav-item d-none d-md-block"><a class="nav-link sidebartoggler waves-effect waves-light" href="javascript:void(0)" data-sidebartype="mini-sidebar"><i class="mdi mdi-menu font-24"></i></a></li>
                        <!-- ============================================================== -->
                        <!-- mega menu -->
                        <!-- ============================================================== -->
                        <li class="nav-item dropdown mega-dropdown">
                            <a class="nav-link dropdown-toggle waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="d-none d-md-block">Mega <i class="fa fa-angle-down"></i></span>
                                <span class="d-block d-md-none"><i class="mdi mdi-bell-outline font-24"></i></span>
                            </a>
                            <div class="dropdown-menu animated bounceInDown">
                                <div class="mega-dropdown-menu row">
                                    <div class="col-lg-3 col-xlg-2 m-b-30">
                                        <h4 class="m-b-20">CAROUSEL</h4>
                                        <!-- CAROUSEL -->
                                        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                                            <div class="carousel-inner" role="listbox">
                                                <div class="carousel-item active">
                                                    <div class="container p-0"> <img class="d-block img-fluid" src="{{ asset('images/big/img1.jpg')}}" alt="First slide">
                                                    </div>
                                                </div>
                                                <div class="carousel-item">
                                                    <div class="container p-0"><img class="d-block img-fluid" src="{{ asset('images/big/img2.jpg') }}" alt="Second slide">
                                                    </div>
                                                </div>
                                                <div class="carousel-item">
                                                    <div class="container p-0"><img class="d-block img-fluid" src="{{ asset('images/big/img3.jpg') }}" alt="Third slide">
                                                    </div>
                                                </div>
                                            </div>
                                            <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev"> <span class="carousel-control-prev-icon" aria-hidden="true"></span> <span class="sr-only">Previous</span>
                                            </a>
                                            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next"> <span class="carousel-control-next-icon" aria-hidden="true"></span> <span class="sr-only">Next</span> </a>
                                        </div>
                                        <!-- End CAROUSEL -->
                                    </div>
                                    <div class="col-lg-3 m-b-30">
                                        <h4 class="m-b-20">ACCORDION</h4>
                                        <!-- Accordian -->
                                        <div id="accordion">
                                            <div class="card m-b-5">
                                                <div class="card-header" id="headingOne">
                                                    <h5 class="mb-0">
                                                        <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
															Collapsible Group Item #1
														</button>
                                                    </h5>
                                                </div>
                                                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                                                    <div class="card-body">
                                                        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry.
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card m-b-5">
                                                <div class="card-header" id="headingTwo">
                                                    <h5 class="mb-0">
                                                        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
															Collapsible Group Item #2
														</button>
                                                    </h5>
                                                </div>
                                                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                                                    <div class="card-body">
                                                        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry.
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card m-b-5">
                                                <div class="card-header" id="headingThree">
                                                    <h5 class="mb-0">
                                                        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
															Collapsible Group Item #3
														</button>
                                                    </h5>
                                                </div>
                                                <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                                                    <div class="card-body">
                                                        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry.
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3  m-b-30">
                                        <h4 class="m-b-20">CONTACT US</h4>
                                        <!-- Contact -->
                                        <form>
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="exampleInputname1" placeholder="Enter Name"> </div>
                                            <div class="form-group">
                                                <input type="email" class="form-control" placeholder="Enter email">
                                            </div>
                                            <div class="form-group">
                                                <textarea class="form-control" id="exampleTextarea" rows="3" placeholder="Message"></textarea>
                                            </div>
                                            <button type="submit" class="btn btn-info">Submit</button>
                                        </form>
                                    </div>
                                    <div class="col-lg-3 col-xlg-4 m-b-30">
                                        <h4 class="m-b-20">List style</h4>
                                        <!-- List style -->
                                        <ul class="list-style-none">
                                            <li><a href="javascript:void(0)"><i class="fa fa-check text-success"></i>
													You can give link</a></li>
                                            <li><a href="javascript:void(0)"><i class="fa fa-check text-success"></i>
													Give link</a></li>
                                            <li><a href="javascript:void(0)"><i class="fa fa-check text-success"></i>
													Another Give link</a></li>
                                            <li><a href="javascript:void(0)"><i class="fa fa-check text-success"></i>
													Forth link</a></li>
                                            <li><a href="javascript:void(0)"><i class="fa fa-check text-success"></i>
													Another fifth link</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <!-- ============================================================== -->
                        <!-- End mega menu -->
                        <!-- ============================================================== -->
                        <!-- ============================================================== -->
                        <!-- create new -->
                        <!-- ============================================================== -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="d-none d-md-block">Create New <i class="fa fa-angle-down"></i></span>
                                <span class="d-block d-md-none"><i class="fa fa-plus"></i></span>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="#">Action</a>
                                <a class="dropdown-item" href="#">Another action</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#">Something else here</a>
                            </div>
                        </li>
                        <!-- ============================================================== -->
                        <!-- Search -->
                        <!-- ============================================================== -->
                        <li class="nav-item search-box"> <a class="nav-link waves-effect waves-dark" href="javascript:void(0)"><i class="ti-search"></i></a>
                            <form class="app-search position-absolute">
                                <input type="text" class="form-control" placeholder="Search &amp; enter"> <a class="srh-btn"><i class="ti-close"></i></a>
                            </form>
                        </li>
                    </ul>
                    <!-- ============================================================== -->
                    <!-- Right side toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav float-right">
                        <!-- ============================================================== -->
                        <!-- create new -->
                        <!-- ============================================================== -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown2" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="flag-icon flag-icon-us"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right  animated bounceInDown" aria-labelledby="navbarDropdown2">
                                <a class="dropdown-item" href="#"><i class="flag-icon flag-icon-us"></i> English</a>
                                <a class="dropdown-item" href="#"><i class="flag-icon flag-icon-fr"></i> French</a>
                                <a class="dropdown-item" href="#"><i class="flag-icon flag-icon-es"></i> Spanish</a>
                                <a class="dropdown-item" href="#"><i class="flag-icon flag-icon-de"></i> German</a>
                            </div>
                        </li>
                        <!-- ============================================================== -->
                        <!-- Comment -->
                        <!-- ============================================================== -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="mdi mdi-bell-outline font-24"></i>

                            </a>
                            <div class="dropdown-menu dropdown-menu-right mailbox animated bounceInDown">
                                <span class="with-arrow"><span class="bg-primary"></span></span>
                                <ul class="list-style-none">
                                    <li>
                                        <div class="drop-title bg-primary text-white">
                                            <h4 class="m-b-0 m-t-5">4 New</h4>
                                            <span class="font-light">Notifications</span>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="message-center notifications">
                                            <!-- Message -->
                                            <a href="javascript:void(0)" class="message-item">
                                                <span class="btn btn-danger btn-circle"><i
													   class="fa fa-link"></i></span>
                                                <div class="mail-contnet">
                                                    <h5 class="message-title">Luanch Admin</h5> <span class="mail-desc">Just see the my new admin!</span> <span class="time">9:30 AM</span>
                                                </div>
                                            </a>
                                            <!-- Message -->
                                            <a href="javascript:void(0)" class="message-item">
                                                <span class="btn btn-success btn-circle"><i
													   class="ti-calendar"></i></span>
                                                <div class="mail-contnet">
                                                    <h5 class="message-title">Event today</h5> <span class="mail-desc">Just a reminder that you have event</span>
                                                    <span class="time">9:10 AM</span>
                                                </div>
                                            </a>
                                            <!-- Message -->
                                            <a href="javascript:void(0)" class="message-item">
                                                <span class="btn btn-info btn-circle"><i class="ti-settings"></i></span>
                                                <div class="mail-contnet">
                                                    <h5 class="message-title">Settings</h5> <span class="mail-desc">You
														can customize this template as you want</span> <span class="time">9:08 AM</span>
                                                </div>
                                            </a>
                                            <!-- Message -->
                                            <a href="javascript:void(0)" class="message-item">
                                                <span class="btn btn-primary btn-circle"><i class="ti-user"></i></span>
                                                <div class="mail-contnet">
                                                    <h5 class="message-title">Pavan kumar</h5> <span class="mail-desc">Just see the my admin!</span> <span class="time">9:02 AM</span>
                                                </div>
                                            </a>
                                        </div>
                                    </li>
                                    <li>
                                        <a class="nav-link text-center m-b-5" href="javascript:void(0);"> <strong>Check
												all notifications</strong> <i class="fa fa-angle-right"></i> </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <!-- ============================================================== -->
                        <!-- End Comment -->
                        <!-- ============================================================== -->
                        <!-- ============================================================== -->
                        <!-- Messages -->
                        <!-- ============================================================== -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle waves-effect waves-dark" href="" id="2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="font-24 mdi mdi-comment-text-outline"></i>

                            </a>
                            <div class="dropdown-menu dropdown-menu-right mailbox animated bounceInDown" aria-labelledby="2">
                                <span class="with-arrow"><span class="bg-danger"></span></span>
                                <ul class="list-style-none">
                                    <li>
                                        <div class="drop-title text-white bg-danger">
                                            <h4 class="m-b-0 m-t-5">5 New</h4>
                                            <span class="font-light">Messages</span>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="message-center message-body">
                                            <!-- Message -->
                                            <a href="javascript:void(0)" class="message-item">
                                                <span class="user-img"> 
                                                    <img src="{{ asset('images/users/1.jpg') }}" alt="user" class="rounded-circle">
                                                    <span class="profile-status online pull-right"></span> 
                                                </span>
                                                <div class="mail-contnet">
                                                    <h5 class="message-title">Pavan kumar</h5> <span class="mail-desc">Just see the my admin!</span> <span class="time">9:30 AM</span>
                                                </div>
                                            </a>
                                            <!-- Message -->
                                            <a href="javascript:void(0)" class="message-item">
                                                <span class="user-img"> 
                                                    <img src="{{ asset('images/users/2.jpg') }}" alt="user" class="rounded-circle"> 
                                                    <span class="profile-status busy pull-right"></span> 
                                                </span>
                                                <div class="mail-contnet">
                                                    <h5 class="message-title">Sonu Nigam</h5> <span class="mail-desc">I've sung a song! See you at</span> <span class="time">9:10 AM</span>
                                                </div>
                                            </a>
                                            <!-- Message -->
                                            <a href="javascript:void(0)" class="message-item">
                                                <span class="user-img"> 
                                                    <img src="{{ asset('images/users/3.jpg') }}" alt="user" class="rounded-circle"> 
                                                    <span class="profile-status away pull-right"></span> 
                                                </span>
                                                <div class="mail-contnet">
                                                    <h5 class="message-title">Arijit Sinh</h5> <span class="mail-desc">I
														am a singer!</span> <span class="time">9:08 AM</span>
                                                </div>
                                            </a>
                                            <!-- Message -->
                                            <a href="javascript:void(0)" class="message-item">
                                                <span class="user-img"> 
                                                    <img src="{{ asset('images/users/4.jpg') }}" alt="user" class="rounded-circle"> 
                                                    <span class="profile-status offline pull-right"></span> 
                                                </span>
                                                <div class="mail-contnet">
                                                    <h5 class="message-title">Pavan kumar</h5> <span class="mail-desc">Just see the my admin!</span> <span class="time">9:02 AM</span>
                                                </div>
                                            </a>
                                        </div>
                                    </li>
                                    <li>
                                        <a class="nav-link text-center link" href="javascript:void(0);"> <b>See all
												e-Mails</b> <i class="fa fa-angle-right"></i> </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark pro-pic" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="{{ asset('images/users/1.jpg') }}" alt="user" class="rounded-circle" width="31"></a>
                            <div class="dropdown-menu dropdown-menu-right user-dd animated flipInY">
                                <span class="with-arrow"><span class="bg-primary"></span></span>
                                <div class="d-flex no-block align-items-center p-15 bg-primary text-white m-b-10">
                                    <div class=""><img src="{{ asset('images/users/1.jpg') }}" alt="user" class="img-circle" width="60"></div>
                                    <div class="m-l-10">
                                        <h4 class="m-b-0">Sa Done</h4>
                                        <p class=" m-b-0">name@email.com</p>
                                    </div>
                                </div>
                                <a class="dropdown-item" href="javascript:void(0)"><i class="ti-user m-r-5 m-l-5"></i>
									My Profile</a>
                                <a class="dropdown-item" href="javascript:void(0)"><i class="ti-wallet m-r-5 m-l-5"></i>
									My Balance</a>
                                <a class="dropdown-item" href="javascript:void(0)"><i class="ti-email m-r-5 m-l-5"></i>
									Inbox</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="javascript:void(0)"><i  class="ti-settings m-r-5 m-l-5"></i> Account Setting</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i  class="fa fa-power-off m-r-5 m-l-5"></i> Logout</a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                                <div class="dropdown-divider"></div>
                                <div class="p-l-30 p-10"><a href="javascript:void(0)" class="btn btn-sm btn-success btn-rounded">View Profile</a></div>
                            </div>
                        </li>
                        <!-- ============================================================== -->
                        <!-- User profile and search -->
                        <!-- ============================================================== -->
                    </ul>
                </div>
            </nav>
        </header>
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->

        <!-- ============================================================== -->
        <aside class="left-sidebar">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <li class="sidebar-item">
                            <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                                <i class=" mdi mdi-home-outline"></i>
                                <span class="hide-menu">Dashboard </span></a>
                            <ul aria-expanded="false" class="collapse  first-level">
                                <li class="sidebar-item">
                                    <a href="dashboard-classic.html" class="sidebar-link">
                                        <i class="mdi mdi-minus"></i><span class="hide-menu"> Classic </span></a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="dashboard-analytical.html" class="sidebar-link">
                                        <i class="mdi mdi-minus"></i><span class="hide-menu"> Analytical </span></a>
                                </li>
                                <li class="sidebar-item"><a href="dashboard-cryptocurrency.html" class="sidebar-link"><i
                                   class="mdi mdi-minus"></i><span class="hide-menu"> Cryptocurrency</span></a></li>
                                <li class="sidebar-item">
                                    <a href="dashboard-modern.html" class="sidebar-link">
                                        <i class="mdi mdi-minus"></i><span class="hide-menu"> Modern</span></a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="dashboard-ecommerce.html" class="sidebar-link">
                                        <i class="mdi mdi-minus"></i><span class="hide-menu"> E-Commerce </span></a>
                                </li>
                                <li class="sidebar-item"><a href="dashboard-sales.html" class="sidebar-link"><i
                                   class="mdi mdi-minus"></i><span class="hide-menu"> Sales </span></a></li>
                            </ul>
                        </li>
                        <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-email-outline"></i><span
                              class="hide-menu">Inbox </span></a>
                            <ul aria-expanded="false" class="collapse  first-level">
                                <li class="sidebar-item"><a href="inbox.html" class="sidebar-link"><i
                                   class="mdi mdi-minus"></i><span class="hide-menu"> Email </span></a></li>
                                <li class="sidebar-item"><a href="inbox-detail.html" class="sidebar-link"><i
                                   class="mdi mdi-minus"></i><span class="hide-menu"> Email Detail </span></a>
                                </li>
                                <li class="sidebar-item"><a href="inbox-compose.html" class="sidebar-link"><i
                                   class="mdi mdi-minus"></i><span class="hide-menu"> Email Compose </span></a>
                                </li>
                            </ul>
                        </li>
                        <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i
                           class="mdi mdi-bookmark-plus-outline"></i><span class="hide-menu">Ticket </span></a>
                            <ul aria-expanded="false" class="collapse  first-level">
                                <li class="sidebar-item"><a href="ticket-list.html" class="sidebar-link"><i
                                   class="mdi mdi-minus"></i><span class="hide-menu"> Ticket List </span></a>
                                </li>
                                <li class="sidebar-item"><a href="ticket-detail.html" class="sidebar-link"><i
                                   class="mdi mdi-minus"></i><span class="hide-menu"> Ticket Detail </span></a></li>
                            </ul>
                        </li>
                        <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-diamond"></i><span
                              class="hide-menu">App</span></a>
                            <ul aria-expanded="false" class="collapse  first-level">
                                <li class="sidebar-item">
                                    <a href="app-chats.html" class="sidebar-link">
                                        <i class="mdi mdi-minus"></i><span class="hide-menu"> Chats Apps </span></a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="app-calendar.html" class="sidebar-link">
                                        <i class="mdi mdi-minus"></i><span class="hide-menu"> Calender </span></a>
                                </li>
                                <li class="sidebar-item"><a href="app-taskboard.html" class="sidebar-link"><i
                                   class="mdi mdi-minus"></i><span class="hide-menu"> Taskboard</span></a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="app-starter.html" class="sidebar-link">
                                        <i class="mdi mdi-minus"></i>
                                        <span class="hide-menu">Starter Kit</span></a>
                                </li>
                                <li class="sidebar-item"><a href="app-animation.html" class="sidebar-link"><i
                                   class="mdi mdi-minus"></i> <span class="hide-menu">Animation</span></a></li>
                                <li class="sidebar-item"><a href="app-gallery.html" class="sidebar-link"><i
                                   class="mdi mdi-minus"></i>
                                <span class="hide-menu">Gallery</span></a></li>
                                <li class="sidebar-item"><a href="app-treeview.html" class="sidebar-link"><i
                                   class="mdi mdi-minus"></i>
                                <span class="hide-menu">Treeview</span></a></li>


                            </ul>
                        </li>
                        <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-lightbulb-outline"></i><span
                              class="hide-menu">Ui Elements </span></a>
                            <ul aria-expanded="false" class="collapse first-level">
                                <li class="sidebar-item"><a href="ui-buttons.html" class="sidebar-link"><i
                                   class="mdi mdi-minus"></i><span class="hide-menu"> Buttons</span></a></li>
                                <li class="sidebar-item"><a href="ui-modals.html" class="sidebar-link"><i
                                   class="mdi mdi-minus"></i><span class="hide-menu"> Modals</span></a></li>
                                <li class="sidebar-item"><a href="ui-tab.html" class="sidebar-link"><i
                                   class="mdi mdi-minus"></i><span class="hide-menu"> Tab</span></a></li>
                                <li class="sidebar-item"><a href="ui-tooltip-popover.html" class="sidebar-link"><i
                                   class="mdi mdi-minus"></i><span class="hide-menu"> Tooltip &amp; Popover</span></a>
                                </li>
                                <li class="sidebar-item"><a href="ui-notification.html" class="sidebar-link"><i
                                   class="mdi mdi-minus"></i><span class="hide-menu"> Notification</span></a>
                                </li>
                                <li class="sidebar-item"><a href="ui-progressbar.html" class="sidebar-link"><i
                                   class="mdi mdi-minus"></i><span class="hide-menu"> Progressbar</span></a></li>
                                <li class="sidebar-item"><a href="ui-typography.html" class="sidebar-link"><i
                                   class="mdi mdi-minus"></i><span class="hide-menu"> Typography</span></a></li>
                                <li class="sidebar-item"><a href="ui-bootstrap.html" class="sidebar-link"><i
                                   class="mdi mdi-minus"></i><span class="hide-menu"> Bootstrap Ui</span></a></li>
                                <li class="sidebar-item"><a href="ui-breadcrumb.html" class="sidebar-link"><i
                                   class="mdi mdi-minus"></i><span class="hide-menu"> Breadcrumb</span></a></li>
                                <li class="sidebar-item"><a href="ui-list-media.html" class="sidebar-link"><i
                                   class="mdi mdi-minus"></i><span class="hide-menu"> List Media</span></a></li>
                                <li class="sidebar-item"><a href="ui-grid.html" class="sidebar-link"><i
                                   class="mdi mdi-minus"></i><span class="hide-menu"> Grid</span></a></li>
                                <li class="sidebar-item"><a href="ui-carousel.html" class="sidebar-link"><i
                                   class="mdi mdi-minus"></i><span class="hide-menu"> Carousel</span></a></li>
                            </ul>
                        </li>
                        <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-memory"></i><span
                              class="hide-menu">Cards</span></a>
                            <ul aria-expanded="false" class="collapse  first-level">
                                <li class="sidebar-item"><a href="cards.html" class="sidebar-link"><i
                                   class="mdi mdi-minus"></i><span class="hide-menu"> Basic Cards</span></a></li>
                                <li class="sidebar-item"><a href="card-customs.html" class="sidebar-link"><i
                                   class="mdi mdi-minus"></i><span class="hide-menu">Custom Cards</span></a>
                                </li>
                                <li class="sidebar-item"><a href="card-weather.html" class="sidebar-link"><i
                                   class="mdi mdi-minus"></i><span class="hide-menu">Weather Cards</span></a></li>
                                <li class="sidebar-item"><a href="card-draggable.html" class="sidebar-link"><i
                                   class="mdi mdi-minus"></i><span class="hide-menu">Draggable Cards</span></a></li>
                            </ul>
                        </li>
                        <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-account-star"></i><span
                              class="hide-menu">Components</span></a>
                            <ul aria-expanded="false" class="collapse  first-level">
                                <li class="sidebar-item"><a href="component-sweetalert.html" class="sidebar-link"><i
                                   class="mdi mdi-minus"></i><span class="hide-menu"> Sweet Alert</span></a></li>
                                <li class="sidebar-item"><a href="component-nestable.html" class="sidebar-link"><i
                                   class="mdi mdi-minus"></i><span class="hide-menu">Nestable</span></a></li>
                                <li class="sidebar-item"><a href="component-noui-slider.html" class="sidebar-link"><i
                                   class="mdi mdi-minus"></i><span class="hide-menu">Noui slider</span></a></li>
                                <li class="sidebar-item"><a href="component-rating.html" class="sidebar-link"><i
                                   class="mdi mdi-minus"></i><span class="hide-menu">Rating</span></a></li>
                                <li class="sidebar-item"><a href="component-toastr.html" class="sidebar-link"><i
                                   class="mdi mdi-minus"></i><span class="hide-menu">Toastr</span></a></li>
                            </ul>
                        </li>
                        <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-bank"></i><span
                              class="hide-menu">Widgets </span></a>
                            <ul aria-expanded="false" class="collapse  first-level">
                                <li class="sidebar-item"><a href="widgets-apps.html" class="sidebar-link"><i
                                   class="mdi mdi-minus"></i><span class="hide-menu"> Apps Widgets </span></a></li>
                                <li class="sidebar-item"><a href="widgets-data.html" class="sidebar-link"><i
                                   class="mdi mdi-minus"></i><span class="hide-menu"> Data Widgets </span></a></li>
                                <li class="sidebar-item"><a href="widgets-charts.html" class="sidebar-link"><i
                                   class="mdi mdi-minus"></i><span class="hide-menu"> Charts Widgets</span></a>
                                </li>
                            </ul>
                        </li>
                        <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-collage"></i><span
                              class="hide-menu">Forms</span></a>
                            <ul aria-expanded="false" class="collapse first-level">
                                <li class="sidebar-item"><a href="form-inputs.html" class="sidebar-link"><i
                                   class="mdi mdi-minus"></i><span class="hide-menu"> Forms Input</span></a></li>
                                <li class="sidebar-item"><a href="form-input-groups.html" class="sidebar-link"><i
                                   class="mdi mdi-minus"></i><span class="hide-menu"> Input Groups</span></a>
                                </li>
                                <li class="sidebar-item"><a href="form-input-grid.html" class="sidebar-link"><i
                                   class="mdi mdi-minus"></i><span class="hide-menu"> Input Grid</span></a></li>
                                <li class="sidebar-item"><a href="form-checkbox-radio.html" class="sidebar-link"><i
                                   class="mdi mdi-minus"></i><span class="hide-menu"> Checkboxes &amp; Radios</span></a>
                                </li>
                                <li class="sidebar-item"><a href="form-bootstrap-touchspin.html" class="sidebar-link"><i
                                   class="mdi mdi-minus"></i><span class="hide-menu"> Bootstrap Touchspin</span></a>
                                </li>
                                <li class="sidebar-item"><a href="form-bootstrap-switch.html" class="sidebar-link"><i
                                   class="mdi mdi-minus"></i><span class="hide-menu"> Bootstrap Switch</span></a></li>
                                <li class="sidebar-item"><a href="form-select2.html" class="sidebar-link"><i
                                   class="mdi mdi-minus"></i><span class="hide-menu"> Select2</span></a></li>
                                <li class="sidebar-item"><a href="form-dual-listbox.html" class="sidebar-link"><i
                                   class="mdi mdi-minus"></i><span class="hide-menu"> Dual Listbox</span></a>
                                </li>
                                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="form-wizard.html" aria-expanded="false"><i class="mdi mdi-minus"></i><span
                                      class="hide-menu">Form Wizard</span></a>
                                </li>
                                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="form-repeater.html" aria-expanded="false"><i class="mdi mdi-minus"></i><span
                                      class="hide-menu">Form Repeater</span></a></li>
                                <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-receipt"></i><span
                                      class="hide-menu">Form Layouts</span></a>
                                    <ul aria-expanded="false" class="collapse first-level">
                                        <li class="sidebar-item"><a href="form-basic.html" class="sidebar-link"><i
                                           class="mdi mdi-minus"></i><span class="hide-menu"> Basic Forms</span></a>
                                        </li>
                                        <li class="sidebar-item"><a href="form-horizontal.html" class="sidebar-link"><i
                                           class="mdi mdi-minus"></i><span class="hide-menu"> Form Horizontal</span></a>
                                        </li>
                                        <li class="sidebar-item"><a href="form-actions.html" class="sidebar-link"><i
                                           class="mdi mdi-minus"></i><span class="hide-menu"> Form Actions</span></a>
                                        </li>

                                        <li class="sidebar-item"><a href="form-bordered.html" class="sidebar-link"><i
                                           class="mdi mdi-minus"></i><span class="hide-menu"> Form Bordered</span></a>
                                        </li>
                                        <li class="sidebar-item"><a href="form-striped-row.html" class="sidebar-link"><i
                                           class="mdi mdi-minus"></i><span class="hide-menu"> Striped Rows</span></a>
                                        </li>
                                        <li class="sidebar-item"><a href="form-detail.html" class="sidebar-link"><i
                                           class="mdi mdi-minus"></i><span class="hide-menu"> Form Detail</span></a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-code-equal"></i><span
                                      class="hide-menu">Form Addons</span></a>
                                    <ul aria-expanded="false" class="collapse first-level">
                                        <li class="sidebar-item"><a href="form-paginator.html" class="sidebar-link"><i
                                           class="mdi mdi-minus"></i><span class="hide-menu"> Paginator</span></a></li>
                                        <li class="sidebar-item"><a href="form-img-cropper.html" class="sidebar-link"><i
                                           class="mdi mdi-minus"></i><span class="hide-menu"> Image Cropper</span></a>
                                        </li>
                                        <li class="sidebar-item"><a href="form-dropzone.html" class="sidebar-link"><i
                                           class="mdi mdi-minus"></i><span class="hide-menu"> Dropzone</span></a></li>
                                        <li class="sidebar-item"><a href="form-mask.html" class="sidebar-link"><i
                                           class="mdi mdi-minus"></i><span class="hide-menu"> Form Mask</span></a>
                                        </li>
                                        <li class="sidebar-item"><a href="form-typeahead.html" class="sidebar-link"><i
                                           class="mdi mdi-minus"></i><span class="hide-menu"> Form Typehead</span></a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-alert-box"></i><span
                                      class="hide-menu">Form Validation</span></a>
                                    <ul aria-expanded="false" class="collapse first-level">
                                        <li class="sidebar-item"><a href="form-bootstrap-validation.html" class="sidebar-link"><i class="mdi mdi-minus"></i><span class="hide-menu">
                                            Bootstrap Validation</span></a></li>
                                        <li class="sidebar-item"><a href="form-custom-validation.html" class="sidebar-link"><i
                                           class="mdi mdi-minus"></i><span class="hide-menu"> Custom
                                            Validation</span></a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i
                                   class="mdi mdi-pencil-box-outline"></i><span class="hide-menu">Form
                                    Pickers</span></a>
                                    <ul aria-expanded="false" class="collapse first-level">
                                        <li class="sidebar-item"><a href="form-picker-colorpicker.html" class="sidebar-link"><i
                                           class="mdi mdi-minus"></i><span class="hide-menu"> Form
                                            Colorpicker</span></a></li>
                                        <li class="sidebar-item"><a href="form-picker-datetimepicker.html" class="sidebar-link"><i class="mdi mdi-minus"></i><span
                                              class="hide-menu"> Form Datetimepicker</span></a>
                                        </li>
                                        <li class="sidebar-item"><a href="form-picker-bootstrap-rangepicker.html" class="sidebar-link"><i class="mdi mdi-minus"></i><span class="hide-menu"> Form
                                            Bootstrap Rangepicker</span></a></li>
                                        <li class="sidebar-item"><a href="form-picker-bootstrap-datepicker.html" class="sidebar-link"><i class="mdi mdi-minus"></i><span class="hide-menu"> Form
                                            Bootstrap Datepicker</span></a></li>
                                        <li class="sidebar-item"><a href="form-picker-material-datepicker.html" class="sidebar-link"><i class="mdi mdi-minus"></i><span class="hide-menu"> Form
                                            Material Datepicker</span></a></li>
                                    </ul>
                                </li>
                                <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-dns"></i><span
                                      class="hide-menu">Form Editor</span></a>
                                    <ul aria-expanded="false" class="collapse first-level">
                                        <li class="sidebar-item"><a href="form-editor-ckeditor.html" class="sidebar-link"><i
                                           class="mdi mdi-minus"></i><span class="hide-menu">Ck Editor</span></a></li>
                                        <li class="sidebar-item"><a href="form-editor-quill.html" class="sidebar-link"><i
                                           class="mdi mdi-minus"></i><span class="hide-menu">Quill Editor</span></a>
                                        </li>
                                        <li class="sidebar-item"><a href="form-editor-summernote.html" class="sidebar-link"><i
                                           class="mdi mdi-minus"></i><span class="hide-menu">Summernote
                                            Editor</span></a></li>
                                        <li class="sidebar-item"><a href="form-editor-tinymce.html" class="sidebar-link"><i
                                           class="mdi mdi-minus"></i><span class="hide-menu">Tinymce Edtor</span></a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-border-none"></i><span
                              class="hide-menu"> Tables</span></a>
                            <ul aria-expanded="false" class="collapse first-level">
                                <li class="sidebar-item"><a href="table-basic.html" class="sidebar-link"><i
                                   class="mdi mdi-minus"></i><span class="hide-menu">Basic Table </span></a></li>
                                <li class="sidebar-item"><a href="table-dark-basic.html" class="sidebar-link"><i
                                   class="mdi mdi-minus"></i><span class="hide-menu">Dark Basic Table </span></a>
                                </li>
                                <li class="sidebar-item"><a href="table-sizing.html" class="sidebar-link"><i
                                   class="mdi mdi-minus"></i><span class="hide-menu">Sizing Table </span></a>
                                </li>
                                <li class="sidebar-item"><a href="table-layout-coloured.html" class="sidebar-link"><i
                                   class="mdi mdi-minus"></i><span class="hide-menu">Coloured Table Layout</span></a>
                                </li>
                                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="table-jsgrid.html" aria-expanded="false"><i  class="mdi mdi-minus"></i><span
                                      class="hide-menu">Table Jsgrid</span></a>
                                </li>
                                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="table-responsive.html" aria-expanded="false"><i
                                   class="mdi mdi-minus"></i><span class="hide-menu">Table Responsive</span></a>
                                </li>
                                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="table-footable.html" aria-expanded="false"><i
                                   class="mdi mdi-minus"></i><span class="hide-menu">Table Footable</span></a>
                                </li>
                            </ul>
                        </li>
                        <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-chart-line"></i><span
                              class="hide-menu">Charts</span></a>
                            <ul aria-expanded="false" class="collapse first-level">
                                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="chart-morris.html" aria-expanded="false"><i
                                   class="mdi mdi-minus"></i><span class="hide-menu"> Morris
                                    Chart</span></a></li>
                                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="chart-chart-js.html" aria-expanded="false"><i class="mdi mdi-minus"></i><span
                                      class="hide-menu">Chartjs</span></a></li>
                                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="chart-sparkline.html" aria-expanded="false"><i
                                   class="mdi mdi-minus"></i><span class="hide-menu">Sparkline
                                    Chart</span></a>
                                </li>
                                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="chart-chartist.html" aria-expanded="false"><i class="mdi mdi-minus"></i><span
                                      class="hide-menu">Chartist Chart</span></a></li>
                                <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i
                                   class="mdi mdi-chemical-weapon"></i><span class="hide-menu">C3 Charts</span></a>
                                    <ul aria-expanded="false" class="collapse first-level">
                                        <li class="sidebar-item"><a href="chart-c3-axis.html" class="sidebar-link"><i
                                           class="mdi mdi-minus"></i> <span class="hide-menu">Axis
                                            Chart</span></a></li>
                                        <li class="sidebar-item"><a href="chart-c3-bar.html" class="sidebar-link"><i
                                           class="mdi mdi-minus"></i> <span class="hide-menu">Bar
                                            Chart</span></a></li>
                                        <li class="sidebar-item"><a href="chart-c3-data.html" class="sidebar-link"><i
                                           class="mdi mdi-minus"></i> <span class="hide-menu">Data
                                            Chart</span></a></li>
                                        <li class="sidebar-item"><a href="chart-c3-line.html" class="sidebar-link"><i
                                           class="mdi mdi-minus"></i> <span class="hide-menu">Line Chart</span></a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i
                                   class="mdi mdi-chart-areaspline"></i><span class="hide-menu">Echarts</span></a>
                                    <ul aria-expanded="false" class="collapse first-level">
                                        <li class="sidebar-item"><a href="chart-echart-basic.html" class="sidebar-link"><i
                                           class="mdi mdi-minus"></i> <span class="hide-menu">Basic
                                            Charts</span></a>
                                        </li>
                                        <li class="sidebar-item"><a href="chart-echart-bar.html" class="sidebar-link"><i
                                           class="mdi mdi-minus"></i> <span class="hide-menu">Bar
                                            Chart</span></a></li>
                                        <li class="sidebar-item"><a href="chart-echart-pie-doughnut.html" class="sidebar-link"><i class="mdi mdi-minus"></i> <span
                                              class="hide-menu">Pie &amp; Doughnut Chart</span></a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-cart-outline"></i><span
                              class="hide-menu">Ecommerce Pages</span></a>
                            <ul aria-expanded="false" class="collapse first-level">
                                <li class="sidebar-item"><a href="products.html" class="sidebar-link"><i
                                   class="mdi mdi-minus"></i> <span class="hide-menu">Products</span></a></li>
                                <li class="sidebar-item"><a href="products-cart.html" class="sidebar-link"><i
                                   class="mdi mdi-minus"></i> <span class="hide-menu">Products Cart</span></a></li>
                                <li class="sidebar-item"><a href="products-edit.html" class="sidebar-link"><i
                                   class="mdi mdi-minus"></i> <span class="hide-menu">Products Edit</span></a></li>
                                <li class="sidebar-item"><a href="products-detail.html" class="sidebar-link"><i
                                   class="mdi mdi-minus"></i> <span class="hide-menu">Product Details</span></a>
                                </li>
                                <li class="sidebar-item"><a href="products-orders.html" class="sidebar-link"><i
                                   class="mdi mdi-minus"></i> <span class="hide-menu">Product Orders</span></a></li>
                                <li class="sidebar-item"><a href="products-checkout.html" class="sidebar-link"><i
                                   class="mdi mdi-minus"></i> <span class="hide-menu">Products
                                    Checkout</span></a></li>
                            </ul>
                        </li>

                        <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-lock-outline"></i><span
                              class="hide-menu">Authentication</span></a>
                            <ul aria-expanded="false" class="collapse first-level">
                                <li class="sidebar-item"><a href="authentication-login1.html" class="sidebar-link"><i
                                   class="mdi mdi-minus"></i><span class="hide-menu"> Login </span></a></li>
                                <li class="sidebar-item"><a href="authentication-login2.html" class="sidebar-link"><i
                                   class="mdi mdi-minus"></i><span class="hide-menu"> Login 2 </span></a></li>
                                <li class="sidebar-item"><a href="authentication-register1.html" class="sidebar-link"><i
                                   class="mdi mdi-minus"></i><span class="hide-menu"> Register</span></a></li>
                                <li class="sidebar-item"><a href="authentication-register2.html" class="sidebar-link"><i
                                   class="mdi mdi-minus"></i><span class="hide-menu"> Register 2</span></a></li>
                                <li class="sidebar-item"><a href="authentication-lockscreen.html" class="sidebar-link"><i
                                   class="mdi mdi-minus"></i><span class="hide-menu"> Lockscreen</span></a></li>
                                <li class="sidebar-item"><a href="authentication-recover-password.html" class="sidebar-link"><i
                                   class="mdi mdi-minus"></i><span class="hide-menu"> Recover password</span></a></li>
                            </ul>
                        </li>
                        <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-emoticon-cool"></i><span
                              class="hide-menu">Users</span></a>
                            <ul aria-expanded="false" class="collapse first-level">
                                <li class="sidebar-item"><a href="user-cards.html" class="sidebar-link"><i
                                    class="mdi mdi-minus"></i><span class="hide-menu"> User Card </span></a></li>
                                <li class="sidebar-item"><a href="user-profile.html" class="sidebar-link"><i
                                   class="mdi mdi-minus"></i><span class="hide-menu"> User Profile</span></a>
                                </li>
                                <li class="sidebar-item"><a href="user-contacts.html" class="sidebar-link"><i
                                   class="mdi mdi-minus"></i><span class="hide-menu"> User Contact</span></a></li>
                            </ul>
                        </li>
                        <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-ungroup"></i><span
                              class="hide-menu">Invoice</span></a>
                            <ul aria-expanded="false" class="collapse first-level">
                                <li class="sidebar-item"><a href="invoice.html" class="sidebar-link"><i
                                   class="mdi mdi-minus"></i><span class="hide-menu"> Invoice Layout </span></a></li>
                                <li class="sidebar-item"><a href="invoice-list.html" class="sidebar-link"><i
                                   class="mdi mdi-minus"></i><span class="hide-menu"> Invoice List</span></a>
                                </li>
                            </ul>
                        </li>
                        <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-map-marker"></i><span
                              class="hide-menu">Maps</span></a>
                            <ul aria-expanded="false" class="collapse first-level">
                                <li class="sidebar-item"><a href="map-google.html" class="sidebar-link"><i
                                   class="mdi mdi-minus"></i><span class="hide-menu"> Google Map </span></a></li>
                                <li class="sidebar-item"><a href="map-vector.html" class="sidebar-link"><i
                                   class="mdi mdi-minus"></i><span class="hide-menu"> Vector Map</span></a>
                                </li>
                            </ul>
                        </li>
                        <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-laptop"></i><span
                              class="hide-menu">Icons</span></a>
                            <ul aria-expanded="false" class="collapse first-level">
                                <li class="sidebar-item"><a href="icon-material.html" class="sidebar-link"><i
                                   class="mdi mdi-minus"></i><span class="hide-menu"> Material Icons </span></a>
                                </li>
                                <li class="sidebar-item"><a href="icon-fontawesome.html" class="sidebar-link"><i
                                   class="mdi mdi-minus"></i><span class="hide-menu"> Fontawesome Icons</span></a></li>
                                <li class="sidebar-item"><a href="icon-themify.html" class="sidebar-link"><i
                                   class="mdi mdi-minus"></i><span class="hide-menu"> Themify Icons</span></a>
                                </li>
                                <li class="sidebar-item"><a href="icon-weather.html" class="sidebar-link"><i
                                   class="mdi mdi-minus"></i><span class="hide-menu"> Weather Icons</span></a>
                                </li>
                                <li class="sidebar-item"><a href="icon-simple-lineicon.html" class="sidebar-link"><i
                                    class="mdi mdi-minus"></i><span  class="hide-menu"> Simple Line
                                    icons</span></a></li>
                                <li class="sidebar-item"><a href="icon-flag.html" class="sidebar-link"><i
                                   class="mdi mdi-minus"></i><span class="hide-menu"> Flag Icons</span></a></li>
                            </ul>
                        </li>
                        <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-chart-timeline"></i><span
                              class="hide-menu">Timeline</span></a>
                            <ul aria-expanded="false" class="collapse first-level">
                                <li class="sidebar-item"><a href="timeline-center.html" class="sidebar-link"><i
                                    class="mdi mdi-minus"></i> <span class="hide-menu"> Center Timeline </span></a>
                                </li>
                                <li class="sidebar-item"><a href="timeline-horizontal.html" class="sidebar-link"><i
                                   class="mdi mdi-minus"></i><span class="hide-menu"> Horizontal Timeline</span></a>
                                </li>
                                <li class="sidebar-item"><a href="timeline-left.html" class="sidebar-link"><i
                                   class="mdi mdi-minus"></i><span class="hide-menu"> Left Timeline</span></a></li>
                                <li class="sidebar-item"><a href="timeline-right.html" class="sidebar-link"><i
                                   class="mdi mdi-minus"></i><span class="hide-menu"> Right Timeline</span></a>
                                </li>
                            </ul>
                        </li>

                        <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-block-helper"></i><span
                              class="hide-menu">Error Pages</span></a>
                            <ul aria-expanded="false" class="collapse first-level">
                                <li class="sidebar-item"><a href="error-400.html" class="sidebar-link"><i
                                   class="mdi mdi-minus"></i> <span class="hide-menu"> Error 400 </span></a>
                                </li>
                                <li class="sidebar-item"><a href="error-403.html" class="sidebar-link"><i
                                   class="mdi mdi-minus"></i><span class="hide-menu"> Error 403</span></a></li>
                                <li class="sidebar-item"><a href="error-404.html" class="sidebar-link"><i
                                   class="mdi mdi-minus"></i><span class="hide-menu"> Error 404</span></a></li>
                                <li class="sidebar-item"><a href="error-500.html" class="sidebar-link"><i
                                   class="mdi mdi-minus"></i><span class="hide-menu"> Error 500</span></a></li>
                                <li class="sidebar-item"><a href="error-503.html" class="sidebar-link"><i
                                   class="mdi mdi-minus"></i><span class="hide-menu"> Error 503</span></a></li>
                            </ul>
                        </li>

                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->

        <!-- ============================================================== -->
        <div class="page-wrapper">
            
            @yield('content')
            
            <footer class="footer text-center">
                Ideia Admin Dashboard Responsive Template <a href="https://themeforest.net/user/belostemas">Belostemas</a>
            </footer>
            
        </div>
    </div>
    
    <div class="chat-windows"></div>

    <script src="{{ asset('libs/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('libs/popper.js/dist/umd/popper.min.js') }}"></script>
    <script src="{{ asset('libs/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/app.min.js') }}"></script>
    <script src="{{ asset('js/app.init.dark.js') }}"></script>
    <script src="{{ asset('js/app-style-switcher.js') }}"></script>
    <script src="{{ asset('libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js') }}"></script>
    <script src="{{ asset('extra-libs/sparkline/sparkline.js') }}"></script>
    <script src="{{ asset('js/waves.js') }}"></script>
    <script src="{{ asset('js/sidebarmenu.js') }}"></script>
    <script src="{{ asset('js/custom.min.js') }}"></script>
    <script src="{{ asset('libs/chartist/dist/chartist.min.js') }}"></script>
    <script src="{{ asset('libs/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js') }}"></script>
    <script src="{{ asset('extra-libs/c3/d3.min.js') }}"></script>
    <script src="{{ asset('extra-libs/c3/c3.min.js') }}"></script>
    
    @yield('scripts')
</body>

</html>