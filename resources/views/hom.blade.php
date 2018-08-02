@extends('layout.frontend.app')
@section('title', 'Home')



@section('slider')
    @include('frontend.partials.index-slider')
@endsection

@section('content')

<!-- Main Content -->
<div id="main-content" class="site-main clearfix">
    <div id="content-wrap">
        <div id="site-content" class="site-content clearfix">
            <div id="inner-content" class="inner-content-wrap">
                <div class="page-content">
                    {{--Latest Demand--}}
                    
                    @include('demand::v_demands')
                    {{--End Latest Demand--}}



                    
                         <div class="wprt-spacer" data-desktop="40" data-mobi="60" data-smobi="60"></div>
                                    <h2>ABOUT US</h2>
                                    <div class="wprt-lines style-1 custom-3">
                                        <div class="line-1"></div>
                                        <div class="line-2"></div>
                                    </div>
                                    <div class="wprt-spacer" data-desktop="40" data-mobi="40" data-smobi="40"></div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div style=" font-size:14px;">  <div style="border-left: 3px solid #da320e;    padding: 5px 0 5px 15px;    margin-bottom: 25px;    font-size: 17px;">Sadik International Overseas Pvt.Ltd is a newly emerged, fast-growing business that aims recruitment agencies in Nepal under the department of Labor.</div>
                                </div>
                                    <?php $aboutus = App\Classes\Helper::getAboutUS(); ?>


                     @foreach($aboutus as $c)
                    
                     {{ str_limit(strip_tags($c->description), 900) }}
            @if (strlen(strip_tags($c->description)) > 900)
              ... <a href="{{ route('pages.detail',$c->slug) }}" class="widget_text">Read More</a>
            @endif
                  

              
                    @endforeach
                                   

                                    

                                    

                                    

                                    
                                </div><!-- /.col-md-6 -->

                                <div class="col-md-6">
                                   

                                    <div class="wprt-galleries galleries w-570px" data-width="135" data-margin="10">
                                        <div id="wprt-slider" class="flexslider">
                                            <ul class="slides">
                                                <li class="flex-active-slide">
                                                    <a class="zoom" href="img/gallery/1.jpg"><i class="fa fa-arrows-alt"></i></a>
                                                    <img src="img/gallery/1.jpg" alt="image" />
                                                </li>

                                                <li class="flex-active-slide">
                                                    <a class="zoom" href="img/gallery/2.jpg"><i class="fa fa-arrows-alt"></i></a>
                                                    <img src="img/gallery/2.jpg" alt="image" />
                                                </li>

                                                <li class="flex-active-slide">
                                                    <a class="zoom" href="img/gallery/3.jpg"><i class="fa fa-arrows-alt"></i></a>
                                                    <img src="img/gallery/3.jpg" alt="image" />
                                                </li>

                                                <li class="flex-active-slide">
                                                    <a class="zoom" href="img/gallery/4.jpg"><i class="fa fa-arrows-alt"></i></a>
                                                    <img src="img/gallery/4.jpg" alt="image" />
                                                </li>
                                            </ul>
                                        </div>

                                        <div id="wprt-carousel" class="flexslider">
                                            <ul class="slides">
                                                <li><img src="img/gallery/1-s.jpg" alt="image"></li>
                                                <li><img src="img/gallery/2-s.jpg" alt="image"></li>
                                                <li><img src="img/gallery/3-s.jpg" alt="image"></li>
                                                <li><img src="img/gallery/4-s.jpg" alt="image"></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div><!-- /.col-md-6 -->

                                <div class="col-md-12">
                                    <div class="wprt-spacer" data-desktop="70" data-mobi="60" data-smobi="60"></div>
                                </div><!-- /.col-md-12 -->
                            </div><!-- /.row -->
                        </div><!-- /.container -->
                    </section>

                  
                         {{--Job Categories--}}
                    @include('content::index-job_categories')
                    {{--End Job Categories--}}
                    <!-- WORKS -->
                    <section class="wprt-section works parallax">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="wprt-spacer" data-desktop="70" data-mobi="60" data-smobi="60"></div>
                                    <h2 class="text-left text-black">COUNTRIES WE SUPPLY</h2>
                                    <div class="wprt-lines custom-2">
                                        <div class="line-1"></div>
                                    </div>
                                    <div class="wprt-spacer" data-desktop="40" data-mobi="40" data-smobi="40"></div>
                                </div><!-- /.col-md-12 -->
                                        
                                <div class="col-md-12">
                                    <div class="wprt-project arrow-style-2 has-arrows arrow60 arrow-dark" data-layout="slider" data-column="3" data-column2="3" data-column3="2" data-column4="1" data-gaph="30" data-gapv="30">
                                        <div id="projects" class="cbp">
                                           

                                            <div class="cbp-item">
                                                <div class="project-item">
                                                    <div class="inner">
                                                        <figure class="effect-zoe">
                                                            <img src="img/projects/countries/qatar.jpg" alt="image" />
                                                            <figcaption>
                                                                <div>
                                                                    <h2><a target="_blank" href="page-project-detail-3.html">QATAR</a></h2>
                                                                    
                                                                </div>
                                                            </figcaption>           
                                                        </figure>

                                                        <a class="project-zoom cbp-lightbox" href="img/projects/countries/qatar.jpg" data-title="QATAR">
                                                            <i class="fa fa-arrows-alt"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div><!--/.cbp-item -->
                                             <div class="cbp-item">
                                                <div class="project-item">
                                                    <div class="inner">
                                                        <figure class="effect-zoe">
                                                            <img src="img/projects/countries/oman.jpg" alt="image" />
                                                            <figcaption>
                                                                <div>
                                                                    <h2><a target="_blank" href="page-project-detail-3.html">OMAN</a></h2>
                                                                    
                                                                </div>
                                                            </figcaption>           
                                                        </figure>

                                                        <a class="project-zoom cbp-lightbox" href="img/projects/countries/oman.jpg" data-title="OMAN">
                                                            <i class="fa fa-arrows-alt"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div><!--/.cbp-item -->
                                             <div class="cbp-item">
                                                <div class="project-item">
                                                    <div class="inner">
                                                        <figure class="effect-zoe">
                                                            <img src="img/projects/countries/dubai.jpg" alt="image" />
                                                            <figcaption>
                                                                <div>
                                                                    <h2><a target="_blank" href="page-project-detail-3.html">DUBAI</a></h2>
                                                                    
                                                                </div>
                                                            </figcaption>           
                                                        </figure>

                                                        <a class="project-zoom cbp-lightbox" href="img/projects/countries/dubai.jpg" data-title="DUBAI">
                                                            <i class="fa fa-arrows-alt"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div><!--/.cbp-item -->
                                             <div class="cbp-item">
                                                <div class="project-item">
                                                    <div class="inner">
                                                        <figure class="effect-zoe">
                                                            <img src="img/projects/countries/bahrain.jpg" alt="image" />
                                                            <figcaption>
                                                                <div>
                                                                    <h2><a target="_blank" href="page-project-detail-3.html">BAHRAIN</a></h2>
                                                                    
                                                                </div>
                                                            </figcaption>           
                                                        </figure>

                                                        <a class="project-zoom cbp-lightbox" href="img/projects/countries/bahrain.jpg" data-title="BAHRAIN">
                                                            <i class="fa fa-arrows-alt"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div><!--/.cbp-item -->
                                             <div class="cbp-item">
                                                <div class="project-item">
                                                    <div class="inner">
                                                        <figure class="effect-zoe">
                                                            <img src="img/projects/countries/malaysia.jpg" alt="image" />
                                                            <figcaption>
                                                                <div>
                                                                    <h2><a target="_blank" href="page-project-detail-3.html">MALAYSIA</a></h2>
                                                                    
                                                                </div>
                                                            </figcaption>           
                                                        </figure>

                                                        <a class="project-zoom cbp-lightbox" href="img/projects/countries/malaysia.jpg" data-title="MALAYSIA">
                                                            <i class="fa fa-arrows-alt"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div><!--/.cbp-item -->
                                            <div class="cbp-item">
                                                <div class="project-item">
                                                    <div class="inner">
                                                        <figure class="effect-zoe">
                                                            <img src="img/projects/countries/kuwait.jpg" alt="image" />
                                                            <figcaption>
                                                                <div>
                                                                    <h2><a target="_blank" href="page-project-detail-3.html">KUWAIT</a></h2>
                                                                    
                                                                </div>
                                                            </figcaption>           
                                                        </figure>

                                                        <a class="project-zoom cbp-lightbox" href="img/projects/countries/kuwait.jpg" data-title="KUWAIT">
                                                            <i class="fa fa-arrows-alt"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div><!--/.cbp-item -->
                                            <div class="cbp-item">
                                                <div class="project-item">
                                                    <div class="inner">
                                                        <figure class="effect-zoe">
                                                            <img src="img/projects/countries/turkey.jpg" alt="image" />
                                                            <figcaption>
                                                                <div>
                                                                    <h2><a target="_blank" href="page-project-detail-3.html">TURKEY</a></h2>
                                                                    
                                                                </div>
                                                            </figcaption>           
                                                        </figure>

                                                        <a class="project-zoom cbp-lightbox" href="img/projects/countries/turkey.jpg" data-title="TURKEY">
                                                            <i class="fa fa-arrows-alt"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div><!--/.cbp-item -->

                                            
                                        </div><!-- /#projects -->
                                    </div><!--/.wprt-project -->
                                </div><!-- /.col-md-12 -->

                                <div class="col-md-12">
                                    <div class="wprt-spacer" data-desktop="80" data-mobi="60" data-smobi="60"></div>
                                </div><!-- /.col-md-12 -->
                            </div><!-- /.row -->
                        </div><!-- /.container -->
                    </section>   



                      {{--News Update--}}
                   @include('news::v_news')
                    {{--End News Update--}}
                   
                    <!-- TESTIMONIALS -->
                     <!-- TESTIMONIALS -->
                    <section class="wprt-section testiminials">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="wprt-spacer" data-desktop="70" data-mobi="60"
                                         data-smobi="60"></div>
                                </div><!-- /.col-md-12 -->

                                @include('gallery::v_gallery')
                                @include('testimonial::v_testimonial')
                                <div class="col-md-12">
                                    <div class="wprt-spacer" data-desktop="70" data-mobi="60"
                                         data-smobi="60"></div>
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






































