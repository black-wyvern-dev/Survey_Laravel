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
    <link href="{{ asset('libs/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.css') }}" rel="stylesheet">
    <link href="{{ asset('libs/morris.js/morris.css') }}" rel="stylesheet">
    <link href="{{ asset('extra-libs/c3/c3.min.css') }}" rel="stylesheet">
    <link href="{{ asset('libs/toastr/build/toastr.min.css') }}" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <style>
        .image_filter {
            width: 160px;
            height: 60px;
            vertical-align: center !important;
            margin-left: 20%;
            box-sizing: border-box;
            padding: 10px;
        }      
    }
</style>
    @yield('styles')
</head>

<body>
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <div id="main-wrapper">
        <header class="topbar">
            <nav class="navbar top-navbar navbar-expand-md navbar-dark">
                <div class="navbar-header">
                    <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)">
                        <i class="ti-menu ti-close"></i>
                    </a>
                    <a class="navbar-brand" href="/user">
                        <b class="logo-icon">
							<img src="{{ asset('images/logo-icon.png') }}" alt="homepage" class="dark-logo" />
							<!-- <img src="{{ asset('images/logo-light-icon.png') }}" alt="homepage" class="light-logo" /> -->
						</b>
                        <!-- {{print_r($logo_url)}} -->
                        <span class="logo-text">
							<img src="{{ asset('images/logo-text.png') }}" alt="homepage" class="dark-logo" />
							<img src="{{ asset('storage/'.$logo_url)}}" class="light-logo image_filter" alt="homepage" />
						</span>
                    </a>
                    <a class="topbartoggler d-block d-md-none waves-effect waves-light" href="javascript:void(0)" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="ti-more"></i>
                    </a>
                </div>
                <div class="navbar-collapse collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav float-left mr-auto">
                        <li class="nav-item d-none d-md-block"><a class="nav-link sidebartoggler waves-effect waves-light" href="javascript:void(0)" data-sidebartype="mini-sidebar"><i class="mdi mdi-menu font-24"></i></a></li>
                        
                        <li class="nav-item search-box"> <a class="nav-link waves-effect waves-dark" href="javascript:void(0)"><i class="ti-search"></i></a>
                            <form class="app-search position-absolute">
                                <input type="text" class="form-control" placeholder="Search &amp; enter"> <a class="srh-btn"><i class="ti-close"></i></a>
                            </form>
                        </li>
                    </ul>
                    <ul class="navbar-nav float-right">
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
                            <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark pro-pic" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                
                                @if(Auth::user()->photo != '')
                                    <img src="{{ asset('storage/' . Auth::user()->photo) }}" alt="user" class="rounded-circle" width="31"> 
                                @else
                                    <img src="{{ asset('images/users/1.jpg') }}" alt="user" class="rounded-circle" width="31">
                                @endif
                            </a>
                            <div class="dropdown-menu dropdown-menu-right user-dd animated flipInY">
                                <span class="with-arrow"><span class="bg-primary"></span></span>
                                <div class="d-flex no-block align-items-center p-15 bg-primary text-white m-b-10">
                                    <div class="">
                                        @if(Auth::user()->photo != '')
                                            <img src="{{ asset('storage/' . Auth::user()->photo) }}" alt="user" class="rounded-circle" width="61"> 
                                        @else
                                            <img src="{{ asset('images/users/1.jpg') }}" alt="user" class="rounded-circle"> 
                                        @endif
                                    </div>
                                    <div class="m-l-10">
                                        <h4 class="m-b-0">{{ Auth::user()->firstName }} {{ Auth::user()->lastName }}</h4>
                                        <p class=" m-b-0">{{ Auth::user()->email }}</p>
                                    </div>
                                </div>
                                <a class="dropdown-item" href="{{ route('user.user.profile') }}"><i class="ti-user m-r-5 m-l-5"></i>
									My Profile
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i  class="fa fa-power-off m-r-5 m-l-5"></i> Logout</a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <aside class="left-sidebar">
            <div class="scroll-sidebar">
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark" href="{{ route('user.dashboard') }}" aria-expanded="false">
                                <i class=" mdi mdi-home-outline"></i>
                                <span class="hide-menu">Dashboard </span>
                            </a>
                        </li>
                        @if(Auth::user()->role == 2)
                        <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-emoticon-cool"></i><span
                              class="hide-menu">Users</span></a>
                            <ul aria-expanded="false" class="collapse first-level">
                                <li class="sidebar-item">
                                    <a href="{{ route('user.user.list') }}" class="sidebar-link">
                                        <i class="mdi mdi-minus"></i><span class="hide-menu"> All Users </span>
                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="{{ route('user.user.create') }}" class="sidebar-link">
                                        <i class="mdi mdi-minus"></i><span class="hide-menu"> Create New User</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="ti-control-shuffle"></i><span
                              class="hide-menu">Branchs</span></a>
                            <ul aria-expanded="false" class="collapse first-level">
                                <li class="sidebar-item">
                                    <a href="{{ route('user.branch.list') }}" class="sidebar-link">
                                        <i class="mdi mdi-minus"></i><span class="hide-menu"> All Branchs </span>
                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="{{ route('user.branch.create') }}" class="sidebar-link">
                                        <i class="mdi mdi-minus"></i><span class="hide-menu"> Create New Branch</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class=" fab fa-servicestack"></i><span
                              class="hide-menu">Survey</span></a>
                            <ul aria-expanded="false" class="collapse first-level">
                                <li class="sidebar-item">
                                    <a href="{{ route('user.survey.list') }}" class="sidebar-link">
                                        <i class="mdi mdi-minus"></i><span class="hide-menu"> All Surveys </span>
                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="{{ route('user.survey.create') }}" class="sidebar-link">
                                        <i class="mdi mdi-minus"></i><span class="hide-menu"> Create New Survey</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="far fa-frown"></i><span
                              class="hide-menu">Rating</span></a>
                            <ul aria-expanded="false" class="collapse first-level">
                                <li class="sidebar-item">
                                    <a href="{{ route('user.rating.list') }}" class="sidebar-link">
                                        <i class="mdi mdi-minus"></i><span class="hide-menu"> All Ratings </span>
                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="{{ route('user.rating.create') }}" class="sidebar-link">
                                        <i class="mdi mdi-minus"></i><span class="hide-menu"> Create New Rating</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark" href="{{ route('user.brand.index') }}" aria-expanded="false">
                                <i class="fas fa-file-image"></i>
                                <span class="hide-menu">Branding </span>
                            </a>
                        </li>
                        <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="fas fa-mobile-alt"></i><span
                              class="hide-menu">Device</span></a>
                            <ul aria-expanded="false" class="collapse first-level">
                                <li class="sidebar-item">
                                    <a href="{{ route('user.device.list') }}" class="sidebar-link">
                                        <i class="mdi mdi-minus"></i><span class="hide-menu"> All Devices </span>
                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="{{ route('user.device.create') }}" class="sidebar-link">
                                        <i class="mdi mdi-minus"></i><span class="hide-menu"> Create New Device</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-stackexchange"></i><span
                              class="hide-menu">Template</span></a>
                            <ul aria-expanded="false" class="collapse first-level">
                                <li class="sidebar-item">
                                    <a href="{{ route('user.template.list') }}" class="sidebar-link">
                                        <i class="mdi mdi-minus"></i><span class="hide-menu"> All Templates </span>
                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="{{ route('user.template.create') }}" class="sidebar-link">
                                        <i class="mdi mdi-minus"></i><span class="hide-menu"> Create New Template</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="fas fa-info-circle"></i><span
                              class="hide-menu">Company Information </span></a>
                            <ul aria-expanded="false" class="collapse first-level">
                                <li class="sidebar-item">
                                    <a href="{{ route('user.companyinfo.list') }}" class="sidebar-link">
                                        <i class="mdi mdi-minus"></i><span class="hide-menu"> Social Links </span>
                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="{{ route('user.companyinfo.logo') }}" class="sidebar-link">
                                        <i class="mdi mdi-minus"></i><span class="hide-menu">Company Logo</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        @endif
                    </ul>
                </nav>
            </div>
        </aside>
        <div class="page-wrapper">
            
            @yield('content')
            
            <footer class="footer text-center">
                Powered by <a href="#">Exins.com</a>
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
    <script src="{{ asset('libs/toastr/build/toastr.min.js') }}"></script>
    <script src="{{ asset('libs/morris.js/morris.min.js') }}"></script>
    <script>
        var base_url_s = "{{ url('/') }}";
    </script>
    <script src="{{ asset('js/pages/user/realtime.js') }}"></script>
    @yield('scripts')
</body>

</html>