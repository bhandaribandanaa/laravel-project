@extends('frontend.layouts.app')
@section('cat_detail')
  <!--About Section-->
  <div class="sidebar-page-container blog-page">
     <div class="auto-container">
      <div class="row clearfix">  
          <div class="about-column col-md-6 col-sm-12 col-xs-12">
                     <?php $message= App\Classes\Helper::getMessage(); ?>
                    <div class="text">
                              @foreach($message as $m)   
                              {!! $m->description !!}
                              @endforeach
                    </div>      
          </div>

                <!--image Column-->
                  <div class="chart-column col-md-6 col-sm-12 col-xs-12">
                    <?php $getMessageImg= App\Classes\Helper:: getMessageImg(); ?>
                    <div class="inner-box">
                        <div class="image">
                              @foreach($getMessageImg as $mi)   
                              <img src="{{URL::asset('uploads/media/'. $mi->file_name)}}"  width="250" height="250"  alt="">
                              @endforeach
                        </div>
                    </div>
                  </div>  
      </div>
    </div>
  </div>
  <!--End About Section--> 
  
@endsection
  