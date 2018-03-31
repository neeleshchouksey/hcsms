<div class="menu_wrapper header-area hidden-menu-bar stick">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-2 col-xs-12 wow bounceInDown" data-wow-delay="0.6s">
                    <div class="header_logo">
                        <a href="{{url('/')}}" class="hidden-xs"><img src="{{asset('images/MC-logo-WH.png')}}" alt="logo" title="logo" class="img-responsive"></a>
                    </div>
                </div>
                <div class="col-lg-9 col-md-9 col-sm-10 col-xs-12">
                    <nav class="navbar hidden-xs">
                            <!-- Brand and toggle get grouped for better mobile display -->
                            <div class="navbar-header">
                                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                                    <span class="sr-only">Toggle navigation</span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                </button>
                            </div>

                            <!-- Collect the nav links, forms, and other content for toggling -->
                            <div class="collapse navbar-collapse respose_nav" id="bs-example-navbar-collapse-1">
                             <div class="et_navbar_search_wrapper hidden-xs">
                                    <div class="et_search_bar" id="search_button">
                                         <a href="#"><i class="fa fa-search" aria-hidden="true"></i></a>
                                    </div>
                                    <div id="search_open" class="et_search_box">
                                        <input type="text" placeholder="Search here">
                                        <button><i class="fa fa-search" aria-hidden="true"></i></button>
                                    </div>
                                </div>
                                <ul class="nav navbar-nav" id="nav_filter">
                                                                           
                        @auth
                        <li><div id="google_translate_element"></div></li>
                            <li><a href="{{ route('patient.index') }}">Patients</a></li>
                            <li><a href="{{ route('staff.index') }}">Staff</a></li>
                            <li><a href="{{ url('profile') }}">Profile</a></li>
                            <!--   <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a> -->

                                <!-- <ul class="dropdown-menu"> -->
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                <!-- </ul> -->
                            <!-- </li> -->
                        @else 
                        @auth('staff')
                            <li><a href="{{ route('profile.index') }}">Profile</a></li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                                    {{ Auth::guard('staff')->user()->title }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="{{ route('staffs.logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('staffs.logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @else
                                    <li><a href="{{url('/')}}">index</a></li>
                                    <li><a href="{{url('/about-us')}}">about us</a></li>
                                   <li class="dropdown">
                                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">services</a>
                                      <ul class="dropdown-menu hovr_nav_tab">
                                        <li><a href="{{url('/service')}}">services</a></li>
                                        <li><a href="{{url('/event')}}">events</a></li>
                                        <li><a href="{{url('/pricing')}}">pricing</a></li>
                                      </ul>
                                    </li>
                                   <li class="dropdown">
                                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">doctors</a>
                                      <ul class="dropdown-menu hovr_nav_tab">
                                        <li><a href="{{url('/doctor')}}">doctor single</a></li>
                                        <li><a href="{{url('/our-doctor')}}">our doctors</a></li>
                                      </ul>
                                    </li>
                                    <li class="dropdown">
                                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">gallery</a>
                                      <ul class="dropdown-menu hovr_nav_tab">
                                        <li><a href="{{url('/gallery')}}">gallery 2</a></li>
                                        <li><a href="{{url('/gallery-2')}}">gallery 3</a></li>
                                        <li><a href="{{url('/gallery-3')}}">gallery 4</a></li>
                                      </ul>
                                    </li>
                                    <li class="dropdown">
                                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">blog</a>
                                      <ul class="dropdown-menu hovr_nav_tab">
                                        <li><a href="{{url('/blog')}}">blog category</a></li>
                                        <li><a href="{{url('/blog-single')}}">blog single</a></li>
                                      </ul>
                                    </li>
                                    <li class="dropdown">
                                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">contact</a>
                                      <ul class="dropdown-menu hovr_nav_tab">
                                        <li><a href="{{url('/contact-us')}}">contact us</a></li>
                                        <li><a href="{{url('/appointment')}}">appointment </a></li>
                                      </ul>
                                    </li>
                                   
                                    @endauth
                        @endauth
                        
                                </ul>
                            </div>
                            <!-- /.navbar-collapse -->
                    </nav>
                    <div class="rp_mobail_menu_main_wrapper visible-xs">
                        <div class="row">
                            <div class="col-xs-6">
                                <div class="gc_logo logo_hidn">
                                    <h1><a href="#">LIFE<span>LINE</span></a></h1>
                                </div>
                            </div>
                            <div class="col-xs-6">
                                <div id="toggle">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 31.177 31.177" style="enable-background:new 0 0 31.177 31.177;" xml:space="preserve" width="25px" height="25px">
                                        <g>
                                            <g>
                                                <path class="menubar" d="M30.23,1.775H0.946c-0.489,0-0.887-0.398-0.887-0.888S0.457,0,0.946,0H30.23    c0.49,0,0.888,0.398,0.888,0.888S30.72,1.775,30.23,1.775z" fill="#2ec8a6" />
                                            </g>
                                            <g>
                                                <path class="menubar" d="M30.23,9.126H12.069c-0.49,0-0.888-0.398-0.888-0.888c0-0.49,0.398-0.888,0.888-0.888H30.23    c0.49,0,0.888,0.397,0.888,0.888C31.118,8.729,30.72,9.126,30.23,9.126z" fill="#2ec8a6" />
                                            </g>
                                            <g>
                                                <path class="menubar" d="M30.23,16.477H0.946c-0.489,0-0.887-0.398-0.887-0.888c0-0.49,0.398-0.888,0.887-0.888H30.23    c0.49,0,0.888,0.397,0.888,0.888C31.118,16.079,30.72,16.477,30.23,16.477z" fill="#2ec8a6" />
                                            </g>
                                            <g>
                                                <path class="menubar" d="M30.23,23.826H12.069c-0.49,0-0.888-0.396-0.888-0.887c0-0.49,0.398-0.888,0.888-0.888H30.23    c0.49,0,0.888,0.397,0.888,0.888C31.118,23.43,30.72,23.826,30.23,23.826z" fill="#2ec8a6" />
                                            </g>
                                            <g>
                                                <path class="menubar" d="M30.23,31.177H0.946c-0.489,0-0.887-0.396-0.887-0.887c0-0.49,0.398-0.888,0.887-0.888H30.23    c0.49,0,0.888,0.398,0.888,0.888C31.118,30.78,30.72,31.177,30.23,31.177z" fill="#2ec8a6" />
                                            </g>
                                        </g>
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <div id="sidebar">
                            <h1>LIFE<span>LINE</span></h1>
                            <div id="toggle_close">&times;</div>
                            <div id='cssmenu' class="wd_single_index_menu">
                                <ul>
                                    
                                                                              <li><div id="google_translate_element"></div></li>
                        @auth
                            <li><a href="{{ route('patient.index') }}">Patients</a></li>
                            <li><a href="{{ route('staff.index') }}">Staff</a></li>
                            <li><a href="{{ url('profile') }}">Profile</a></li>
                          <!--   <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a> -->

                                <!-- <ul class="dropdown-menu"> -->
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                <!-- </ul> -->
                            <!-- </li> -->
                        @else @auth('staff')
                            <li><a href="{{ route('profile.index') }}">Profile</a></li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                                    {{ Auth::guard('staff')->user()->title }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="{{ route('staffs.logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('staffs.logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @else
                        <li class='has-sub'><a href='#'>index</a>
                                       <ul>
                                           <li><a href="{{url('/')}}">index 1</a></li>
                                           <li><a href="{{url('/')}}">index 2</a></li>
                                        </ul>
                                     </li>
                                     <li><a href="{{url('/about')}}">about us</a></li>
                                     <li class='has-sub'><a href='#'>services</a>
                                       <ul>
                                           <li><a href="{{url('/service')}}">services</a></li>
                                           <li><a href="{{url('/event')}}">events</a></li>
                                           <li><a href="{{url('/pricing')}}">pricing</a></li>
                                        </ul>
                                     </li>
                                      <li class='has-sub'><a href='#'>doctors</a>
                                       <ul>
                                           <li><a href="{{url('/doctor')}}">doctor single</a></li>
                                           <li><a href="{{url('/our-doctor')}}">our doctors</a></li>
                                        </ul>
                                     </li>
                                     <li class='has-sub'><a href='#'>gallery</a>
                                       <ul>
                                           <li><a href="{{url('/gallery')}}">gallery 2</a></li>
                                           <li><a href="{{url('/gallery-2')}}">gallery 3</a></li>
                                           <li><a href="{{url('/gallery-3')}}">gallery 4</a></li>
                                        </ul>
                                     </li>
                                    <li class='has-sub'><a href='#'>blog</a>
                                       <ul>
                                           <li><a href="{{url('/blog')}}">blog category</a></li>
                                           <li><a href="{{url('/blog-single')}}">blog single</a></li>
                                        </ul>
                                     </li>
                                    <li class='has-sub'><a href='#'>contact</a>
                                       <ul>
                                           <li><a href="{{url('/contact-us')}}">contact us</a></li>
                                           <li><a href="{{url('/appointment')}}">appointment </a></li>
                                        </ul>
                                     </li>
                                    
                        @endauth
                        @endauth
                                       
                                    <!-- <li><a href="#">Log In / Sign Up</a></li> -->
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>