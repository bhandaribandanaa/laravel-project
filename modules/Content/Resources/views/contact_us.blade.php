@extends('layout.frontend.app')
@section('title', 'Contact Us')
@section('header_js')
@stop
@section('main')
    <section class="padding ">
  <div class="container">
    <div class="row">
      
      <div class="col-md-6 col-sm-6 ">
        <h2 class="heading">Contact Details</h2>
        <hr class="heading_space">  
        <h3>Kathmandu Branch</h3><br />
        <p><strong>Address:</strong>Lazimpat, Uttar Dhoka, Kathmandu, Nepal</p>
        <p><strong>Phone:</strong>+977-1-4001121, 4416434</p>
<br />
<hr>
<br />
<h3>Lalitpur Branch</h3>
<br />
        <p><strong>Address:</strong> Shaligram Village Complex Jawalakhel, Lalitpur</p>
        <p><strong>Phone:</strong> +977-1-5530443, 5542121</p>

<br />
<hr>
<br />
        <p><strong>Email:</strong> <a href="mailto:info@nirvanawellnessclinic.com">info@nirvanawellnessclinic.com</a></p>
        <p><strong>Web:</strong> <a href="http://www.nirvanawellnessclinic.com">www.nirvanawellnessclinic.com</a></p>
        
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

        <form class="callus" id="contact_form" method="post" action="{{ route('pages.contact_us') }}">
          <div class="row">
          
           <div class="col-md-12">
                    <div id="result" class="text-center form-group"></div>
           </div>
          
            <div class="col-md-12">
              <div class="form-group">
                <input class="form-control" type="text" name="full_name" id="full_name"  placeholder="Full Name" required />
              </div>
            </div>
            
            <div class="col-md-6">
              <div class="form-group">
                <input class="form-control" type="email" name="email" id="email"  placeholder="Email Address" required />
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <input class="form-control" type="text" name="phone" id="phone" required placeholder="Phone No" required>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <input class="form-control" type="text" name="address" id="address" required placeholder="Address" required>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <input class="form-control" type="text" name="mobile_no" id="mobile" required placeholder="Mobile No" required>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <textarea placeholder="Message" name="message" id="message"></textarea>
              </div>
              {!! csrf_field() !!}
              <div class="form-group">
                 <div class="btn-submit button3">
                <input type="submit" value="Submit Request" id="btn_contact_submit">
                
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>

 <div class="col-md-12 col-sm-12 ">

{{--<img src="{{ asset('images/nirvana-map.jpg') }}" width="100%" />--}}

</div>





    </div>
  </div>
</section>
<style>
  .alert-success{
    line-height: 20px !important;
  }
</style>
@stop
