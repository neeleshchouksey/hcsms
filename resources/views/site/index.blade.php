 @extends('layouts.app')

@section('content')

   <!--slider wrapper start-->
    <div class="slider_main_wrapper">
        <div class="cc_slider_img_section">
            <div class="owl-carousel owl-theme">
                <div class="item cc_main_slide1">
                    <div class="container">
                        <div class="row">
                            <div class="col-xl-7 col-lg-7 col-md-12 col-sm-12 col-12">
                                <div class="cc_slider_cont1_wrapper">
                                    <div class="cc_slider_cont1">
                                        <div class="medi">
                                            <h1 data-animation-in="fadeInDown" data-animation-out="animate-out fadeOutDown">medical<span>services</span></h1></div>
                                        <h2 data-animation-in="fadeInDown" data-animation-out="animate-out fadeOutDown">total health care solution</h2>
                                        <p data-animation-in="zoomIn" data-animation-out="animate-out zoomIn">Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis bibdum auctor, nisi elit consequat ipsum, nec sagittis sem.</p>
                                        <ul>
                                            <li data-animation-in="bounceInLeft" data-animation-out="animate-out bounceOutLeft"><a href="#">READ MORE</a></li>
                                            <li data-animation-in="bounceInLeft" data-animation-out="animate-out bounceOutLeft"><a href="#">PURCHASE</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="item cc_main_slide2">
                    <div class="container">
                        <div class="row">
                            <div class="col-xl-7 col-lg-7 col-md-12 col-sm-12 col-12">
                                <div class="cc_slider_cont1_wrapper">
                                    <div class="cc_slider_cont1">
                                        <div class="medi">
                                            <h1 data-animation-in="fadeInDown" data-animation-out="animate-out fadeOutDown">medical<span>services</span></h1></div>
                                        <h2 data-animation-in="fadeInDown" data-animation-out="animate-out fadeOutDown">total health care solution</h2>
                                        <p data-animation-in="zoomIn" data-animation-out="animate-out zoomIn">Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis bibdum auctor, nisi elit consequat ipsum, nec sagittis sem.</p>
                                        <ul>
                                            <li data-animation-in="bounceInLeft" data-animation-out="animate-out bounceOutLeft"><a href="#">READ MORE</a></li>
                                            <li data-animation-in="bounceInLeft" data-animation-out="animate-out bounceOutLeft"><a href="#">PURCHASE</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="item cc_main_slide3">
                    <div class="container">
                        <div class="row">
                            <div class="col-xl-7 col-lg-7 col-md-12 col-sm-12 col-12">
                                <div class="cc_slider_cont1_wrapper">
                                    <div class="cc_slider_cont1">
                                        <div class="medi">
                                            <h1 data-animation-in="fadeInDown" data-animation-out="animate-out fadeOutDown">medical<span>services</span></h1></div>
                                        <h2 data-animation-in="fadeInDown" data-animation-out="animate-out fadeOutDown">total health care solution</h2>
                                        <p data-animation-in="zoomIn" data-animation-out="animate-out zoomIn">Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis bibdum auctor, nisi elit consequat ipsum, nec sagittis sem.</p>
                                        <ul>
                                            <li data-animation-in="bounceInLeft" data-animation-out="animate-out bounceOutLeft"><a href="#">READ MORE</a></li>
                                            <li data-animation-in="bounceInLeft" data-animation-out="animate-out bounceOutLeft"><a href="#">PURCHASE</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--slider wrapper end-->
    <!--category wrapper start-->
        @include('partials.categoryWrap')
    <!--category wrapper end-->
    <!--about us wrapper start-->
        @include('partials.aboutWrap')
    <!--about us wrapper end-->
    <!--appoint wrapper start-->
        @include('partials.contactSupportWrap')
    <!--appoint wrapper end-->
    <!--choose wrapper start-->
        @include('partials.whyWeChooseWrap')
    <!--choose wrapper end-->
    <!--team wrapper start-->
        @include('partials.teamWrap')
    <!--team wrapper end-->
    <!--vedio wrapper start-->
    <div class="vedio_wrapper">
        <div class="vedio_overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="vedio_heading_wrapper wow fadeInDown" data-wow-delay="0.5s">
                        <h1 class="med_bottompadder20">Welcome to Hospital</h1>
                        <img src="images/Icon_team.png" alt="line" class="med_bottompadder20">
                        <p>We Care about everything what you want</p>
                        <h4><a class="popup-youtube" href="https://www.youtube.com/embed/xImpyYRVGOc"><img src="images/Play-Icon.png" alt="Play"> play video</a></h4>
                        <div class="video_btn_wrapper right">
                            <ul>
                                <li><a class="btn" href="#">About Us</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--vedio wrapper end-->
    <!--event wrapper start-->
    <div class="event_wrapper med_toppadder100 med_bottompadder70">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="choose_heading_wrapper">
                        <h1 class="med_bottompadder20">Upcoming Events</h1>
                        <img src="images/line.png" alt="title" class="med_bottompadder60">
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="event_slider_wrapper event_response_wrapper">
                        <div class="owl-carousel owl-theme">
                            <div class="item">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <div class="img_section hidden-xs hidden-sm">
                                            <div class="icon_wrapper_event">
                                                <i class="fa fa-star-o" aria-hidden="true"></i>
                                            </div>
                                            <div class="img_wrapper1">

                                                <img src="images/event_1.jpg" alt="img" class="img-responsive">
                                            </div>
                                            <div class="event_icon1">
                                                <h2><a href="#">Together we can do so much</a></h2>
                                                <ul>
                                                    <li><a href=""><i class="fa fa-map-marker" aria-hidden="true"></i>
                                                    ,UK</a></li>
                                                    <li><i class="fa fa-calendar-o" aria-hidden="true"></i>24 Nov, 2017</li>
                                                </ul>
                                                <p>Proin gravida nibh vel velit auctor aliuet. Aenean sollicitudin, aks lorem quis aks bibendum auctor.</p>
                                            </div>
                                        </div>
                                        <div class="img_section hidden-xs hidden-sm">
                                            <div class="icon_wrapper_event">
                                                <i class="fa fa-star-o" aria-hidden="true"></i>
                                            </div>
                                            <div class="img_wrapper1">
                                                <img src="images/event_2.jpg" alt="img" class="img-responsive">
                                            </div>
                                            <div class="event_icon1">
                                                <h2><a href="#">Together we can do so much</a></h2>
                                                <ul>
                                                    <li><a href=""><i class="fa fa-map-marker" aria-hidden="true"></i>California,UK</a></li>
                                                    <li><i class="fa fa-calendar-o" aria-hidden="true"></i>24 Nov, 2017</li>
                                                   
                                                </ul>
                                                <p>Proin gravida nibh vel velit auctor aliuet. Aenean sollicitudin, aks lorem quis aks bibendum auctor.</p>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <div class="img_section">
                                            <div class="icon_wrapper_event">
                                                <i class="fa fa-star-o" aria-hidden="true"></i>
                                            </div>
                                            <div class="img_wrapper1">
                                                <img src="images/event_3.jpg" alt="img" class="img-responsive">
                                            </div>
                                            <div class="event_icon1">
                                                <h2><a href="#">Together we can do so much</a></h2>
                                                <ul>
                                                    <li><a href=""><i class="fa fa-map-marker" aria-hidden="true"></i>California,UK</a></li>
                                                    <li><i class="fa fa-calendar-o" aria-hidden="true"></i>24 Nov, 2017</li>
                                                </ul>
                                                <p>Proin gravida nibh vel velit auctor aliuet. Aenean sollicitudin, aks lorem quis aks bibendum auctor.</p>
                                            </div>
                                        </div>
                                        <div class="img_section hidden-xs hidden-sm">
                                            <div class="icon_wrapper_event">
                                                <i class="fa fa-star-o" aria-hidden="true"></i>
                                            </div>
                                            <div class="img_wrapper1">
                                                <img src="images/event_4.jpg" alt="img" class="img-responsive">
                                            </div>
                                            <div class="event_icon1">
                                                <h2><a href="#">Together we can do so much</a></h2>
                                                <ul>
                                                    <li><a href=""><i class="fa fa-map-marker" aria-hidden="true"></i>California,UK</a></li>
                                                    <li><i class="fa fa-calendar-o" aria-hidden="true"></i>24 Nov, 2017</li>
                                                </ul>
                                                <p>Proin gravida nibh vel velit auctor aliuet. Aenean sollicitudin, aks lorem quis aks bibendum auctor.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <div class="img_section">
                                            <div class="icon_wrapper_event">
                                                <i class="fa fa-star-o" aria-hidden="true"></i>
                                            </div>
                                            <div class="img_wrapper1">
                                                <img src="images/event_1.jpg" alt="img" class="img-responsive">
                                            </div>
                                            <div class="event_icon1">
                                                <h2><a href="#">Together we can do so much</a></h2>
                                                <ul>
                                                    <li><a href=""><i class="fa fa-map-marker" aria-hidden="true"></i>California,UK</a></li>
                                                    <li><i class="fa fa-calendar-o" aria-hidden="true"></i>24 Nov, 2017</li>
                                                </ul>
                                                <p>Proin gravida nibh vel velit auctor aliuet. Aenean sollicitudin, aks lorem quis aks bibendum auctor.</p>
                                            </div>
                                        </div>
                                        <div class="img_section hidden-xs hidden-sm">
                                            <div class="icon_wrapper_event">
                                                <i class="fa fa-star-o" aria-hidden="true"></i>
                                            </div>
                                            <div class="img_wrapper1">
                                                <img src="images/event_2.jpg" alt="img" class="img-responsive">
                                            </div>
                                            <div class="event_icon1">
                                                <h2><a href="#">Together we can do so much</a></h2>
                                                <ul>
                                                    <li><a href=""><i class="fa fa-map-marker" aria-hidden="true"></i>California,UK</a></li>
                                                    <li><i class="fa fa-calendar-o" aria-hidden="true"></i>24 Nov, 2017</li>
                                                </ul>
                                                <p>Proin gravida nibh vel velit auctor aliuet. Aenean sollicitudin, aks lorem quis aks bibendum auctor.</p>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <div class="img_section hidden-xs hidden-sm">
                                            <div class="icon_wrapper_event">
                                                <i class="fa fa-star-o" aria-hidden="true"></i>
                                            </div>
                                            <div class="img_wrapper1">
                                                <img src="images/event_3.jpg" alt="img" class="img-responsive">
                                            </div>
                                            <div class="event_icon1">
                                                <h2><a href="#">Together we can do so much</a></h2>
                                                <ul>
                                                    <li><a href=""><i class="fa fa-map-marker" aria-hidden="true"></i>California,UK</a></li>
                                                    <li><i class="fa fa-calendar-o" aria-hidden="true"></i>24 Nov, 2017</li>
                                                </ul>
                                                <p>Proin gravida nibh vel velit auctor aliuet. Aenean sollicitudin, aks lorem quis aks bibendum auctor.</p>
                                            </div>
                                        </div>
                                        <div class="img_section hidden-xs hidden-sm">
                                            <div class="icon_wrapper_event">
                                                <i class="fa fa-star-o" aria-hidden="true"></i>
                                            </div>
                                            <div class="img_wrapper1">
                                                <img src="images/event_4.jpg" alt="img" class="img-responsive">
                                            </div>
                                            <div class="event_icon1">
                                                <h2><a href="#">Together we can do so much</a></h2>
                                                <ul>
                                                    <li><a href=""><i class="fa fa-map-marker" aria-hidden="true"></i>California,UK</a></li>
                                                    <li><i class="fa fa-calendar-o" aria-hidden="true"></i>24 Nov, 2017</li>
                                                </ul>
                                                <p>Proin gravida nibh vel velit auctor aliuet. Aenean sollicitudin, aks lorem quis aks bibendum auctor.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- event wrapper end-->
    <!-- counter wrapper start-->
        @include('partials.counterWrap')
    <!-- counter wrapper end-->
    <!-- blog wrapper start-->
    <div class="blog_wrapper med_toppadder100 med_bottompadder90">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12 col-lg-offset-2">
                    <div class="team_heading_wrapper med_bottompadder50 wow fadeInDown" data-wow-delay="0.3s">
                        <h1 class="med_bottompadder20">our News & blog</h1>
                        <img src="images/Icon_team.png" alt="line" class="med_bottompadder20">
                        <p>Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis bibendum auctor, nisi elit consequat ipsum, nec sagittis sem nibh id elit. Duis sed odio sit amet nibh vulputate.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <div class="blog_about">
                        <div class="blog_img">
                            <figure>
                                <img src="images/blog_img_1.jpg" alt="img" class="img-responsive">
                            </figure>
                        </div>
                        <div class="blog_comment">
                            <ul>
                                <li><a href=""><i class="fa fa-comment" aria-hidden="true"></i>50</a></li>
                                <li><a href=""><i class="fa fa-thumbs-up" aria-hidden="true"></i>98</a></li>
                            </ul>
                        </div>
                        <div class="blog_txt">
                            <h1><a href="#">Blog Image Post</a></h1>
                            <div class="blog_txt_info">
                                <ul>
                                    <li>BY ADMIN</li>
                                    <li>SEPT.29,2016</li>
                                </ul>
                            </div>
                            <p>Sollicitudin, lorem quis bibe u auctor, nisi elit conat ipsu, nec sagittis sem ni id elit. Duis sed odio sit amet nibh vulpute cursus.</p>
                            <a href="#">Read More <i class="fa fa-long-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <div class="blog_about">
                        <div class="blog_img">
                            <figure>
                                <img src="images/blog_img_2.jpg" alt="img" class="img-responsive">
                            </figure>
                        </div>
                        <div class="blog_comment">
                            <ul>
                                <li><a href=""><i class="fa fa-comment" aria-hidden="true"></i>50</a></li>
                                <li><a href=""><i class="fa fa-thumbs-up" aria-hidden="true"></i>98</a></li>
                            </ul>
                        </div>
                        <div class="blog_txt">
                            <h1><a href="#">Blog Image Post</a></h1>
                            <div class="blog_txt_info">
                                <ul>
                                    <li>BY ADMIN</li>
                                    <li>SEPT.29,2016</li>
                                </ul>
                            </div>
                            <p>Sollicitudin, lorem quis bibe u auctor, nisi elit conat ipsu, nec sagittis sem ni id elit. Duis sed odio sit amet nibh vulpute cursus.</p>
                            <a href="#">Read More <i class="fa fa-long-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <div class="blog_about">
                        <div class="blog_img">
                            <figure>
                                <img src="images/blog_img_3.jpg" alt="img" class="img-responsive">
                            </figure>
                        </div>
                        <div class="blog_comment">
                            <ul>
                                <li><a href=""><i class="fa fa-comment" aria-hidden="true"></i>50</a></li>
                                <li><a href=""><i class="fa fa-thumbs-up" aria-hidden="true"></i>98</a></li>
                            </ul>
                        </div>
                        <div class="blog_txt">
                            <h1><a href="#">Blog Image Post</a></h1>
                            <div class="blog_txt_info">
                                <ul>
                                    <li>BY ADMIN</li>
                                    <li>SEPT.29,2016</li>
                                </ul>
                            </div>
                            <p>Sollicitudin, lorem quis bibe u auctor, nisi elit conat ipsu, nec sagittis sem ni id elit. Duis sed odio sit amet nibh vulpute cursus.</p>
                            <a href="#">Read More <i class="fa fa-long-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- blog wrapper end-->
    <!--testimonial wrapper start-->
        @include('partials.testimonialWrap')
    <!-- testimonial wrapper end-->
    <!-- booking wrapper start -->
    <div class="booking_wrapper med_toppadder100 med_bottompadder90">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12 col-lg-offset-2">
                    <div class="team_heading_wrapper med_bottompadder50">
                        <h1 class="med_bottompadder20">Book appointment</h1>
                        <img src="images/Icon_team.png" alt="line" class="med_bottompadder20">
                        <p>
                            Are you interested in improving your communications and reducing costs?
                            We would love to help.
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="booking_box">
                <div class="row">
                    <div class="box_side_icon">
                        <img src="images/Icon_bk.png" alt="img">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <div class="contect_form1">
                                <input type="text" placeholder="Full Name">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <div class="contect_form1">
                                <input type="email" placeholder="Email Address">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <div class="contect_form1">
                                <input type="text" placeholder="Phone No.">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <div class="contect_form1">
                                <input type="text" placeholder="Subject">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <div class="contect_form3">
                                <input type="text" placeholder="Date"><i class="fa fa-calendar-o" aria-hidden="true"></i>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <div class="contect_form3">
                                <input type="text" placeholder="Time"><i class="fa fa-clock-o" aria-hidden="true"></i>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="contect_form4">
                                <textarea rows="4" placeholder="Message"></textarea>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="contect_btn">
                                <ul>
                                    <li><a href="#">SEND</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="chat_box">
                <div class="row">
                    <div class="booking_box_2">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="booking_box_img">
                                <img src="images/booking_call.png" alt="img" class="img-circle">
                            </div>
                            <div class="booking_chat">
                                <h1>+44 7929 000 321</h1>
                                <p> Effective communication will save you time and money.</p>
                            </div>
                            <div class="booking_btn">
                                <ul>
                                    <li><a href="#">LIVE CHAT</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="map_main_wrapper">
            <div id="map" style="width:100%; float:left; height:600px;"></div>
        </div>
    </div>
    <!--booking wrapper end-->
    @include('layouts.parts.partner')
@endsection