@extends('layouts.app')

@section('content')
  <!--med_tittle_section-->
    <div class="med_tittle_section">
        <div class="med_img_overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="med_tittle_cont_wrapper">
                        <div class="med_tittle_cont">
                            <h1>our event </h1>
                            <ol class="breadcrumb">
                                <li><a href="index.html">Home</a>
                                </li>
                                <li>event</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- med_tittle_section End -->
    <!--upcoming event section start -->
    <div class="booking_wrapper event_section med_toppadder100 med_bottompadder100">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12 col-lg-offset-2">
                    <div class="team_heading_wrapper med_bottompadder50">
                        <h1 class="med_bottompadder20">Upcoming Events</h1>
                        <img src="images/Icon_team.png" alt="line" class="med_bottompadder20">
                        <p>Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis bibendum auctor, nisi elit consequat ipsum, nec sagittis sem nibh id elit. Duis sed odio sit amet nibh vulputate.</p>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 event_txt">
                        <div class="event_txt_anch">
                            <h2>Gravida nibh vel velit auctor aliquet.<br>Aenean sollicitudin,</h2>
                            <ul>
                                <li><a href=""><i class="fa fa-map-marker" aria-hidden="true"></i>California,UK</a>
                                </li>
                                <li><i class="fa fa-calendar-o" aria-hidden="true"></i>24 Nov, 2017</li>
                            </ul>
                            <p>Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis bibendum auctor, nisi elit consequat ipsum, nec sagittis sem nibh id elit. Duis sed odio sit amet nibh vulputate cursus a sit amet mauris. Morbi ac- cumsan ipsum velit. Nam lus a odio.
                            </p>
                            <div class="event_btn_section">
                                <ul>
                                    <li><a class="btn" href="#">Read more</a>
                                    </li>
                                </ul>
                            </div>

                            <div id="countdown"></div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 event_img">
                        <div class="event_img_count">
                            <figure>
                                <img class="img-responsive" src="images/event_img_bg.jpg" alt="img">
                            </figure>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--upcoming event section end-->
    <!--event wrapper start-->
    <div class="event_wrapper med_toppadder100 med_bottompadder70">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="choose_heading_wrapper">
                        <h1 class="med_bottompadder20">more Upcoming Events</h1>
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
                                                    <li><a href=""><i class="fa fa-map-marker" aria-hidden="true"></i>California,UK</a>
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
                                                    <li><a href=""><i class="fa fa-map-marker" aria-hidden="true"></i>California,UK</a>
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
    <script>
			var target_date = new Date('march, 25, 2018').getTime();
			 
			// variables for time units
			var days, hours, minutes, seconds;
			 
			// get tag element
			var countdown = document.getElementById('countdown');
			 
			// update the tag with id "countdown" every 1 second
			setInterval(function () {
			 
				// find the amount of "seconds" between now and target
				var current_date = new Date().getTime();
				var seconds_left = (target_date - current_date) / 1000;
			 
				// do some time calculations
				days = parseInt(seconds_left / 86400);
				seconds_left = seconds_left % 86400;
				 
				hours = parseInt(seconds_left / 3600);
				seconds_left = seconds_left % 3600;
				 
				minutes = parseInt(seconds_left / 60);
				seconds = parseInt(seconds_left % 60);
				 
				// format countdown string + set tag value
				countdown.innerHTML = '<span class="days">' + days +  ' <label>Days</label></span> <span class="hours">' + hours + ' <label>Hours</label></span> <span class="minutes">'
				+ minutes + ' <label>Mins</label></span> <span class="seconds">' + seconds + ' <label>Secs</label></span>';  
			 
			}, 1000);
	</script>		
    @endpush

@endsection