@extends('layout.frontend.app')
@section('title', 'Doctor\'s Appointment')
@section('header_js')
@stop
@section('main')

<!--Page header & Title-->
<section id="page_header">
<div class="page_title">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
         <h2 class="title">Appointment with Dr. {{ $doctor->full_name }}</h2>
         <div class="page_link"><a href="{{ route('home') }}">Home</a><i class="fa fa-long-arrow-right"></i><span>Appointment with Dr. {{ $doctor->full_name }}</span></div>
      </div>
    </div>
  </div>
</div>  
</section>


<section class="padding">
  <div class="container">
    <div class="row">
        @if(Session::get('success'))
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <strong>Success!</strong> {{ Session::get('success') }}
            </div>
        @endif

        @if(Session::get('error'))
            <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <strong>Warning!</strong> {{ Session::get('error') }}
            </div>
        @endif
      <div class="col-md-12">
          <form class="callus" id="contact_form" style="margin-top:0" method="post" action="{{ route('doctors.book') }}">
              <div class="row">
                  <div class="col-md-4 col-sm-4 col-xs-4">
                      <div class="form-group">
                          <input class="form-control" type="text" name="f_name" id="f_name"  placeholder="Full Name*" value="{{ old('f_name') }}" required />
                      </div>
                  </div>
                  <div class="col-md-4 col-sm-4 col-xs-4">
                      <div class="form-group">
                          <input class="form-control" type="text" name="address" id="address"  placeholder="Address*" value="{{ old('address') }}" required />
                      </div>
                  </div>
                  <div class="col-md-4 col-sm-4 col-xs-4">
                      <div class="form-group">
                          <input class="form-control" type="text" name="mobile" id="mobile"  placeholder="Mobile No.*" value="{{ old('mobile') }}" required />
                      </div>
                  </div>
                  <div class="col-md-4 col-sm-4 col-xs-4">
                      <div class="form-group">
                          <input class="form-control" type="email" name="email" id="email"  placeholder="Email Address*" value="{{ old('email') }}" required />
                      </div>
                  </div>
                  <div class="col-md-4 col-sm-4 col-xs-4">
                      <div class="form-group">
                          <input class="form-control" type="text" name="date" id="date"  placeholder="Date* " value="{{ $date }}" disabled="true" required />
                      </div>
                  </div>
                  <div class="col-md-4 col-sm-4 col-xs-4">
                      <div class="form-group">
                          <select name="shift" id="" class="selectpicker">
                              <option value="">Select a shift</option>

                              @for($i=0; $i<count($shifts); $i++)
                                <option value="{{ $shifts[$i] }}">{{ $shifts[$i] }}</option>
                              @endfor

                          </select>
                      </div>
                  </div>
                  <div class="clearfix"></div>

                  <input type="hidden" name="doctor_id" value="{{ $doctor->id }}">
                  <input type="hidden" name="date" value="{{ $date }}">

                  <div class="col-md-12">
                      <div class="form-group">
                          <textarea placeholder="Message" name="message" id="message"></textarea>
                      </div>
                      <div class="form-group">
                          <div class="btn-submit button3">
                              <input type="submit" value="Submit Request" id="btn_contact_submit">
                          </div>
                      </div>
                  </div>
                  {!! csrf_field() !!}
              </div>
          </form>
      </div>

    </div>
  </div>
</section>


    
@stop