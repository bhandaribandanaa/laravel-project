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
                        <h2 class="title">Doctor's Appointment</h2>
                        <div class="page_link"><a href="{{ route('home') }}">Home</a><i class="fa fa-long-arrow-right"></i><span>Doctor's Appointment</span></div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="padding">
        <div class="container">
            <div class="row">

                @if(Session::has('package_doctor_error'))
                    <div class="alert alert-danger fade in">
                        <button type="button" class="close close-sm" data-dismiss="alert">
                            <i class="fa fa-times"></i>
                        </button>
                        <strong>Sorry!</strong> {{ Session::get('package_doctor_error') }}.
                    </div>
                @endif

                @if(Session::has('appointment_doctor_error'))
                    <div class="alert alert-danger fade in">
                        <button type="button" class="close close-sm" data-dismiss="alert">
                            <i class="fa fa-times"></i>
                        </button>
                        <strong>Sorry!</strong> {{ Session::get('appointment_doctor_error') }}.
                    </div>
                @endif

                @if(Session::has('unavailable_error'))
                    <div class="alert alert-danger fade in">
                        <button type="button" class="close close-sm" data-dismiss="alert">
                            <i class="fa fa-times"></i>
                        </button>
                        <strong>Sorry!</strong> {{ Session::get('unavailable_error') }}.
                    </div>
                @endif


                <ul class="nav nav-tabs">
                    <li class="active"><a href="{{ route('doctors',[$sp->slug]) }}">{{ $sp->title }}</a></li>
                </ul>


                @forelse($alternates as $doc)
                    <div class="col-md-4 col-sm-6  heading_space">
                        <label for="">
                            <a href="{{ route('packages.appointment', [$package, $doc->slug]) }}">
                                <div class="specialist_wrap">
                                    @if($doc->image)
                                        <img src="{{ asset('uploads/doctors/'.$doc->image) }}" alt="Doctor" style="">
                                    @else
                                        <img src="{{ asset('images/doc.jpg') }}" alt="Doctor">
                                    @endif
                                    <div class="doc-cover">
                                        <h3>Dr. {{ $doc->full_name }}</h3>
                                        <p>{!! $doc->description !!}</p>
                                        <a class="btn-readmore" href="{{ route('packages.appointment', [$package, $doc->slug]) }}">Book an appointment</a>
                                    </div>
                                </div>
                            </a>
                        </label>

                    </div>
                @empty
                    <h2 align="center">Sorry there are no doctor records available right now.</h2>
                @endforelse

            </div>
        </div>
    </section>


@stop