
@extends('layout.frontend.app')
@section('content')


<div id="featured-title" class="clearfix featured-title-left">
    <div id="featured-title-inner" class="container clearfix">
        <div class="featured-title-inner-wrap">
            <div class="featured-title-heading-wrap">
                <h1 class="featured-title-heading">Apply Online</h1>
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

<div class="col-md-8">
<h4 class="margin-bottom-15">Apply</h4>
<form action="{{ route('applicants.addSubmit') }}" method="post" class="contact-form wpcf7-form">
   <div class="wprt-contact-form-1">
      <div>
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
      </div>
      <div>
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
      </div>
      <div>
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
      </div>
      <div>
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
      </div>
      <div>
         <input type="hidden" name="id" value="{{ $id }}"
         <{!! csrf_field() !!}
         <div class="col-sm-4">
            <button type="submit" class="btn btn-primary btn-sm m-t-5">Sumbit</button>
         </div>
      </div>
</form>

         
</div>
@endsection