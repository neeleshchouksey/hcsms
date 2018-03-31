 @extends('layouts.app')

@section('content')
 <!--header wrapper end-->
	<!--med_tittle_section-->
	<div class="med_tittle_section">
		<div class="med_img_overlay"></div>
			<div class="container">
			<div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="med_tittle_cont_wrapper">
						<div class="med_tittle_cont">
							<h1>Our Services</h1>
							<ol class="breadcrumb">
								  <li><a href="{{url('/')}}">Home</a></li>
								  <li>Services</li>
							</ol>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
    <!-- med_tittle_section End -->
    <!--service section start-->
    <div class="team_wrapper med_toppadder100">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12 col-lg-offset-2">
                    <div class="team_heading_wrapper med_bottompadder40">
                        <h1 class="med_bottompadder20">OUR SERVICES</h1>
                        <img src="images/Icon_team.png" alt="line" class="med_bottompadder20">
                        <p>Our services are designed to help medical professionals to communicate more effectively with their patients.</p>
                    </div>
                </div>
				 <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="ser_slider_wrapper">
				  <div class="owl-carousel owl-theme">
                  <div class="item">
					<div class="row">
						<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <div class="cat_about ser_section">
                        <div class="icon_wrapper">
                            <img src="images/icon1.png" alt="img" class="img-responsive">
                        </div>
                        <div class="cat_img">
                            <img src="images/icon_11.png" alt="img" class="img-responsive">
                        </div>
                        <div class="cat_txt">
                            <h1>Health Reminders</h1>
                            <p>We help you monitor your patients with our unique SMS service.</p>
                            <a href="#">Read More <i class="fa fa-long-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
				<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 hidden-xs">
                    <div class="cat_about ser_section">
                        <div class="icon_wrapper">
                            <img src="images/icon2.png" alt="img" class="img-responsive">
                        </div>
                        <div class="cat_img">
                            <img src="images/icon_2.png" alt="img" class="img-responsive">
                        </div>
                        <div class="cat_txt">
                            <h1>Appointment Reminders</h1>
                            <p>Our SMS reminders will help to improve your appointment attendance levels.</p>
                            <a href="#">Read More <i class="fa fa-long-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
				<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 hidden-xs hidden-sm">
                    <div class="cat_about ser_section">
                        <div class="icon_wrapper">
                            <img src="images/icon3.png" alt="img" class="img-responsive">
                        </div>
                        <div class="cat_img cat_img_3">
                            <img src="images/icon_3.png" alt="img" class="img-responsive">
                        </div>
                        <div class="cat_txt">
                            <h1>Dental Reminders</h1>
                            <p>Remind patients to adjust braces by SMS automatically and get live feedback.</p>
                            <a href="#">Read More <i class="fa fa-long-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
				</div>
				</div>
				<div class="item">
					<div class="row">
					<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 hidden-xs">
                    <div class="cat_about ser_section">
                        <div class="icon_wrapper">
                            <img src="images/icon1.png" alt="img" class="img-responsive">
                        </div>
                        <div class="cat_img">
                            <img src="images/icon_11.png" alt="img" class="img-responsive">
                        </div>
                        <div class="cat_txt">
                            <h1>Multiple Languages</h1>
                            <p>We send messages in the patients own language, this increases response rates, appointment attendance and patient rapport.</p>
                            <a href="#">Read More <i class="fa fa-long-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
				<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <div class="cat_about ser_section">
                        <div class="icon_wrapper">
                            <img src="images/icon2.png" alt="img" class="img-responsive">
                        </div>
                        <div class="cat_img">
                            <img src="images/icon_2.png" alt="img" class="img-responsive">
                        </div>
                        <div class="cat_txt">
                            <h1>Post Services</h1>
                            <p>Send a letter from you PC</p>
                            <a href="#">Read More <i class="fa fa-long-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
				<!-- <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 hidden-xs hidden-sm">
                    <div class="cat_about ser_section">
                        <div class="icon_wrapper">
                            <img src="images/icon3.png" alt="img" class="img-responsive">
                        </div>
                        <div class="cat_img cat_img_3">
                            <img src="images/icon_3.png" alt="img" class="img-responsive">
                        </div>
                        <div class="cat_txt">
                            <h1>Dental Care</h1>
                            <p>Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin at the good health for you.</p>
                            <a href="#">Read More <i class="fa fa-long-arrow-right"></i></a>
                        </div>
                    </div>
                </div> -->
			</div>
		</div>
			<!--  <div class="item">
				<div class="row">
				<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 hidden-xs">
                    <div class="cat_about ser_section">
                        <div class="icon_wrapper">
                            <img src="images/icon1.png" alt="img" class="img-responsive">
                        </div>
                        <div class="cat_img">
                            <img src="images/icon_11.png" alt="img" class="img-responsive">
                        </div>
                        <div class="cat_txt">
                            <h1>Heart Surgery</h1>
                            <p>Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin at the good health for you.</p>
                            <a href="#">Read More <i class="fa fa-long-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
				<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 hidden-xs hidden-sm">
                    <div class="cat_about ser_section">
                        <div class="icon_wrapper">
                            <img src="images/icon2.png" alt="img" class="img-responsive">
                        </div>
                        <div class="cat_img">
                            <img src="images/icon_2.png" alt="img" class="img-responsive">
                        </div>
                        <div class="cat_txt">
                            <h1>Emergency Care</h1>
                            <p>Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin at the good health for you.</p>
                            <a href="#">Read More <i class="fa fa-long-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
				<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <div class="cat_about ser_section">
                        <div class="icon_wrapper">
                            <img src="images/icon3.png" alt="img" class="img-responsive">
                        </div>
                        <div class="cat_img cat_img_3">
                            <img src="images/icon_3.png" alt="img" class="img-responsive">
                        </div>
                        <div class="cat_txt">
                            <h1>Dental Care</h1>
                            <p>Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin at the good health for you.</p>
                            <a href="#">Read More <i class="fa fa-long-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
			</div>
		</div> -->
       </div>
	</div>
	</div>
	</div>
</div>
</div>
    <!--service section end-->
	<!--ser_abt section start-->
    <div class="ser_abt">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 col-md-12 col-sm-12 col-xs-12">
                    <div class="ser_abt_img_resp">
                        <img src="images/service_abt.jpg" alt="img" class="img-responsive">
                    </div>
                </div>
                <div class="col-lg-7 col-md-12 col-sm-12 col-xs-12 abt_section">
                    <div class="abt_txt abt_txt_resp">
                        <h3>MEDICAL COMMUNICATION SERVICES DESIGNED TO BE EFFICIENT AND COST EFFECTIVE</h3>
                        <p class="med_toppadder20">Medic Comms specialises in providing easy to use and cost effective communications systems.  We work closely with medical professionals, practice staff and patients to ensure we provide a service to meet their needs.</p>
                        <p>We designed an easy admin system that allows you to set up reminders in minutes and have charts and tables to give you an at a glance view of your patient data.</p>
                        <p>However, to ensure that we are effective we then looked at what patients need and examined why existing communication technique are inadequate.  Which is why we now use SMS as the default service and send messages in the patients preferred language.</p>
                    </div>
                    <div class="abt_chk med_toppadder30">
                        <div class="content">
                            <ul>
                                <li><i class="fa fa-check-square-o" aria-hidden="true"></i><span>Appointment Reminders</span></li>
                                <li><i class="fa fa-check-square-o" aria-hidden="true"></i><span>Health Checks</span></li>
                                <li><i class="fa fa-check-square-o" aria-hidden="true"></i><span>Dental Reminders</span></li>
                                <li><i class="fa fa-check-square-o" aria-hidden="true"></i><span> Multilingual Messages</span></li>
								<li><i class="fa fa-check-square-o" aria-hidden="true"></i><span>Post Services</span></li>
                                <li><i class="fa fa-check-square-o" aria-hidden="true"></i><span>Direct SMS</span></li>
                                <li><i class="fa fa-check-square-o" aria-hidden="true"></i><span>Bespoke Customisation</span></li>
                                <li><i class="fa fa-check-square-o" aria-hidden="true"></i><span>GDPR and DPA Compliant</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--ser_abt section end-->
	<!--ser_blog section start-->
    <div class="blog_wrapper med_toppadder100 med_bottompadder90">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12 col-lg-offset-2">
                    <div class="team_heading_wrapper med_bottompadder50 wow fadeInDown" data-wow-delay="0.3s">
                        <h1 class="med_bottompadder20">KEY FEATURES</h1>
                        <img src="images/Icon_team.png" alt="line" class="med_bottompadder20">
                        <p>Sending messages is just the start of our great system. we also provide translation services and data analysis.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <div class="blog_about blog_resp wow SlideInLeft" data-wow-delay="0.4s">
                        <div class="blog_img blog_img_resp">
                            <figure>
                                <img src="images/ser_ser_1.jpg" alt="img" class="img-responsive">
                            </figure>
                        </div>
                        <div class="blog_txt">
                            <h1><a href="#">Translation Services</a></h1>
                            <p>All messages are available in many languages.  This increases patient interaction and response.  if you would like us to add another language, we will do this for free.</p>
                            <a href="#">Read More <i class="fa fa-long-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <div class="blog_about blog_resp">
                        <div class="blog_img blog_img_resp">
                            <figure>
                                <img src="images/ser_ser_2.jpg" alt="img" class="img-responsive">
                            </figure>
                        </div>
                        <div class="blog_txt">
                            <h1><a href="#">Patient Charts</a></h1>
                            <p>Patients can request their history by SMS and click a link to see charts and general advice instantly.</p>
                            <a href="#">Read More <i class="fa fa-long-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <div class="blog_about blog_resp">
                        <div class="blog_img">
                            <figure>
                                <img src="images/ser_ser_3.jpg" alt="img" class="img-responsive">
                            </figure>
                        </div>
                        <div class="blog_txt">
                            <h1><a href="#">Appointment Reminders </a></h1>
                            <p>We send multiple reminders in the patient language and include a link to the address that the patient can use to get directions.</p>
                            <a href="#">Read More <i class="fa fa-long-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection