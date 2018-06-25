
@extends('layout.frontend.app')
@section('title', $content->page_title)
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
                        <a href="{{URL::to('/')}}" title="Sadik International Oversease" rel="home" class="trail-begin">Home</a>
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
                         
                                    
                                    
                                    
                    
                        </div>
                    </section>

                    </div>
                </div>



            </div>
        </div>
    </div>
    
         
@endsection
