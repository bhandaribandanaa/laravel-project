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
                                href="#">Events</a> <i
                                class="fa fa-angle-right"></i><a
                                href="{{ route('event.detail',array($event->id,$event->slug)) }}"> {{ $event->name }}</a>
                        <i
                                class="fa fa-angle-right"></i>{{ $content->title }}</div>


                    {{--<div class="title">{{ $event->name }}</div>--}}
                    <div class="title">{{ $content->title }}</div>

                    {{--{!! $content->description !!}--}}
                    {!! html_entity_decode($content->description) !!}
                    <div class="clear"></div>
                </div>
            </div>
            <div class="col l3 col m12 col s12">
                <!-- Sidebar -->
                <div class="sidbar_wrap">
                    <div class="sidbar-box z-depth-1">
                        <ul>
                            <?php
                            $curDate = strtotime(date("Y-m-j"));
                            $eventDate = strtotime($event->start_date);
                            ?>

                            {{--@if($curDate < $eventDate)--}}
                                {{--<li>--}}
                                    {{--<a href="{{ route('event.registration',array($event->id,$event->slug)) }}">Registration--}}
                                        {{--Here </a>--}}
                                {{--</li>--}}
                            {{--@endif--}}
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