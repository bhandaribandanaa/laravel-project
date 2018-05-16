@extends('layout.frontend.app')
@section('title', 'Services')
@section('header_js')
@stop
@section('main')

    <!--Page header & Title-->
    <section id="page_header" class="page_header_small">
        <div class="page_title">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h2 class="title">Our Services</h2>
                        <div class="page_link"><a href="#">Home</a><i class="fa fa-long-arrow-right"></i><span>Services</span></div>
                    </div>
                </div>
            </div>
        </div>
    </section>



    <section class="padding">
        <div class="container">
            <div class="row">
                <div class="procedure">
                    <div class="col-md-3 col-sm-4">
                        <ul class="tabs">
                            {{--*/$i=1/*--}}
                            @forelse($services as $service)
                                <li @if($i==1)class="active"@endif rel="service-{{$service->id}}">{{ $service->title }}</li>
                                {{--*/$i++/*--}}
                            @empty
                                Sorry No Services added.
                            @endforelse

                        </ul>
                    </div>
                    <div class="col-md-9 col-sm-8">
                        <div class="tab_container">
                            @forelse($services as $service)
                                <h3 class="d_active tab_drawer_heading" rel="tab1">Cardiac Service & Specialities</h3>
                                <div id="service-{{ $service->id }}" class="tab_content">
                                    <div class="procedure_content">
                                        @if($service->image != NULL)
                                            <img src="{{ asset('uploads/services/'.$service->image) }}" alt="Cancer Center" class="img-responsive heading_space">
                                        @endif
                                        {!! $service->description !!}
                                    </div>
                                </div>
                            @empty
                                Sorry No Services added.
                            @endforelse


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>




@stop