@extends('layout.frontend.app')
@section('content')

    <div id="featured-title" class="clearfix featured-title-left">
    <div id="featured-title-inner" class="container clearfix">
        <div class="featured-title-inner-wrap">
            <div class="featured-title-heading-wrap">
                <h1 class="featured-title-heading">Contact Us </h1>
            </div>
            <div id="breadcrumbs">
                <div class="breadcrumbs-inner">
                    <div class="breadcrumb-trail">
                        <a href="#" title="Construction" rel="home" class="trail-begin">Home</a>
                        <span class="sep">/</span>
                        <span class="trail-end">Contact Us </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Main Content -->
<div id="main-content" class="site-main clearfix">
    <div id="content-wrap">
        <div id="site-content" class="site-content clearfix">
            <div id="inner-content" class="inner-content-wrap">
                <div class="page-content">

<div class="wprt-spacer" data-desktop="70" data-mobi="60" data-smobi="60"></div>
                    <section class="wprt-section">
                        <div class="container">
                            <div class="row">
                              

                                <div class="col-md-4">
                                    <div class="wprt-information">
                                        <h4 class="margin-bottom-15">Contact Details</h4>
                                        
                                        <ul class="style-2">
                                            <li class="address">
                                                <span class="hl">Address:</span>
                                                <span class="text">{{ (Session::has('settings')) ? Session::get('settings')['contact-address'] : "" }}</span>
                                            </li>
                                            <li class="phone">
                                                <span class="hl">Phone:</span> 
                                                <span class="text">{{ (Session::has('settings')) ? Session::get('settings')['contact-number'] : "" }}</span>
                                            </li>
                                            <li class="email">
                                                <span class="hl">E-mail:</span>
                                                <span class="text">{{ (Session::has('settings')) ? Session::get('settings')['web-master-email'] : "" }}</span>
                                            </li>
                                        </ul>
                                    </div><!-- /.wprt-information -->
        
          <ul class="social_icon">
            <li class="black"><a href="http://www.fb.com/nirvanawellnessclinic" target="_blank" class="facebook"><i class="icon-facebook5"></i></a></li>
          </ul>
          <br><br>
          <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3533.497592055954!2d85.30952121454654!3d27.67101173369579!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39eb183265da5e4d%3A0x213cdedbd90eb86a!2sNirvana+Wellness+Centre+Pvt.+Ltd!5e0!3m2!1sen!2snp!4v1475044002128" width="100%" height="200" frameborder="0" style="border:0" allowfullscreen></iframe>
      </div>
      <div class="col-md-6 col-sm-6">
        <h2 class="heading">Get in Touch</h2>
        <hr class="heading_space">

        <div class="card">
          @if(Session::get('message') || $errors->any())
            <div class="card-body card-padding">
              @if(Session::get('message'))
                <div class="{{ (Session::get('class')) ? Session::get('class') : 'alert alert-success' }} alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  {{ Session::get('message') }}
                </div>
              @endif

              @if ($errors->any())
                @foreach($errors->all() as $error)
                  <div class="alert alert-danger alert-dismissible" role="alert">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      {{ $error }}
                  </div>
                @endforeach
              @endif
            </div>
          @endif
        </div>
      </div>
    </div>
  </div>
</section>
</div>
</div>
</div>
</div>
</div>
         
@endsection

       