@extends('frontend.layouts.app')
@section('contact')
  <!--Page Title-->
    <section class="page-title" style="background-image:url({{asset('frontend/images/background/3.jpg')}});">
    	<div class="auto-container">
        	<div class="title-box">
            	<h2>Contact Us</h2>
                <ul>
                	<li><a href="index.html">Home</a></li>
                    <li>Contact Us</li>
                </ul>
            </div>
        </div>
    </section>
    <!--End Page Title-->
   <!--Contact Section-->

    <section class="contact-section">
         @if(Session::has('add_success'))
            <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('add_success') }}</p>
        @endif
    	<div class="auto-container">
        	<!--Sec Title-->
            <div class="sec-title centered">
            	<h3>Get in Touch with us</h3>
                
                <div class="separater"></div>
            </div>
            <div class="row clearfix">
            	
                <!--Column-->
            	<div class="form-column pull-right col-md-8 col-sm-12 col-xs-12">
                	
                    <!-- Contact Form -->
                    <div class="contact-form">

                        <!--Comment Form-->
                     <form method="post" action="{{'submit' }}" id="">
                          {!! csrf_field() !!}
                            <div class="row clearfix" >
                                <div class="col-md-6 col-sm-6 col-xs-12 form-group" {{ $errors->has('name') ? 'has-error' : '' }}>
                                    <input type="text" name="name" placeholder="Name *" required>
                                     @if ($errors->has('name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                             </div>

                                <div class="col-md-6 col-sm-6 col-xs-12 form-group" {{ $errors->has('email') ? 'has-error' : '' }}>
                                    <input type="email" name="email" placeholder="Email *" required>
                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                
                                <div class="col-md-6 col-sm-6 col-xs-12 form-group" {{ $errors->has('email') ? 'has-error' : '' }}>
                                    <input type="text" name="phone" placeholder="Phone *" required>
                                    @if ($errors->has('phone'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('phone') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                
                                <div class="col-md-6 col-sm-6 col-xs-12 form-group" {{ $errors->has('subject') ? 'has-error' : '' }}>
                                    <input type="text" name="subject" placeholder="Subject" required>
                                     @if ($errors->has('subject'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('subject') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group" {{ $errors->has('message') ? 'has-error' : '' }}>
                                    <textarea name="message" placeholder="Message"></textarea>
                                    @if ($errors->has('message'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('message') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
                                    <button class="theme-btn btn-style-one" type="submit" name="submit-form">Submit Now</button>
                                </div>

                            </div>
                        </form>
                         
                    </div>
                    <!--End Comment Form -->       
                </div>
                
                <!--Column-->
            	<div class="contact-info-column pull-left col-md-4 col-sm-12 col-xs-12">
                	<div class="inner-box">
                    	 <ul class="contact-info">
                            <?php $settings = App\Classes\Helper::settings(); ?>
                            <li><div class="icon"><span class="flaticon-placeholder"></span></div><span class="title">Location us on:</span>{{ $settings['contact-address'] }}</li>
                            <li><div class="icon"><span class="flaticon-email"></span></div><span class="title">Send us on:</span><a href="mailto:info@euronepal.com.np "> 
                            {{ $settings['web-master-email'] }} </a></li>
                            <li><div class="icon"><span class="flaticon-phone-call"></span></div><span class="title">Get us on:</span>{{ $settings['contact-number']}}</li>
                        </ul>
                    </div>
                </div>
                
            </div>
        </div>
      <div class="clear"></div>
                     <div class="wprt-spacer" data-desktop="70" data-mobi="60" data-smobi="60"></div>
                     <div class="row">
                     <div class="col-md-12">
                         <?php $settings = App\Classes\Helper::settings(); ?>
                        <center><iframe src="https://www.google.com/maps/embed?pb={{ $settings['google-map-link'] }}" width="80%" height="400"></iframe></center>
                     </div>
                  </div>
         </section>
    <!--End Contact Section-->
@endsection