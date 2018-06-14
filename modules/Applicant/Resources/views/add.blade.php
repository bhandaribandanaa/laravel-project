@extends('layout.frontend.app')
@section('content')

    <div id="featured-title" class="clearfix featured-title-left">
    <div id="featured-title-inner" class="container clearfix">
        <div class="featured-title-inner-wrap">
            <div class="featured-title-heading-wrap">
                <h1 class="featured-title-heading">Apply Online </h1>
            </div>
            <div id="breadcrumbs">
                <div class="breadcrumbs-inner">
                    <div class="breadcrumb-trail">
                        <a href="#" title="Construction" rel="home" class="trail-begin">Home</a>
                        <span class="sep">/</span>
                        <span class="trail-end">Apply Online </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="clear"></div>
 @if(Session::has('add_success'))
<p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('add_success') }}</p>
@endif

<!-- Main Content -->
<div id="main-content" class="site-main clearfix">
    <div id="content-wrap">
        <div id="site-content" class="site-content clearfix">
            <div id="inner-content" class="inner-content-wrap">
                <div class="page-content">

<div class="wprt-spacer" data-desktop="70" data-mobi="60" data-smobi="60"></div>
                    <section class="wprt-section">
                        <div class="container">
                            <div class="row">
                              

                                    <form action="{{ route('applicants.addSubmit') }}" method="post" class="contact-form wpcf7-form">
                                        <div class="col-md-12">
                                            <div class="wprt-contact-form-1">
                                                <span class="wpcf7-form-control-wrap name">
                                                <input type="text" tabindex="1" id="name" name="name" value="" class="wpcf7-form-control" placeholder="Name *" required>
                                                </span>
                                                @if($errors->has('name'))
                                                <div class="alert alert-danger fade in">
                                                    <button type="button" class="close close-sm" data-dismiss="alert">
                                                    <i class="fa fa-times"></i>
                                                    </button>
                                                    <strong>Warning!</strong> {{ $errors->first('name') }}.
                                                </div>
                                                @endif
                                                <span class="wpcf7-form-control-wrap name">
                                                <input type="text" tabindex="1" id="address" name="address" value="" class="wpcf7-form-control" placeholder="Address *" required>
                                                </span>
                                                @if($errors->has('address'))
                                                <div class="alert alert-danger fade in">
                                                    <button type="button" class="close close-sm" data-dismiss="alert">
                                                    <i class="fa fa-times"></i>
                                                    </button>
                                                    <strong>Warning!</strong> {{ $errors->first('address') }}.
                                                </div>
                                                @endif
                                                <span class="wpcf7-form-control-wrap email">
                                                <input type="email" tabindex="2" id="email" name="email" value="" class="wpcf7-form-control" placeholder="E-mail *" required>
                                                </span>
                                                @if($errors->has('email'))
                                                <div class="alert alert-danger fade in">
                                                    <button type="button" class="close close-sm" data-dismiss="alert">
                                                    <i class="fa fa-times"></i>
                                                    </button>
                                                    <strong>Warning!</strong> {{ $errors->first('email') }}.
                                                </div>
                                                @endif
                                                <span class="wpcf7-form-control-wrap phone">
                                                <input type="text" tabindex="3" id="phone" name="phone" value="" class="wpcf7-form-control" placeholder="Phone Number">
                                                </span>
                                                @if($errors->has('phone'))
                                                <div class="alert alert-danger fade in">
                                                    <button type="button" class="close close-sm" data-dismiss="alert">
                                                    <i class="fa fa-times"></i>
                                                    </button>
                                                    <strong>Warning!</strong> {{ $errors->first('phone') }}.
                                                </div>
                                                @endif
                                                <input type="hidden" name="id" value="{{ $id }}">
                                                {!! csrf_field() !!}
                                            </div>
                                        </div>
                                        <!-- /.col-md-8 -->
                                        <div class="row">
                                            <div class="wrap-submit pull-right">
                                                <input type="submit" value="SEND MESSAGE" class="submit wpcf7-form-control wpcf7-submit" id="submit" name="submit">
                                            </div>
                                        </div>
                                    </form>
       
     
                            </div><!-- /.row -->
                        </div><!-- /.container -->
                    </section>


        
        <div class="wprt-spacer" data-desktop="70" data-mobi="60" data-smobi="60"></div>
                         
                                    
                                    
                                    
                       @if(Session::has('message'))
<p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
@endif   

                    
                </div><!-- /.page-content -->
            </div>
        </div>
    </div>
</div>

         
@endsection

       