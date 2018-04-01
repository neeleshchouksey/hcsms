<!--top header start-->
    <div class="top_header_wrapper">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="top_header_add">
                        <ul>
                            <li><i class="fa fa-map-marker" aria-hidden="true"></i><span></span>London UK</li>
                            <li><i class="fa fa-phone" aria-hidden="true"></i><span></span> +44 7929 000 321</li>
                            <li><i class="fa fa-envelope" aria-hidden="true"></i><a href="mailto:support@mediccomms.com"><span></span> support@mediccomms.com</a></li>
                        </ul>
                    </div>
                    <div class="top_login">
                        <ul>
                             @auth
                                <li>{{Auth::user()->name}}</li>
                             @else
                                <li><i class="fa fa-sign-in" aria-hidden="true"></i><a href="{{url('login')}}">Log In     </a></li>
                                <li><a href="{{url('register')}}">Signup </a></li>
                            @endauth
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>