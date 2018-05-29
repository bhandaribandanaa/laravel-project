@extends('layout.frontend.app')
@section('content')
<!-- Slider -->
<div id="featured-title" class="clearfix featured-title-left">
    <div id="featured-title-inner" class="container clearfix">
        <div class="featured-title-inner-wrap">
            <div class="featured-title-heading-wrap">
                <h1 class="featured-title-heading">{{ $news->title }}</h1>
            </div>
            <div id="breadcrumbs">
                <div class="breadcrumbs-inner">
                    <div class="breadcrumb-trail">
                        <a href="{{URL::to('/')}}" title="Construction" rel="home" class="trail-begin">Home</a>
                        <span class="sep">/</span>
                        <span class="trail-end">{{ $news->title }}</span>
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
                         <!--  -->
                           <div class="post-media clearfix">
                           <img style="width:100%" src="{{asset('uploads/news/'.$news->image)}}" alt="">
                          </div>
                           <!-- /.post-media -->
                       
                           <div class="post-content">
                              {!! $news->description !!}
                           </div>
                           <!-- /.post-excerpt -->
                        </div>
                                

                                <div class="col-md-4">
                                        <div id="sidebar">
            <div id="inner-sidebar" class="inner-content-wrap">
                

           

                <div id="widget_news_post-3" class="widget widget_recent_news">
                    <h2 class="widget-title"><span>OTHER NEWS UPDATE</span></h2>
                    <ul class="recent-news clearfix">
                        <li class="clearfix">
                            <div class="thumb">
                                <img width="150" height="150" src="{{asset('uploads/news/'.$news->image)}}" alt="image">
                            </div><!-- /.thumb -->

                            <div class="texts">
                                <h3><a href="#">{{ $news->title }}</a></h3>
                                <span class="post-date"><span class="entry-date">December 30, 2016</span></span>
                            </div><!-- /.texts -->
                        </li>

                        <li class="clearfix">
                            <div class="thumb">
                                <img width="150" height="150" src="{{asset('uploads/news/'.$news->image)}}" alt="image">
                            </div><!-- /.thumb -->

                            <div class="texts">
                                <h3><a href="#">{{ $news->title }}</a></h3>
                                <span class="post-date"><span class="entry-date">December 30, 2016</span></span>
                            </div><!-- /.texts -->
                        </li>

                        <li class="clearfix">
                            <div class="thumb">
                                <img width="150" height="150" src="{{asset('uploads/news/'.$news->image)}}" alt="image">
                            </div><!-- /.thumb -->

                            <div class="texts">
                                <h3><a href="#">{{ $news->title }}</a></h3>
                                <span class="post-date"><span class="entry-date">December 30, 2016</span></span>
                            </div><!-- /.texts -->
                        </li>
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

<!-- Footer -->
<footer id="footer">
    <div id="footer-widgets" class="container style-1">
        <div class="row">
            <div class="col-md-4">
                <div class="widget widget_text">
                    <h2 class="widget-title"><span>ABOUT US</span></h2>
                    <div class="textwidget">
                       
                        <p>The company aims specializing in deployment Hospitality and Service Industry, Security guard, Skilled and Unskilled labor, Domestic Maid, Semi-Skilled Labor. Sadik International Overseas philosophy is based on the concept of quality and speed which can be best achieved by people with experience in the business. </p>

                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="widget widget_links">
                    <h2 class="widget-title"><span>COMPANY LINKS</span></h2>
                    <ul class="wprt-links clearfix col2">
                        <li class="style-2"><a href="#">Professional</a></li>
                        <li class="style-2"><a href="#">Skilled Labor</a></li>
                        <li class="style-2"><a href="#">Semi-Skilled Labor</a></li>
                        <li class="style-2"><a href="#">Hotel / Service Industry</a></li>
                        <li class="style-2"><a href="#">Unskilled Labor</a></li>
                        <li class="style-2"><a href="#">Domestic Maid</a></li>
       
                    </ul>
                </div>
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