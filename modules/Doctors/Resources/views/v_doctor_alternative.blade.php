@extends('layout.frontend.app')
@section('title', 'Doctor\'s Appointment')
@section('header_js')
@stop
@section('main')
    <style>

        .procedure ul.tabsa li.active, .procedure ul.tabsa li:hover, .procedure ul.tabsa li:focus {
            background: #40BFB4;
            color: #ffffff;
        }

        .procedure ul.tabsa li {
            display: block;
            background: #f0f5f7;
            color: #111;
            font-size: 14px;

            cursor: pointer;
            position: relative;

        }
        .procedure ul.tabsa li a{ padding: 15px; border-bottom: #d1d1d1 solid 1px; display:block;}
    </style>
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

                @if(Session::has('no_schedule'))
                    <div class="alert alert-danger alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <strong>Sorry!</strong> {{ Session::get('no_schedule') }}
                    </div>
                @endif

                    @if(Session::has('date_range_error'))
                        <div class="alert alert-danger alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <strong>Sorry!</strong> {{ Session::get('date_range_error') }}
                        </div>
                    @endif

                    @if(Session::has('unavailable_schedule'))
                        <div class="alert alert-danger alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <strong>Sorry!</strong> {{ Session::get('unavailable_schedule') }}
                        </div>
                    @endif

                    <div class="procedure">
                        <div class="col-md-3 col-sm-4">
                            <ul class="tabsa">
                                <li><a href="{{ route('doctors') }}">All</a></li>

                                @foreach($spec as $s)
                                    <li @if($s->slug == $sp->slug) class="active" @endif><a href="{{ route('doctors',[$s->slug]) }}">{{ $s->title }}</a></li>

                                @endforeach
                            </ul>
                        </div>

                        <div class="col-md-9 col-sm-8">
                            <div class="tab_container">
                                @forelse($alternates as $doc)
                                    <div class="col-md-4 col-sm-6  heading_space">
                                        <label for="">
                                            <a href="{{ route('doctors.appointment',[$doc->slug]) }}">
                                                <div class="specialist_wrap">
                                                    @if($doc->image)
                                                        <img src="{{ asset('uploads/doctors/'.$doc->image) }}" alt="Doctor">
                                                    @else
                                                        <img src="{{ asset('images/doc.jpg') }}" alt="Doctor">
                                                    @endif
                                                    <div class="doc-cover">
                                                        <h3>Dr. {{ $doc->full_name }}</h3>
                                                        <p>{!! $doc->description !!}</p>
                                                        <a class="btn-readmore" href="{{ route('doctors.appointment',[$doc->slug]) }}">Book an appointment</a>
                                                    </div>
                                                </div>
                                            </a>
                                        </label>

                                    </div>
                                @empty
                                    <h2 align="center">Sorry there are no doctor records available right now.</h2>
                                @endforelse
                            </div></div>



            </div>
        </div>
    </section>


@stop