@extends('layout.frontend.app')
@section('content')

<!-- Slider -->
<div id="featured-title" class="clearfix featured-title-left">
   <div id="featured-title-inner" class="container clearfix">
      <div class="featured-title-inner-wrap">
         <div class="featured-title-heading-wrap">
            <h1 class="featured-title-heading">{{ $content->heading}}</h1>
         </div>
         <div id="breadcrumbs">
            <div class="breadcrumbs-inner">
               <div class="breadcrumb-trail">
                  <a href="{{URL::to('/')}}" title="Sadik International Oversease" rel="home" class="trail-begin">Home</a>
                  <span class="sep">/</span>
                  <span class="trail-end">{{ $content->heading}}</span>
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
                        </div>
                        <!-- /.col-md-12 -->
                        <div class="col-md-8">
                           @if($image_name && file_exists('uploads/media/'.$image_name))
                           <div class="post-media clearfix">
                           <img style="width:100%" src="{{asset('uploads/media/'. $image_name)}}" alt="">
                          </div>
                           <!-- /.post-media -->
                           @endif
                           <div class="post-content">
                              {!! $content->description !!}
                           </div>
                           <!-- /.post-excerpt -->
                        </div>
                        <!-- /.col-md-8 -->
                        <div class="col-md-4">
                           <div id="sidebar">
                              <div id="inner-sidebar" class="inner-content-wrap">
                                 <div class="widget widget_categories">
                                    <h2 class="widget-title"><span>CATEGORIES</span></h2>
                                    <ul>

                               @foreach($all_jobs as $an)
                                @if($an->id != $content->id)
                       
                             <li class="clearfix">
                               

                            <div class="texts">
                                <h3><a href="{{ route('pages.detail',$an->slug) }}"">{{ $an->heading }}</a></h3>
                                
                            </div><!-- /.texts -->
                        </li>
                        
                         @endif
                        @endforeach
                                    
                                 </div>
                              </div>
                              <!-- /#inner-sidebar -->
                           </div>
                           <!-- /#sidebar -->
                        </div>
                        <!-- /.col-md-4 -->
                        <div class="col-md-12">
                           <div class="wprt-spacer" data-desktop="80" data-mobi="60" data-smobi="60"></div>
                        </div>
                        <!-- /.col-md-12 -->
                     </div>
                     <!-- /.row -->
                  </div>
                  <!-- /.container -->
               </section>
            </div>
            <!-- /.page-content -->
         </div>
      </div>
   </div>
</div>
@endsection