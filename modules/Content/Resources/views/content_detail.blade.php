@extends('layout.frontend.app')
@section('title', $content->page_title)
@section('header_js')
@stop
@section('main')

<!--Page header & Title-->
<section id="page_header">
<div class="page_title">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
         <h2 class="title">{{ $content->page_title }}</h2>
         <div class="page_link"><a href="{{ route('home') }}">Home</a><i class="fa fa-long-arrow-right"></i><span>{{ $content->page_title }}</span></div>
      </div>
    </div>
  </div>
</div>  
</section>


<section class="padding">
  <div class="container">
    <div class="row">

    
      {!! $content->description !!}
    </div>
  </div>
</section>

    
@stop