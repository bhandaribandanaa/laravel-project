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
                   <?php $unskilled= App\Classes\Helper::getUnskilledImg(); ?>
                    @foreach($unskilled as $us)
                  <img src="{{URL::asset('uploads/media/'. $us->file_name)}}" alt="">
                  @endforeach
                <div class="lower-box">
                  <div class="text">
                    <?php $unskilled= App\Classes\Helper::getUnskilled(); ?>
                     @foreach($unskilled as $un)   
                      {!!$un->description!!}
                      @endforeach
                </div>
              </div>
            </div>

          </div>
        </div>

          </div>
        </div>
        
        <!--Sidebar-->
        
            
            <!--Category Widget-->
             <div class="sidebar-side col-lg-4 col-md-4 col-sm-12 col-xs-12">
          <aside class="sidebar"> 
            
            <!--Category Widget-->
        
          </aside>
        </div>
       
          </aside>
        </div>
        <!--End Sidebar--> 
        
      </div>
    </div>
  </div>
  <!--End About Section--> 
  
@endsection
  