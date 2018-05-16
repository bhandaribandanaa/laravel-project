@extends('layout.frontend.app')
@section('title', 'Select Doctor')
@section('header_js')
@stop
@section('main')

    <!--Page header & Title-->
    <section id="page_header">
        <div class="page_title">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h2 class="title">Health Checkup Package (CCP) Booking</h2>
                        <div class="page_link"><a href="{{ route('home') }}">Home</a><i class="fa fa-long-arrow-right"></i><span>{{ $package_name }}</span><i class="fa fa-long-arrow-right"></i><span>Available Doctors</span></div>
                        <div> Please select any of the following available doctors for this health checkup package: </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="padding">
        <div class="container">
            <div class="row">


                @forelse($doctors as $doc)
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
                                        <a class="btn-readmore" href="{{ route('packages.appointment', [$package, $doc->slug]) }}">Book Package</a>
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