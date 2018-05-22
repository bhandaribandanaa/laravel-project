
@extends('layout.frontend.app')
@section('content')




<!-- Slider -->
<div id="featured-title" class="clearfix featured-title-left">
    <div id="featured-title-inner" class="container clearfix">
        <div class="featured-title-inner-wrap">
            <div class="featured-title-heading-wrap">
                <h1 class="featured-title-heading">{{$content->page_title }} </h1>
            </div>
            <div id="breadcrumbs">
                <div class="breadcrumbs-inner">
                    <div class="breadcrumb-trail">
                        <a href="{{URL::to('/')}}" title="Construction" rel="home" class="trail-begin">Home</a>
                        <span class="sep">/</span>
                        <span class="trail-end">{{$content->page_title }}</span>
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
                        <div class="wprt-spacer" data-desktop="70" data-mobi="60" data-smobi="60"></div>
                       {!! $content->description !!}

        
        <div class="wprt-spacer" data-desktop="70" data-mobi="60" data-smobi="60"></div>
                         
                                    
                                    
                                    
                    <?php

          if($content->attachment && file_exists('uploads/pages/thumbs_sec/'.$content->attachment)) {
            $src = asset('uploads/pages/thumbs/'.$content->attachment);
          }
          ?>
                    <div class="chart-column col-md-6 col-sm-12 col-xs-12" style="display:none">
                        <div class="inner-box">
                            @if (!empty($src))
                                <div class="image">

                                    <img style="width:100%" src="{{asset('uploads/pages/'.$page->attachment)}}" alt="">

                                </div>
                            @endif
                        </div>

                    </div>
                </div>



            </div>
            </section>
@endsection
