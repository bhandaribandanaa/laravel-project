 @extends('frontend.layouts.app')
 @section('content')
 <section class="main-slider">
  
    <div class="rev_slider_wrapper fullwidthbanner-container"  id="rev_slider_one_wrapper" data-source="gallery">
      <div class="rev_slider fullwidthabanner" id="rev_slider_one" data-version="5.4.1">    
        <ul>
        @foreach($banners as $banner)
          <li data-description="Slide Description" data-easein="default" data-easeout="default" data-fsmasterspeed="1500" data-fsslotamount="7" data-fstransition="fade" data-hideafterloop="0" data-hideslideonmobile="off" data-index="rs-1687" data-masterspeed="default" data-param1="" data-param10="" data-param2="" data-param3="" data-param4="" data-param5="" data-param6="" data-param7="" data-param8="" data-param9="" data-rotate="0" data-saveperformance="off" data-slotamount="default" data-thumb="{{URL::asset('uploads/banner/'. $banner->image) }}" data-title="Slide Title" data-transition="3dcurtain-vertical"> <img alt="" class="rev-slidebg" data-bgfit="cover" data-bgparallax="10" data-bgposition="center center" data-bgrepeat="no-repeat" data-no-retina="" src="{{URL::asset('uploads/banner/'. $banner->image) }}">
            <div class="tp-caption" 
                    data-paddingbottom="[0,0,0,0]"
                    data-paddingleft="[0,0,0,0]"
                    data-paddingright="[0,0,0,0]"
                    data-paddingtop="[0,0,0,0]"
                    data-responsive_offset="on"
                    data-type="text"
                    data-height="none"
                    data-width="['550','650','550','420']"
                    data-whitespace="normal"
                    data-hoffset="['15','15','15','15']"
                    data-voffset="['-100','-100','-100','-85']"
                    data-x="['left','left','left','left']"
                    data-y="['middle','middle','middle','middle']"
                    data-textalign="['top','top','top','top']"
                    data-frames='[{"from":"y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;","mask":"x:0px;y:0px;s:inherit;e:inherit;","speed":1500,"to":"o:1;","delay":1000,"ease":"Power3.easeInOut"},{"delay":"wait","speed":1000,"to":"auto:auto;","mask":"x:0;y:0;s:inherit;e:inherit;","ease":"Power3.easeInOut"}]'
                    style="z-index: 7; white-space: nowrap;text-transform:left;">
              <h2>{{$banner->title}}</h2>
            </div>
            <div class="tp-caption" 
                    data-paddingbottom="[0,0,0,0]"
                    data-paddingleft="[0,0,0,0]"
                    data-paddingright="[0,0,0,0]"
                    data-paddingtop="[0,0,0,0]"
                    data-responsive_offset="on"
                    data-type="text"
                    data-height="none"
                    data-width="['550','650','550','420']"
                    data-whitespace="normal"
                    data-hoffset="['15','15','15','15']"
                    data-voffset="['40','35','25','10']"
                    data-x="['left','left','left','left']"
                    data-y="['middle','middle','middle','middle']"
                    data-textalign="['top','top','top','top']"
                    data-frames='[{"from":"y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;","mask":"x:0px;y:0px;s:inherit;e:inherit;","speed":1500,"to":"o:1;","delay":1000,"ease":"Power3.easeInOut"},{"delay":"wait","speed":1000,"to":"auto:auto;","mask":"x:0;y:0;s:inherit;e:inherit;","ease":"Power3.easeInOut"}]'
                    style="z-index: 7; white-space: nowrap;text-transform:left;">
              <div class="text">{{$banner->sub_title}}</div>
            </div>
            <div class="tp-caption tp-resizeme" 
                    data-paddingbottom="[0,0,0,0]"
                    data-paddingleft="[0,0,0,0]"
                    data-paddingright="[0,0,0,0]"
                    data-paddingtop="[0,0,0,0]"
                    data-responsive_offset="on"
                    data-type="text"
                    data-height="none"
                    data-width="['550','650','550','420']"
                    data-whitespace="normal"
                    data-hoffset="['15','15','15','15']"
                    data-voffset="['135','130','130','110']"
                    data-x="['left','left','left','left']"
                    data-y="['middle','middle','middle','middle']"
                    data-textalign="['top','top','top','top']"
                    data-frames='[{"from":"y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;","mask":"x:0px;y:0px;s:inherit;e:inherit;","speed":1500,"to":"o:1;","delay":1000,"ease":"Power3.easeInOut"},{"delay":"wait","speed":1000,"to":"auto:auto;","mask":"x:0;y:0;s:inherit;e:inherit;","ease":"Power3.easeInOut"}]'
                    style="z-index: 7; white-space: nowrap;text-transform:left;"> <a href="" class="theme-btn btn-style-one">Read More</a>
            </div>
          </li>
           @endforeach
         </ul>
      </div>
    </div>     
  </section>
  <!--End Main Slider--> 
  
  <!-- welcome section -->
  <section class="welcome-section">
    <div class="auto-container">
      <div class="top-title">
         <?php $welcome = App\Classes\Helper::getWelcome(); ?>
        <div class="row clearfix">
           @foreach($welcome as $w)
          <div class="col-md-5 col-sm-5 col-xs-12"> 
            <h2><span style="font-weight:300">{!!$w->heading!!}</h2>
          </div>
          <div class="col-md-7 col-sm-7 col-xs-12">
            <div class="text">
              <p>{!!$w->description!!}</p>
            </div>
          </div>
        </div>
        @endforeach
      </div>
      
     <div class="row clearfix">
        <div class="col-md-6 col-sm-12">
          <div class="welcome-item">
            <?php $abtimg = App\Classes\Helper::getAbtusImg(); ?> 
            <div class="img-box"> 
              @foreach($abtimg as $abt)
              <img src="{{URL::asset('uploads/media/'. $abt->file_name)}}" alt="">
              @endforeach
            </div>
             <?php $abtus = App\Classes\Helper::getAbtus(); ?> 
            <div class="content">
              @foreach($abtus as $ab)
              <h3>{{$ab->heading}}</h3>
               <div class="text">
                {{ str_limit(strip_tags($ab->description), 120) }}
                 @if (strlen(strip_tags($ab->description)) > 120)
                      <a href="{{'about-us-1'}}" class="widget_text">Read More</a>
                    @endif
              </div>
              @endforeach
            </div>
          </div>
        </div>
        <div class="col-md-6 col-sm-12">
          <div class="welcome-item display-table">
              <?php $visionimg = App\Classes\Helper::getVisionImg(); ?> {{--helper to get the value from bd media , main part generatde in the App\Classes\Helper  in getVisionImg --}}
            <div class="img-box"> 
              @foreach($visionimg as $vi)
              <img src="{{URL::asset('uploads/media/'. $vi->file_name)}}" alt="">
              @endforeach 
            </div>
            <div class="content">
              <?php $vision = App\Classes\Helper::getVision(); ?> 
              @foreach($vision as $v)
              <h3>{{$v->heading}}</h3>
              <div class="text">
                <p> {!!$v->description!!}</p>
              </div>
              @endforeach
            </div>
          </div>
          <div class="welcome-item display-table">
              <?php $missionimg= App\Classes\Helper::getMissionImg(); ?> 
            <div class="img-box"> 
              @foreach($missionimg as $mi)
              <img src="{{URL::asset('uploads/media/'. $mi->file_name)}}" alt="">
              @endforeach
               </div>
            <div class="content">
               <?php $mission= App\Classes\Helper::getMision(); ?> 
               @foreach($mission as $m)
              <h3>{{$m->heading}}</h3>
              <div class="text">
                <p>{!!$m->description!!}</p>
              </div>
              @endforeach
            </div>
          </div>
        </div>
      </div>
  </section>
  <!--Default Section-->
  <section class="default-section jobcategories">
    <div class="auto-container"> 
      <!--Sec Title-->
      <div class="sec-title">
        <h2>Job Categories</h2>
        <div class="separater"></div>
      </div>
      <div class="row clearfix"> 
        
        <!--News Column--> 
        @foreach($news as $n)
        <div class="news-column col-md-4 col-sm-6 col-xs-12"> 
          
          <!--News Block-->
          <div class="news-block"> 
            <!--Image Column-->
            <div class="image-column">
              <div class="image"> <a href=""><img src="{{URL::asset('uploads/news/'. $n->image) }}" alt="" /></a> </div>
            </div>
            <!--Content Column-->
            <div class="content-column">
              <div class="content-inner">
                <h3><a href="{{$n->slug}}">{{$n->title}}</a></h3>
              </div>
              <div class="text">{{$n->description}}</div>
               </div>
               <a href="{{$n->slug}}" class="widget_text">Read More</a>
          </div>
        </div>
        @endforeach  
      </div>
    </div>
  </section>
  <!--End Default Section-->
  <section class="feature-section clearfix">

    <div class="left-column float_left"></div>
    <!-- End Left column -->
    <div class="right-column float_right">
      <?php $education = App\Classes\Helper::getEducation(); ?>
      <div class="feature-deatails"> 
        <!--Sec Title-->
          @foreach( $education as $e)
        <div class="sec-title light">
          <h2>{{$e->heading}}</h2>
          <div class="separater"></div>
        </div>
         <h4>{{$e->short_description}}</h4>
        <p>{{-- <i class=" fa fa-angle-right ">&nbsp;  --}}
          {{ str_limit(strip_tags($e->description), 300)}}
             @if (strlen(strip_tags($e->description)) > 300)    
        </p>
         <br>
          <a href="{{'education-training-1'}}" class="theme-btn btn-style-one"">Read More</a>
          @endif
         @endforeach </div>
       
    </div>
    <!-- End right column --> 
  </section>
  
  <!--Start Testimonial area-->
  <section class="testimonial-area">
    <div class="auto-container"> 
      <!--Sec Title-->
      <div class="sec-title centered">
        <h2>Testimonials</h2>
        <div class="separater"></div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="three-item-carousel owl-carousel owl-theme"> 
            <!--Start single item-->
            @foreach($testimonials as $testimonial)
            <div class="single-item">
              <div class="client-info">
                <div class="img-box"> <img src="{{URL::asset('uploads/testimonials/'. $testimonial->image) }}"  alt="Awesome Image" > </div>
                <div class="text-holder">
                  <h3>{{$testimonial->name}}</h3>
                  <span>{{$testimonial->company_name}}</span>
                  <div class="review-box">  
                        <ul>
                          <li class="userrate{{$testimonial->id}}">
                          </li> 
                        </ul> 
                        <script type="text/javascript">
                              $(document).ready(function(){
                               //below line will  give the image of star from the provided location
                              $.fn.raty.defaults.path ="{{asset('frontend/images/rate')}}";
                              $('.userrate{{$testimonial->id}}').raty({
                                  score:'{{$testimonial->rating}}'   
                                 });
                            }); 
                        </script>
                    {{--     {{$testimonial->rating}}--}}                  
                  </div>
                </div>
              </div>
              <div class="text-box">
                <p>{!!$testimonial->description!!}</p>
              </div>
            </div>
            @endforeach
          </div>
        </div>
      </div>
    </div>
  </section>
 <div class="sponsors-section">
    <div class="auto-container">
       
      <div class="carousel-outer"> 
        <!--Sponsors Slider-->
        <ul class="sponsors-carousel owl-carousel owl-theme">
             @foreach($albums as $album)
          <li>
            <div class="image-box"><a href="#"><img src="{{URL::asset('uploads/gallery/'. $album->image) }}"alt=""></a></div>
          </li>
          @endforeach
        </ul> 
      </div>
    </div>
  </div>
@endsection