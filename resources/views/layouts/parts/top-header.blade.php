<!--top header start-->
    <div class="top_header_wrapper">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="top_header_add">
                        <ul>
                            <li><i class="fa fa-map-marker" aria-hidden="true"></i><span>Address :</span> -512/fonia,canada</li>
                            <li><i class="fa fa-phone" aria-hidden="true"></i><span>Call us :</span> +61 5001444-122</li>
                            <li><i class="fa fa-envelope" aria-hidden="true"></i><a href="#"><span>Email :</span> dummy@example.com</a></li>
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