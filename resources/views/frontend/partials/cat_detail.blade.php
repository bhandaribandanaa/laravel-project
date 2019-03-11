@extends('frontend.layouts.app')
@section('cat_detail')
  <!--Page Title-->
  <section class="page-title" style="background-image:url({{asset('frontend/images/background/3.jpg')}});">
    <div class="auto-container">
      <div class="title-box">
        <h2>Skilled Labor</h2>
        <ul>
          <li><a href="index.html">Home</a></li>
          <li>Skilled Labor</li>
        </ul>
      </div>
    </div>
  </section>
  <!--End Page Title--> 
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
              <?php $contact = App\Classes\Helper::getContact(); ?>
              <div class="inner-box">
                  @foreach($contact as $c)
              <div class="lower-box"> 
                  <div class="text">
                      {!!$c->description!!}
                  </div>     
                </div>
                @endforeach
              </div>
            </div>

          </div>
        </div> 
            <!--Category Widget-->
             <div class="sidebar-side col-lg-4 col-md-4 col-sm-12 col-xs-12">
          <aside class="sidebar"> 
            
            <!--Category Widget-->
            <div class="sidebar-widget sidebar-blog-category">
              <div class="sidebar-title">
                <h2>Job Categories</h2>
              </div>
                <?php $category = App\Classes\Helper::getCategory(); ?>
              <ul class="category">
                @foreach($category as $c)
                <li><a href="#">{{$c->page_title}}</a></li>
                @endforeach
              </ul>
            </div>
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
  