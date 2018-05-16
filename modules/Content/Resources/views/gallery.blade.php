@extends('layout.frontend.app')
@section('title', 'Gallery')
@section('header_js')
@stop
@section('main')
    <div class="container">
        <div class="row">
            <div class="col l9 col m12 col s12">
                <div class="blockquote z-depth-1">
                    <div class="breadcrumb"> <a href="#">Home</a> <i class="fa fa-angle-right"></i> Gallery <i class="fa fa-angle-right"></i>12th Internatinal Conference of SIMON</div>
                    <div class="title">12th Internatinal Conference of SIMON</div>

                    <div class="camera_wrap camera_magenta_skin" id="camera_wrap_1">
                        <div data-thumb="{{ url('images/gallery/gal1.jpg')}}" data-src="{{ url('images/gallery/gal1.jpg')}}">
                            <div class="camera_caption fadeFromBottom"></div>
                        </div>
                        <div data-thumb="{{ url('images/gallery/gal2.jpg')}}" data-src="{{ url('images/gallery/gal2.jpg')}}">
                            <div class="camera_caption fadeFromBottom"></div>
                        </div>
                        <div data-thumb="{{ url('images/gallery/gal3.jpg')}}" data-src="{{ url('images/gallery/gal3.jpg')}}">
                            <div class="camera_caption fadeFromBottom"></div>
                        </div>
                        <div data-thumb="{{ url('images/gallery/gal4.jpg')}}" data-src="{{ url('images/gallery/gal4.jpg')}}">
                            <div class="camera_caption fadeFromBottom"></div>
                        </div>
                        <div data-thumb="{{ url('images/gallery/gal5.jpg')}}" data-src="{{ url('images/gallery/gal5.jpg')}}">
                            <div class="camera_caption fadeFromBottom"></div>
                        </div>
                        <div data-thumb="{{ url('images/gallery/gal6.jpg')}}" data-src="{{ url('images/gallery/gal6.jpg')}}">
                            <div class="camera_caption fadeFromBottom"></div>
                        </div>
                        <div data-thumb="{{ url('images/gallery/gal7.jpg')}}" data-src="{{ url('images/gallery/gal7.jpg')}}">
                            <div class="camera_caption fadeFromBottom"></div>
                        </div>
                        <div data-thumb="{{ url('images/gallery/gal8.jpg')}}" data-src="{{ url('images/gallery/gal8.jpg')}}">
                            <div class="camera_caption fadeFromBottom"></div>
                        </div>
                        <div data-thumb="{{ url('images/gallery/gal9.jpg')}}" data-src="{{ url('images/gallery/gal9.jpg')}}">
                            <div class="camera_caption fadeFromBottom"></div>
                        </div>
                        <div data-thumb="{{ url('images/gallery/gal10.jpg')}}" data-src="{{ url('images/gallery/gal10.jpg')}}">
                            <div class="camera_caption fadeFromBottom"></div>
                        </div>
                        <div data-thumb="{{ url('images/gallery/gal11.jpg')}}" data-src="{{ url('images/gallery/gal11.jpg')}}">
                            <div class="camera_caption fadeFromBottom"></div>
                        </div>
                        <div data-thumb="{{ url('images/gallery/gal12.jpg')}}" data-src="{{ url('images/gallery/gal12.jpg')}}'">
                            <div class="camera_caption fadeFromBottom"></div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
            <div class="col l3 col m12 col s12">
                <!-- Sidebar -->
                <div class="sidbar_wrap">

                    <div class="sidbar-box z-depth-1">
                        @include('frontend.facebook')
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop