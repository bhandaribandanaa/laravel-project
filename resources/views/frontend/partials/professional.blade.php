@extends('frontend.layouts.app')
@section('cat_detail')
  <!--About Section-->
  <div class="sidebar-page-container blog-page">
    <div class="auto-container">
      <div class="row clearfix"> 
        
        <!--Content Side-->
        <div class="content-side col-lg-8 col-md-8 col-sm-12 col-xs-12"> 
          <!--Our-Blogs-->
          <div class="blogs-detail"> 
            
            <!--News Block Two-->
          <div class="news-block-two">
              <div class="inner-box">
                <div class="image"> 
                   <?php $professional= App\Classes\Helper::getProfessionalImg(); ?>
                    @foreach($professional as $p)
                  <img src="{{URL::asset('uploads/media/'. $p->file_name)}}" alt="">
                  @endforeach
                <div class="lower-box">
                  <div class="text">
                    <?php $professional= App\Classes\Helper::getProfessional(); ?>
                     @foreach($professional as $p)   
                      {!!$p->description!!}
                      @endforeach
                </div>
              </div>
            </div>

          </div>
        </div>
        
        <!--Sidebar--> 
        
        <!--End Sidebar--> 
        
      </div>
    </div>
  </div>
  <!--End About Section--> 
  
@endsection
  