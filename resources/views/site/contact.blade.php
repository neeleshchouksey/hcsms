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
                            <h1>Contact Us</h1>
                            <ol class="breadcrumb">
                                <li><a href="index.html">Home</a>
                                </li>
                                <li>Contact</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- med_tittle_section End-->
    <!--contact us section start -->
    <div class="contact_us_section med_toppadder100 med_bottompadder70">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                    <div class="choose_heading_wrapper med_bottompadder30">
                        <h1 class="med_bottompadder20">Contact us</h1>
                        <img src="images/line.png" alt="title" class="med_bottompadder20">
                        <p>Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis bibendum auctor, nisi elit consequat ipsum, nec sagittis sem nibh id elit. Duis sed odio sit amet nibh vulputate.</p>
                    </div>
                    <div class="row cont_main_section">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <div class="contect_form1 dc_cont_div">
                                <input type="text" placeholder="Your Name">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <div class="contect_form1 dc_cont_div">
                                <input type="email" placeholder="Your Email">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <div class="contect_form1 dc_cont_div">
                                <input type="text" placeholder="Your Contact">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <div class="contect_form1 dc_cont_div">
                                <input type="text" placeholder="Your Subject">
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="contect_form4 dc_cont_div">
                                <textarea rows="5" placeholder="Your Comments Here"></textarea>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="contact_btn_wrapper med_toppadder30">
                                <ul>
                                    <li><a href="#">SUBMIT</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!--contact us section end-->
    <!-- dc category section start-->
    <div class="category_wrapper">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <div class="cat_about cont_cat_abt">
                        <div class="icon_wrapper dc_icon_section">
                            <img src="images/icon_map.png" alt="img" class="img-responsive">
                        </div>

                        <div class="cat_txt cont_cat_txt">
                            <h1>22, margatnet. 2212</h1>
                            <p>ISLINGTON, London</p>

                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <div class="cat_about cont_cat_abt">
                        <div class="icon_wrapper dc_icon_section">
                            <img src="images/icon_call.png" alt="img" class="img-responsive">
                        </div>


                        <div class="cat_txt cont_cat_txt">
                            <h1>+44 7929 000 321</h1>
                            <p>Mon-Fri 8:30am - 9:30pm</p>

                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <div class="cat_about cont_cat_abt">
                        <div class="icon_wrapper dc_icon_section">
                            <img src="images/icon_envelope.png" alt="img" class="img-responsive">
                        </div>

                        <div class="cat_txt cont_cat_txt cont_last_child">
                            <a href="#"><h1>help@healthchecksms.com,/h1></a>
                            <p>24 / 7online help support</p>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="map_main_wrapper cont_dc_map">
            <div id="map" style="width:100%; float:left; height:600px;"></div>
        </div>
    </div>
    <!-- dc category section end-->
    <!--news section start-->
    <div class="news_section_dc">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="news_dc_txt">
                        <h3>directions to hospital :</h3>
                        <p>Aenean sollicitudin, lorem quis bibendum auctor, nisi elit consequat ipsum, nec sagittis sem nibh id elit. Duis sed odio sit amet nibh.</p>
                    </div>
                </div>
                <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
                    <div class="edu_news_form edu_txt">
                        <input type="text" placeholder="Choose Directions">
                        <button type="button">get directions</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection