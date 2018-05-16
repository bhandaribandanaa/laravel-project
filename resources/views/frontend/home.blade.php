@extends('layout.frontend.app')
@section('title', 'Home')
@section('header_js')
@stop
@section('main')
    <!-- REVOLUTION SLIDER -->          

    <div id="rev_slider_34_1_wrapper" class="rev_slider_wrapper fullwidthbanner-container" data-alias="news-gallery34" style="margin:0px auto;background-color:#ffffff;padding:0px;margin-top:0px;margin-bottom:0px;">
        <!-- START REVOLUTION SLIDER 5.0.7 fullwidth mode -->
        <div id="rev_slider_34_1" class="rev_slider fullwidthabanner" style="display:none;" data-version="5.0.7">
            <ul>    <!-- SLIDE  -->
            {{--*/$i=129/*--}}
            @forelse($sliders as $slider)

                <li data-index="rs-{{ $i++ }}" data-transition="fade" data-slotamount="default" data-rotate="0"  data-fstransition="fade" data-fsmasterspeed="500" data-fsslotamount="7"  data-title="{{ $slider->title }}" data-description="{{ $slider->sub_title }}">
                    <!-- MAIN IMAGE -->
                    @if($slider->url != "")
                        <a href="{{ $slider->url }}"><img src="{{ asset('uploads/banner/'.$slider->image) }}"  alt=""  data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat" class="rev-slidebg" data-no-retina></a>
                    @else
                        <img src="{{ asset('uploads/banner/'.$slider->image) }}"  alt=""  data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat" class="rev-slidebg" data-no-retina>
                    @endif
                    <!-- LAYER NR. 2 -->
                    
                    </h1>
                    <!-- LAYER NR. 2 -->
                    
                </li>


            @empty

            @endforelse             
                    <!-- SLIDE  -->
            </ul>
        </div>
    </div>
    <!-- END REVOLUTION SLIDER -->

    <!--Features Section-->
    <section class="feature_wrap padding-half">
      <div class="container">
        <div class="row">
         <div class="col-md-12"><h2 class="heading">Our Services</h2><hr class="heading_space"></div>
            {{--*/ $services = Helpers::getServices() /*--}}
            @foreach($services as $service)
              <div class="col-md-4 col-sm-4 feature text-center">
                  <a href="{{ route('services') }}"><i class="{{ $service->icon }}"></i></a>
                <h3><a href="{{ route('services') }}">{{ $service->title }}</a></h3>
                <p>{!! Helpers::string_limit($service->description,200) !!}</p>
              </div>
            @endforeach
            <div class="pull-right"><a class="btn btn-primary" href="{{ route('services') }}">View More</a></div>

        </div>
      </div>
    </section>


    <section class="padding-bottom">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <h2 class="heading">Why Choose Us ?</h2>
            <hr class="heading_space">
          </div>
          <div class="col-md-6">
          <div class="faq_wrapper">
            <ul class="items">

            {{--*/$i=1/*--}}
              @forelse($choose as $ch)
                <li>
                  <a data-toggle="collapse" class="collapsed" data-parent="#accordion" href="#collapse{{ $i }}">{{ $ch->title }}</a>
                  <div id="collapse{{ $i }}" @if($i==1) class="expanded" @else class="panel-collapse collapse" @endif>
                          <div class="panel-body">
                              {{ $ch->subtitle }}
                          </div>
                  </div>
                </li>
                {{--*/$i++/*--}}
              @empty

              @endforelse
              
            </ul>
          </div>
          </div>
          <div class="col-md-6 index2_grid">
            <img src="images/whychooseus.jpg" alt="" />
            
          </div>
        </div>
      </div>
    </section>

   <!-- image with content -->
    <section class="info_section">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-6 col-sm-4">
          </div>
          <div class="col-md-6 col-sm-8 right_box">
            <div class="right_box_inner padding clearfix">
                     <h2 class="heading">Working Hours</h2>
            <hr class="heading_space">
            <ul class="hours_wigdet">
              <li>Monday<span>07:00-19:00</span></li>
              <li>Tuesday<span>07:00-19:00</span></li>
              <li>Wednesday<span>07:00-19:00</span></li>
              <li>Thursday<span>07:00-19:00</span></li>
              <li>Friday<span>07:00-19:00</span></li>
              <li>Saturday<span>08:00-12:00</span></li>
              <li>Sunday<span>07:00-19:00</span></li>
            </ul>
             
             
             
            </div>
          </div>
        </div>
      </div>
    </section>

<!-- Specialists -->
    <section id="specialists" class="bg_grey padding">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
          <h2 class="heading">Meet Our Specialists</h2>
          <hr class="heading_space">
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="specialists_wrap_slider">
              <div id="our-specialist" class="owl-carousel">
                {{--*/$doctors = Helpers::getDoctors()/*--}}

                  @forelse($doctors as $doc)
                      <div class="item">
                          <label>
                              
                                  <div class="specialist_wrap">
                                    
                                      <a class="specialist_wrap_hover" href="{{ route('doctors.appointment',[$doc->slug]) }}">@if($doc->image)
                                              <img src="{{ asset('uploads/doctors/'.$doc->image) }}" alt="Doctor">
                                          @else
                                              <img src="{{ asset('images/doc.jpg') }}" alt="Doctor">
                                          @endif
                                      </a>
                                      
                                      <h3>Dr. {{ $doc->full_name }}</h3>
                                      <small>{{ $doc->specialization }}</small><br/>
                                        <a class="btn-readmore" href="{{ route('doctors.appointment',[$doc->slug]) }}">Book an appointment</a>
                                  </div>
                                
                              
                          </label>
                      </div>
                  @empty
                        No doctors found.
                  @endforelse

              </div>
            </div>
          </div>
        </div>
      </div>
    </section>


    <!-- testinomial -->
    {{--<section id="testinomial" class="padding">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
           <h2 class="heading">Testimonials</h2> <hr class="heading_space">
          <div id="testinomial-slider" class="owl-carousel text-center">
            <div class="item">
              <h3>Claritas est etiam processus dynamicus, qui sequitur mutationem consuetudium lectorum. Mirum est notare quam littera gothica, quam nunc putamus parum claram.</h3>
              <p>Rodney Stratton, <span>Heart Patient</span></p>
            </div>
            <div class="item">
              <h3>Claritas est etiam processus dynamicus, qui sequitur mutationem consuetudium lectorum. quam nunc putamus parum claram, Mirum est notare quam littera gothica.</h3>
              <p>Rodney Robert, <span>Kidney Patient</span></p>
            </div>
            <div class="item">
              <h3>Claritas est etiam processus dynamicus, qui sequitur mutationem consuetudium lectorum. Mirum est Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse.</h3>
              <p>Rodney Alzbeth, <span>Liver Patient</span></p>
            </div>
           </div>
          </div>
        </div>
      </div>
    </section>--}}
@stop
