@extends('layout.frontend.app')
@section('content')


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
                        <div class="wrap-content clearfix">
                            {{--*/$i=1/*--}}
                            @foreach($data as $gal)
                                <div class="col-xs-12 col-sm-6 col-md-3 ">
                                    <div class="wrap-col">
                                        <div class="item-container">
                                            <div class="image">
                                                <a href="{{ asset('uploads/companydocument/'.$gal->image) }}"
                                                   data-lightbox="companydocument-{{$i}}" id="{{$i}}">
                                                    <img src="{{ asset('uploads/companydocument/'.$gal->image) }}">
                                                </a>
                                            </div>
                                           
                                        </div>
                                    </div>
                                </div>
                             @endforeach
                        </div>
                    </div>
                        <div class="col-md-12">
                           <div class="wprt-spacer" data-desktop="80" data-mobi="60" data-smobi="60"></div>
                        </div>
                        <!-- /.col-md-12 -->
                     </div>
                     <!-- /.row -->
                  
                  <!-- /.container -->
               </section>
            </div>
            <!-- /.page-content -->
         </div>
      </div>
   </div>
</div>
@endsection


