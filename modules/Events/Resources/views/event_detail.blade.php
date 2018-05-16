@extends('layout.frontend.app')
@section('title', $event->name)
@section('header_js')
@stop
@section('main')
    <div class="container">
        <div class="row">
            <div class="col l9 col m12 col s12">
                <div class="blockquote z-depth-1">
                    <div class="breadcrumb"><a href="{{ route('home') }}">Home</a> <i class="fa fa-angle-right"></i> <a
                                href="#">Events</a> <i class="fa fa-angle-right"></i> <a
                                href="{{ route('event.detail', array($event->id,$event->slug)) }}">{{ $event->name }}</a>
                        <i class="fa fa-angle-right"></i> Registration
                    </div>
                    <?php $success = Session::get('success'); ?>
                    @if($success)
                        <div class="alert alert-success reg_success">
                            {!! $success !!}

                        </div>
                    @endif

                    <div class="title">{{ $event->name }}</div>
                    <em><code>{{ $event->slogan }}</code></em>

                    <p>Venue {{ $event->location }}</p>

                    <p>Starting Date : {{ $event->start_date }}</p>

                    <p>MESSAGE</p>
                    {!! $event->description !!}
                </div>
            </div>
            <div class="col l3 col m12 col s12">
                <!-- Sidebar -->
                <div class="sidbar_wrap">
                    <div class="sidbar-box z-depth-1">
                        <ul>
                            @if($event->book_online == '1')
                                <?php

                                $todayDate = date('Y-m-d');
                                $todayDate = date('Y-m-d', strtotime($todayDate));
                                $bookingStartDate = date('Y-m-d', strtotime($event->registration_start_date));
                                $bookingEndDate = date('Y-m-d', strtotime($event->registration_end_date));
                                ?>

                                @if (($todayDate >= $bookingStartDate) && ($todayDate <= $bookingEndDate))
                                    <li>
                                        <a href="{{ route('event.registration',array($event->id,$event->slug)) }}">Registration
                                            Here </a>
                                    </li>

                                @endif


                            @endif

                            @if(count($event->contents)>0)
                                @foreach($event->contents as $content)
                                    <li>
                                        <a href="{{ route('event.detail.content',array($event->id,$event->slug,$content->slug)) }}">{{ $content->title }}</a>
                                    </li>
                                @endforeach
                            @endif
                        </ul>
                    </div>
                    <div class="sidbar-box z-depth-1">
                        @include('frontend.facebook')
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
