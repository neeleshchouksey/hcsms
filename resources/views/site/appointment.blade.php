@extends('layouts.app')

@section('content')
<!-- med_tittle_section -->
    <div class="med_tittle_section">
        <div class="med_img_overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="med_tittle_cont_wrapper">
                        <div class="med_tittle_cont">
                            <h1>book appointment</h1>
                            <ol class="breadcrumb">
                                <li><a href="index.html">Home</a>
                                </li>
                                <li>Book Appointment</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- med_tittle_section End -->
    <!-- appoint_section start -->
    <div class="booking_wrapper book_section med_toppadder100">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12 col-lg-offset-2">
                    <div class="team_heading_wrapper med_bottompadder50">
                        <h1 class="med_bottompadder20">Book appointment</h1>
                        <img src="images/Icon_team.png" alt="line" class="med_bottompadder20">
                        <p>Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis bibendum auctor, nisi elit consequat ipsum, nec sagittis sem nibh id elit. Duis sed odio sit amet nibh vulputate.</p>
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
                                    <li><a href="#">SEND</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="chat_box chat_box_clr">
                <div class="row">
                    <div class="booking_box_2">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="booking_box_img">
                                <img src="images/booking_call.png" alt="img" class="img-circle">
                            </div>
                            <div class="booking_chat">
                                <h1>+1 800 383 88 90</h1>
                                <p>if urgent. Your personal case manager will ensure that you receive the best possible care.</p>
                            </div>
                            <div class="booking_btn book_btn_resp_1">
                                <ul>
                                    <li><a href="#">LIVE CHAT</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--appoint_section end-->
    <!--available_section start-->
    <div class="booking_wrapper avail_section med_bottompadder90">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12 col-lg-offset-2">
                    <div class="team_heading_wrapper med_bottompadder50 wow fadeInDown" data-wow-delay="0.4s">
                        <h1 class="med_bottompadder20">Available Appointments</h1>
                        <img src="images/Icon_team.png" alt="line" class="med_bottompadder20">
                        <p>Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis bibendum auctor, nisi elit consequat ipsum, nec sagittis sem nibh id elit. Duis sed odio sit amet nibh vulputate.</p>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="app">
                        <div class="app__main">
                            <div class="calendar">
                                <div id="calendar"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--available_section end-->
@endsection