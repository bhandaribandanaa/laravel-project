@extends('layout.frontend.app')
@section('title', $eventType->name)
@section('header_css')
    {!! Html::style('css/timeline.css') !!}
@endsection
@section('header_js')
    {!! Html::script('js/modernizr.js') !!}
    {!! Html::script('js/main.js') !!}
@stop
@section('main')

    <div class="wrapper">
        <div class="container">
            <div class="row">
                <div class="col l12 col m12 col s12">
                    <div class="blockquote z-depth-1">
                        <div class="breadcrumb"><a href="#">Home</a> <i class="fa fa-angle-right"></i> Events</div>
                        <div class="title">{{ $eventType->name }}</div>

                        @if(count($events)>0)

                            <section id="cd-timeline" class="cd-container">
                                @foreach($events as $event)
                                    <div class="cd-timeline-block">
                                        <div class="cd-timeline-img "></div>
                                        <div class="cd-timeline-content">

                                            <div class="timeline_cont">

                                                @if($event->photo && file_exists('uploads/media/'. $event->photo->file_name))
                                                    <div class="time_img">
                                                        <a
                                                                href="{{ route('event.detail',array($event->id,$event->slug)) }}"><img
                                                                    src="{{URL::asset('uploads/media/'. $event->photo->file_name) }}"></a>
                                                    </div>
                                                @else
                                                    <div class="time_img" style="min-height: 300px;">
                                                        <a
                                                                href="{{ route('event.detail',array($event->id,$event->slug)) }}"><img
                                                                    style="padding-top: 25%;"
                                                                    src="{{URL::asset('images/logo.png') }}"></a>
                                                    </div>
                                                @endif


                                                {{--{{  substr(strip_tags($event->description),0,300) . "..." }}--}}


                                                <div class="cd-date"><a
                                                            href="{{ route('event.detail',array($event->id,$event->slug)) }}">{{ $event->name }}</a>
                                                    <small><p>
                                                            <i class="fa fa-location-arrow"></i> {{ $event->location }}
                                                        </p>

                                                        <p><i class="fa fa-calendar"></i> <?php
                                                            $starting = strtotime($event->start_date);
                                                            $ending = strtotime($event->end_date);
                                                            echo date('d', $starting) . ' - ' . date('d M Y', $ending);;
                                                            ?></p>
                                                        <blockquote>
                                                            {{ $event->slogan }}
                                                        </blockquote>
                                                        <br>
                                                        <a class="btn btn-flat waves-effect waves-light "
                                                           href="{{ route('event.detail',array($event->id,$event->slug)) }}">View
                                                            Event Detail</a>

                                                        @if($event->book_online == '1')

                                                            <?php

                                                            $todayDate = date('Y-m-d');
                                                            $todayDate = date('Y-m-d', strtotime($todayDate));
                                                            $bookingStartDate = date('Y-m-d', strtotime($event->registration_start_date));
                                                            $bookingEndDate = date('Y-m-d', strtotime($event->registration_end_date));
                                                            ?>
                                                            @if (($todayDate >= $bookingStartDate) && ($todayDate <= $bookingEndDate))
                                                                &nbsp;
                                                                <a class="btn btn-flat waves-effect waves-light "
                                                                   href="{{ route('event.registration',array($event->id,$event->slug)) }}">
                                                                    Online Registration</a>
                                                            @endif
                                                        @endif

                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                @endforeach
                            </section>
                        @else

                            <h6> No Events found in {{ $eventType->name }} .</h6>
                        @endif

                    </div>


                    <div class="col m12 mgt20">
                        @include('partial.pagination', ['paginator' => $events])
                    </div>


                </div>


            </div>
        </div>
    </div>
@stop
