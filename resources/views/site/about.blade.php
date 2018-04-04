@extends('layouts.app')

@section('content')
     <!--med_tittle_section-->
    <div class="med_tittle_section patient_home_title" >
        <div class="med_img_overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="med_tittle_cont_wrapper">
                        <div class="med_tittle_cont">
                            <h1>about us </h1>
                            <ol class="breadcrumb">
                                <li><a href="{{url('/')}}">Home</a>
                                </li>
                                <li>about us</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--about us section start-->
    <div class="about_us_wrapper">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="about_img">
                        <img src="images/about_us_bg.jpg" alt="img" class="img-responsive">
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 med_toppadder70">
                    <div class="abt_heading_wrapper abt_2_heading">
                        <h1 class="med_bottompadder20">ABOUT MEDIC COMMS</h1>
                        <img src="images/line.png" alt="title" class="med_bottompadder20">
                    </div>
                    <div class="abt_txt">
                        <h3>We help healthcare companies to improve patient communication.</h3>
                        <p class="med_toppadder20">We save you time and money by introducing automated messaging and using modern technology effectively.  We work with hospitals, medical centres, private doctors, dentists, opticians, therapists and many other healthcare professionals.</p>
                    </div>
                    <div class="abt_chk med_toppadder30">
                        <div class="content">
                            <ul>
                                <li><i class="fa fa-check-square-o" aria-hidden="true"></i><span>Reduce Communication Costs</span>
                                </li>
                                <li><i class="fa fa-check-square-o" aria-hidden="true"></i><span>Improve Effectiveness</span>
                                </li>
                                <li><i class="fa fa-check-square-o" aria-hidden="true"></i><span>Save Time</span>
                                </li>
                                <li><i class="fa fa-check-square-o" aria-hidden="true"></i><span>Track Messages</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="abt_heading_wrapper abt_2_heading_mn">
                        <h1 class="med_bottompadder20">our mission </h1>
                        <img src="images/line.png" alt="title" class="med_bottompadder20">
                    </div>
                    <div class="abt_txt">
                        <p class="med_toppadder20">We are committed to helping our clients to be more effective and to reduce their communication costs.  </p>
                        <p class="med_toppadder10">Many healthcare companies still use post for most of their communications, this is expensive, slow, and ineffective.  We designed a better way, we use SMS, SMS Post and only send a letter if the patient does not have a mobile number or does not read the SMS Post. </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--about us section end-->
    <!-- counter wrapper start-->
        @include('partials.counterWrap')
    <!-- counter wrapper end-->
    <!-- abt service wrapper start-->
    <div class="abt_service_section med_toppadder100">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12 col-lg-offset-2">
                    <div class="team_heading_wrapper med_bottompadder50">
                        <h1 class="med_bottompadder20">How We Help You </h1>
                        <img src="images/Icon_team.png" alt="line" class="med_bottompadder20">
                        <p>So, you want to reduce costs and improve effectiveness of your communications.  With our automation and smart SMS systems we can help you do both! .</p>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="abt_left_section med_bottompadder20">
                        <img src="{{asset('images/IMG_01042018_134314_0.png')}}" alt="img" class="img-responsive">
                    </div>
                    <div class="abt_txt">
                        <p>Great communications with patients is our number one goal.  Sending engaging messages improves patient response and appointment attendance.</p>
                        <p class="med_toppadder10">Saving you money comes next.  We do this by reducing the cost of sending messages, reducing missed appointments and saving you time.</p>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="sidebar_wrapper sidebar_right_abt">
                        <div class="accordionFifteen">
                            <div class="panel-group" id="accordionFifteenLeft" role="tablist">
                                <div class="panel panel-default sidebar_pannel">
                                    <div class="panel-heading desktop">
                                        <h4 class="panel-title">
													<a data-toggle="collapse" data-parent="#accordionFifteenLeft" href="#collapseFifteenLeftone" aria-expanded="false">- Reduce Costs by upto 85%</a>
												</h4>
                                    </div>
                                    <div id="collapseFifteenLeftone" class="panel-collapse collapse in" aria-expanded="true" role="tabpanel">
                                        <div class="panel-body">
                                            <div class="panel_cont">
                                                <p>You could save 85% on your current patient communications costs and be more effective at the same time.  How much do you spend sending letters to patients each month?</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.panel-default -->
                                <div class="panel panel-default sidebar_pannel">
                                    <div class="panel-heading horn">
                                        <h4 class="panel-title">
													<a class="collapsed" data-toggle="collapse" data-parent="#accordionFifteenLeft" href="#collapseFifteenLeftTwo" aria-expanded="false">- Save Money by improving appointment attendance</a>
												</h4>
                                    </div>
                                    <div id="collapseFifteenLeftTwo" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;" role="tabpanel">
                                        <div class="panel-body">
                                            <div class="panel_cont">
                                                <p>Missed appointments are a huge drain on all resources..  The NHS estimates the cost of a missed appointment to be around £50 each.  The first cost is wasted time, the second cost is time and money booking a new appointment.   We can reduce this using our appointment reminder SMS service.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.panel-default -->
                                <div class="panel panel-default sidebar_pannel">
                                    <div class="panel-heading bell">
                                        <h4 class="panel-title">
													<a class="collapsed" data-toggle="collapse" data-parent="#accordionFifteenLeft" href="#collapseFifteenLeftThree" aria-expanded="false">-Health Monitoring</a>
												</h4>
                                    </div>
                                    <div id="collapseFifteenLeftThree" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;" role="tabpanel">
                                        <div class="panel-body">
                                            <div class="panel_cont">
                                                <p>We have a great monitoring service that reminds patients their health and update the system by replying to the SMS.  This is great for monitoring Blood Pressure, Blood Sugar, Weight and more.   With great data like this, patient reviews can be more effective and as a result will be needed less often.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.panel-default -->
                                <div class="panel panel-default sidebar_pannel">
                                    <div class="panel-heading bell">
                                        <h4 class="panel-title">
													<a class="collapsed" data-toggle="collapse" data-parent="#accordionFifteenLeft" href="#collapseFifteenLeftFour" aria-expanded="false">- Highly Effective Messaging</a>
												</h4>
                                    </div>
                                    <div id="collapseFifteenLeftFour" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;" role="tabpanel">
                                        <div class="panel-body">
                                            <div class="panel_cont">
                                                <p>Our SMS and letter services have been designed to help patients to understand and respond to messages.  We send messages in the preferred language of the patient. Sending an appointment reminder in English when a patient does not read English is frankly a waste of money and time.  </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.panel-default -->
                                <div class="panel panel-default sidebar_pannel">
                                    <div class="panel-heading bell">
                                        <h4 class="panel-title">
													<a class="collapsed" data-toggle="collapse" data-parent="#accordionFifteenLeft" href="#collapseFifteenLeftfive" aria-expanded="false">- Payment Collection Service </a>
												</h4>
                                    </div>
                                    <div id="collapseFifteenLeftfive" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;" role="tabpanel">
                                        <div class="panel-body">
                                            <div class="panel_cont">
                                                <p>We will soon help you collect payments due for missed appointments and medical fees.  If you are interested in this please let your account manager know or email collections@mediccomms.com</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.panel-default -->
                                <div class="panel panel-default sidebar_pannel">
                                    <div class="panel-heading bell">
                                        <h4 class="panel-title">
													<a class="collapsed" data-toggle="collapse" data-parent="#accordionFifteenLeft" href="#collapseFifteenLeftsix" aria-expanded="false">- Customisation Services</a>
												</h4>
                                    </div>
                                    <div id="collapseFifteenLeftsix" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;" role="tabpanel">
                                        <div class="panel-body">
                                            <div class="panel_cont">
                                                <p>If you would like us to develop a new service or customer an existing one for you, please let us know.  Our team are here to help you and will be happy to explore new ideas and solutions with you.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.panel-default -->
                            </div>
                            <!--end of /.panel-group-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- abt service wrapper end-->
    <!--top service wrapper start-->
    <!-- counter wrapper start-->
    <div class="top_service_wrapper">
        <div class="top_serv_overlay">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12 col-lg-offset-2">
                        <div class="team_heading_wrapper med_bottompadder50 wow fadeInDown" data-wow-delay="0.3s">
                            <h1 class="med_bottompadder20">We provide top services</h1>
                            <img src="images/Icon_team.png" alt="line" class="med_bottompadder20">
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                        <div class="cat_about top_serv_txt">
                            <div class="icon_wrapper">
                                <img src="images/icon1.png" alt="img" class="img-responsive">
                            </div>
                            <div class="cat_img">
                                <img src="images/icon_11.png" alt="img" class="img-responsive">
                            </div>
                            <div class="cat_txt">
                                <h1>HEALTH CHECK SMS</h1>
                                <p>We help you monitor your patients with our unique SMS service.</p>
                                <a href="#">Read More <i class="fa fa-long-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                        <div class="cat_about top_serv_txt">
                            <div class="icon_wrapper">
                                <img src="images/icon2.png" alt="img" class="img-responsive">
                            </div>
                            <div class="cat_img">
                                <img src="images/icon_2.png" alt="img" class="img-responsive">
                            </div>
                            <div class="cat_txt">
                                <h1>APPOINTMENT Sms</h1>
                                <p>Our SMS reminders will help to improve your appointment attendance levels.</p>
                                <a href="#">Read More <i class="fa fa-long-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                        <div class="cat_about top_serv_txt">
                            <div class="icon_wrapper">
                                <img src="images/icon3.png" alt="img" class="img-responsive">
                            </div>
                            <div class="cat_img cat_img_3">
                                <img src="images/icon_3.png" alt="img" class="img-responsive">
                            </div>
                            <div class="cat_txt">
                                <h1>DENTAL REMINDERS</h1>
                                <p>Remind patients to adjust braces by SMS automatically and get live feedback.</p>
                                <a href="#">Read More <i class="fa fa-long-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- top service wrapper end-->
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
                    <div class="event_slider_wrapper">
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
													California,UK</a>
                                                    </li>
                                                    <li><i class="fa fa-calendar-o" aria-hidden="true"></i>24 Nov, 2017</li>
                                                </ul>
                                                <p>Proin gravida nibh vel velit auctor aliuet. Aenean sollicitudin, aks lorem quis aks bibendum auctor.</p>
                                            </div>
                                        </div>
                                        <div class="img_section">
                                            <div class="icon_wrapper_event">
                                                <i class="fa fa-star-o" aria-hidden="true"></i>
                                            </div>
                                            <div class="img_wrapper1">
                                                <img src="images/event_2.jpg" alt="img" class="img-responsive">
                                            </div>
                                            <div class="event_icon1">
                                                <h2><a href="#">Together we can do so much</a></h2>
                                                <ul>
                                                    <li><a href=""><i class="fa fa-map-marker" aria-hidden="true"></i>California,UK</a>
                                                    </li>
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
                                                    <li><a href=""><i class="fa fa-map-marker" aria-hidden="true"></i>California,UK</a>
                                                    </li>
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
                                                    <li><a href=""><i class="fa fa-map-marker" aria-hidden="true"></i>California,UK</a>
                                                    </li>
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
                                                    <li><a href=""><i class="fa fa-map-marker" aria-hidden="true"></i>California,UK</a>
                                                    </li>
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
                                                    <li><a href=""><i class="fa fa-map-marker" aria-hidden="true"></i>California,UK</a>
                                                    </li>
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
                                                    <li><a href=""><i class="fa fa-map-marker" aria-hidden="true"></i>California,UK</a>
                                                    </li>
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
                                                    <li><a href=""><i class="fa fa-map-marker" aria-hidden="true"></i>California,UK</a>
                                                    </li>
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
    <!--testimonial wrapper start-->
        @include('partials.testimonialWrap')
    @include('layouts.parts.partner')
@endsection