@extends('frontend.master')
@section('content')

<?php

if($data->attachment && file_exists('uploads/pages/thumbs_sec/'.$data->attachment)) {
    $src = asset('uploads/pages/thumbs/'.$data->attachment);
}
?>
    <!-- Slider -->
    <div id="featured-title" class="clearfix featured-title-left">
        <div id="featured-title-inner" class="container clearfix">
            <div class="featured-title-inner-wrap">
                <div class="featured-title-heading-wrap">
                    <h1 class="featured-title-heading">{{ $data->heading}}</h1>
                </div>
                <div id="breadcrumbs">
                    <div class="breadcrumbs-inner">
                        <div class="breadcrumb-trail">
                            <a href="{{URL::to('/')}}" title="Construction" rel="home" class="trail-begin">Home</a>
                            <span class="sep">/</span>
                            <span class="trail-end">{{ $data->heading}}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div id="main-content" class="site-main clearfix">
        <div id="content-wrap">
            <div id="site-content" class="site-content clearfix">
                <div id="inner-content" class="inner-content-wrap">
                    <div class="page-content">


                        <section class="wprt-section">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="wprt-spacer" data-desktop="80" data-mobi="60" data-smobi="60"></div>
                                    </div><!-- /.col-md-12 -->

                                    <div class="col-md-8">

                                        @if($data->attachment && file_exists('uploads/pages/thumbs_sec/'.$data->attachment))
                                            <div class="post-media clearfix">
                                                <img src="{{$src}}" alt="">
                                            </div><!-- /.post-media -->
                                        @endif

                                        <div class="post-content">
                                            {!! $data->description !!}
                                        </div><!-- /.post-excerpt -->

                                    </div><!-- /.col-md-8 -->



                                    <div class="col-md-4">
                                        <div id="sidebar">
                                            <div id="inner-sidebar" class="inner-content-wrap">


                                                <div class="widget widget_categories">
                                                    <h2 class="widget-title"><span>CATEGORIES</span></h2>
                                                    <ul>
                                                        <li class="cat-item cat-item-3"><a href="#">Building</a> </li>
                                                        <li class="cat-item cat-item-6"><a href="#">Ecobuilding</a> </li>
                                                        <li class="cat-item cat-item-4"><a href="#">House</a> </li>
                                                        <li class="cat-item cat-item-5"><a href="#">Office</a> </li>
                                                        <li class="cat-item cat-item-10"><a href="#">Tower</a> </li>
                                                    </ul>
                                                </div>



                                            </div><!-- /#inner-sidebar -->
                                        </div><!-- /#sidebar -->
                                    </div><!-- /.col-md-4 -->

                                    <div class="col-md-12">
                                        <div class="wprt-spacer" data-desktop="80" data-mobi="60" data-smobi="60"></div>
                                    </div><!-- /.col-md-12 -->
                                </div><!-- /.row -->
                            </div><!-- /.container -->
                        </section>


                    </div><!-- /.page-content -->
                </div>
            </div>
        </div>
    </div>

@endsection