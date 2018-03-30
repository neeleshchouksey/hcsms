@extends('layouts.app')

@section('content')
  <!-- med_tittle_section-->
    <div class="med_tittle_section">
        <div class="med_img_overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="med_tittle_cont_wrapper">
                        <div class="med_tittle_cont">
                            <h1>Our Doctors</h1>
                            <ol class="breadcrumb">
                                <li><a href="index.html">Home</a>
                                </li>
                                <li>Our Doctors</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- med_tittle_section End -->
    <!--doctor portfolio section start-->
    <div class="portfolio_section med_toppadder100 med_bottompadder70">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12 col-lg-offset-2">
                    <div class="team_heading_wrapper med_bottompadder40">
                        <h1 class="med_bottompadder20">MEET OUR SPECIALISTS</h1>
                        <img src="images/Icon_team.png" alt="line" class="med_bottompadder20">
                        <p>Aenean sollicitudin, lorem quis bibendum auctor, nisi elit consequat ipsum, nec sagittis sem nibh id elit. Duis sed odio sit sagittis sem nibh id elit.</p>
                    </div>
                </div>
            </div>
        </div>
        <section class="portfolio-area">
            <div class="container">
                <div class="portfolio-filter clearfix text-center med_bottompadder40">
                    <ul class="list-inline" id="filter">
                        <li><a class="active" data-group="all">All</a>
                        </li>
                        <li><a data-group="business">dental</a>
                        </li>
                        <li><a data-group="website"> brain</a>
                        </li>
                        <li class="hidden-sm hidden-xs"><a data-group="surgery"> physicit </a>
                        </li>
                        <li><a data-group="photoshop">eye</a>
                        </li>
                        <li><a data-group="business">heart</a>
                        </li>
                        <li class="hidden-sm hidden-xs"><a data-group="logo">cancer</a>
                        </li>
                        <li><a data-group="business">hair</a>
                        </li>
                    </ul>
                </div>
                <div class="row">
                    <div id="gridWrapper" class="clearfix">
                        <div class="col-xs-6 col-sm-6 col-md-3 col-lg-3 portfolio-wrapper III_column med_bottompadder30 resp_div_img" data-groups='["all", "website", "logo"]'>
                            <div class="team_about our_doc_main dc_porftfolio_img">
                                <div class="team_icon_wrapper">
                                    <img src="images/001-time.png" alt="img" class="img-responsive">
                                </div>
                                <div class="team_img special_team_img_mn">
                                    <img src="images/team_1.jpg" alt="img" class="img-responsive">
                                </div>
                                <div class="team_txt">
                                    <h1><a href="#">Dr. Johan Doe</a></h1>
                                    <p>(Hepatologist)</p>
                                </div>
                                <div class="team_icon_hover our_doc_icn_hovr">
                                    <ul>
                                        <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                                        </li>
                                        <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                                        </li>
                                        <li><a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a>
                                        </li>
                                        <li><a href="#"><i class="fa fa-youtube-play" aria-hidden="true"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                        </div>

                        <div class="col-xs-6 col-sm-6 col-md-3 col-lg-3  portfolio-wrapper III_column med_bottompadder30 resp_div_img" data-groups='["all", "business", "website", "photoshop"]'>
                            <div class="team_about our_doc_main dc_porftfolio_img">
                                <div class="team_icon_wrapper">
                                    <img src="images/001-time.png" alt="img" class="img-responsive">
                                </div>
                                <div class="team_img special_team_img_mn">
                                    <img src="images/team_2.jpg" alt="img" class="img-responsive">
                                </div>
                                <div class="team_txt">
                                    <h1><a href="#">Dr. Johan Doe</a></h1>
                                    <p>(Hepatologist)</p>
                                </div>
                                <div class="team_icon_hover our_doc_icn_hovr">
                                    <ul>
                                        <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                                        </li>
                                        <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                                        </li>
                                        <li><a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a>
                                        </li>
                                        <li><a href="#"><i class="fa fa-youtube-play" aria-hidden="true"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="col-xs-6 col-sm-6 col-md-3 col-lg-3 portfolio-wrapper III_column med_bottompadder30 resp_div_img" data-groups='["all", "business", "logo", "surgery"]'>
                            <div class="team_about our_doc_main dc_porftfolio_img">
                                <div class="team_icon_wrapper">
                                    <img src="images/001-time.png" alt="img" class="img-responsive">
                                </div>
                                <div class="team_img special_team_img_mn">
                                    <img src="images/team_3.jpg" alt="img" class="img-responsive">
                                </div>
                                <div class="team_txt">
                                    <h1><a href="#">Dr. Johan Doe</a></h1>
                                    <p>(Hepatologist)</p>
                                </div>
                                <div class="team_icon_hover our_doc_icn_hovr">
                                    <ul>
                                        <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                                        </li>
                                        <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                                        </li>
                                        <li><a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a>
                                        </li>
                                        <li><a href="#"><i class="fa fa-youtube-play" aria-hidden="true"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="col-xs-6 col-sm-6 col-md-3 col-lg-3 portfolio-wrapper III_column med_bottompadder30 resp_div_img" data-groups='["all", "business", "surgery", "photoshop"]'>
                            <div class="team_about our_doc_main dc_porftfolio_img">
                                <div class="team_icon_wrapper">
                                    <img src="images/001-time.png" alt="img" class="img-responsive">
                                </div>
                                <div class="team_img special_team_img_mn">
                                    <img src="images/team_4.jpg" alt="img" class="img-responsive">
                                </div>
                                <div class="team_txt">
                                    <h1><a href="#">Dr. Johan Doe</a></h1>
                                    <p>(Hepatologist)</p>
                                </div>
                                <div class="team_icon_hover our_doc_icn_hovr">
                                    <ul>
                                        <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                                        </li>
                                        <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                                        </li>
                                        <li><a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a>
                                        </li>
                                        <li><a href="#"><i class="fa fa-youtube-play" aria-hidden="true"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-3 col-lg-3 portfolio-wrapper III_column med_bottompadder30 resp_div_img" data-groups='["all", "business", "website", "photoshop"]'>
                            <div class="team_about our_doc_main dc_porftfolio_img">
                                <div class="team_icon_wrapper">
                                    <img src="images/001-time.png" alt="img" class="img-responsive">
                                </div>
                                <div class="team_img special_team_img_mn">
                                    <img src="images/team_5.jpg" alt="img" class="img-responsive">
                                </div>
                                <div class="team_txt">
                                    <h1><a href="#">Dr. Johan Doe</a></h1>
                                    <p>(Hepatologist)</p>
                                </div>
                                <div class="team_icon_hover our_doc_icn_hovr">
                                    <ul>
                                        <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                                        </li>
                                        <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                                        </li>
                                        <li><a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a>
                                        </li>
                                        <li><a href="#"><i class="fa fa-youtube-play" aria-hidden="true"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-3 col-lg-3 portfolio-wrapper III_column med_bottompadder30 resp_div_img" data-groups='["all", "business", "website", "photoshop"]'>
                            <div class="team_about our_doc_main dc_porftfolio_img">
                                <div class="team_icon_wrapper">
                                    <img src="images/001-time.png" alt="img" class="img-responsive">
                                </div>
                                <div class="team_img special_team_img_mn">
                                    <img src="images/team_6.jpg" alt="img" class="img-responsive">
                                </div>
                                <div class="team_txt">
                                    <h1><a href="#">Dr. Johan Doe</a></h1>
                                    <p>(Hepatologist)</p>
                                </div>
                                <div class="team_icon_hover our_doc_icn_hovr">
                                    <ul>
                                        <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                                        </li>
                                        <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                                        </li>
                                        <li><a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a>
                                        </li>
                                        <li><a href="#"><i class="fa fa-youtube-play" aria-hidden="true"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-3 col-lg-3 portfolio-wrapper III_column med_bottompadder30 resp_div_img" data-groups='["all", "surgery", "website", "photoshop"]'>
                            <div class="team_about our_doc_main dc_porftfolio_img">
                                <div class="team_icon_wrapper">
                                    <img src="images/001-time.png" alt="img" class="img-responsive">
                                </div>
                                <div class="team_img special_team_img_mn">
                                    <img src="images/team_1.jpg" alt="img" class="img-responsive">
                                </div>
                                <div class="team_txt">
                                    <h1><a href="#">Dr. Johan Doe</a></h1>
                                    <p>(Hepatologist)</p>
                                </div>
                                <div class="team_icon_hover our_doc_icn_hovr">
                                    <ul>
                                        <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                                        </li>
                                        <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                                        </li>
                                        <li><a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a>
                                        </li>
                                        <li><a href="#"><i class="fa fa-youtube-play" aria-hidden="true"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-3 col-lg-3 portfolio-wrapper III_column med_bottompadder30 resp_div_img" data-groups='["all", "business", "website", "photoshop"]'>
                            <div class="team_about our_doc_main dc_porftfolio_img">
                                <div class="team_icon_wrapper">
                                    <img src="images/001-time.png" alt="img" class="img-responsive">
                                </div>
                                <div class="team_img special_team_img_mn">
                                    <img src="images/team_2.jpg" alt="img" class="img-responsive">
                                </div>
                                <div class="team_txt">
                                    <h1><a href="#">Dr. Johan Doe</a></h1>
                                    <p>(Hepatologist)</p>
                                </div>
                                <div class="team_icon_hover our_doc_icn_hovr">
                                    <ul>
                                        <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                                        </li>
                                        <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                                        </li>
                                        <li><a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a>
                                        </li>
                                        <li><a href="#"><i class="fa fa-youtube-play" aria-hidden="true"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-3 col-lg-3 portfolio-wrapper III_column med_bottompadder30 resp_div_img" data-groups='["all", "business", "website", "logo"]'>
                            <div class="team_about our_doc_main dc_porftfolio_img">
                                <div class="team_icon_wrapper">
                                    <img src="images/001-time.png" alt="img" class="img-responsive">
                                </div>
                                <div class="team_img special_team_img_mn">
                                    <img src="images/team_3.jpg" alt="img" class="img-responsive">
                                </div>
                                <div class="team_txt">
                                    <h1><a href="#">Dr. Johan Doe</a></h1>
                                    <p>(Hepatologist)</p>
                                </div>
                                <div class="team_icon_hover our_doc_icn_hovr">
                                    <ul>
                                        <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                                        </li>
                                        <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                                        </li>
                                        <li><a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a>
                                        </li>
                                        <li><a href="#"><i class="fa fa-youtube-play" aria-hidden="true"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-3 col-lg-3 portfolio-wrapper III_column med_bottompadder30 resp_div_img" data-groups='["all", "business", "website", "photoshop"]'>
                            <div class="team_about our_doc_main dc_porftfolio_img">
                                <div class="team_icon_wrapper">
                                    <img src="images/001-time.png" alt="img" class="img-responsive">
                                </div>
                                <div class="team_img special_team_img_mn">
                                    <img src="images/team_4.jpg" alt="img" class="img-responsive">
                                </div>
                                <div class="team_txt">
                                    <h1><a href="#">Dr. Johan Doe</a></h1>
                                    <p>(Hepatologist)</p>
                                </div>
                                <div class="team_icon_hover our_doc_icn_hovr">
                                    <ul>
                                        <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                                        </li>
                                        <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                                        </li>
                                        <li><a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a>
                                        </li>
                                        <li><a href="#"><i class="fa fa-youtube-play" aria-hidden="true"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-3 col-lg-3 portfolio-wrapper III_column resp_div_img" data-groups='["all", "business", "website", "photoshop"]'>
                            <div class="team_about our_doc_main dc_porftfolio_img">
                                <div class="team_icon_wrapper">
                                    <img src="images/001-time.png" alt="img" class="img-responsive">
                                </div>
                                <div class="team_img special_team_img_mn">
                                    <img src="images/team_5.jpg" alt="img" class="img-responsive">
                                </div>
                                <div class="team_txt">
                                    <h1><a href="#">Dr. Johan Doe</a></h1>
                                    <p>(Hepatologist)</p>
                                </div>
                                <div class="team_icon_hover our_doc_icn_hovr">
                                    <ul>
                                        <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                                        </li>
                                        <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                                        </li>
                                        <li><a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a>
                                        </li>
                                        <li><a href="#"><i class="fa fa-youtube-play" aria-hidden="true"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-3 col-lg-3 portfolio-wrapper III_column  resp_div_img" data-groups='["all", "business", "website", "photoshop"]'>
                            <div class="team_about our_doc_main dc_porftfolio_img">
                                <div class="team_icon_wrapper">
                                    <img src="images/001-time.png" alt="img" class="img-responsive">
                                </div>
                                <div class="team_img special_team_img_mn dc_port_main_img">
                                    <img src="images/team_1.jpg" alt="img" class="img-responsive">
                                </div>
                                <div class="team_txt">
                                    <h1><a href="#">Dr. Johan Doe</a></h1>
                                    <p>(Hepatologist)</p>
                                </div>
                                <div class="team_icon_hover our_doc_icn_hovr">
                                    <ul>
                                        <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                                        </li>
                                        <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                                        </li>
                                        <li><a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a>
                                        </li>
                                        <li><a href="#"><i class="fa fa-youtube-play" aria-hidden="true"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/#gridWrapper-->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container -->
        </section>
        <!--/.portfolio-area-->
    </div>
    <!--doctor portfolio section end-->
@endsection