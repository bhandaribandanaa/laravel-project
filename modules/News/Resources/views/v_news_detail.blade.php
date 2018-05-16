@extends('layout.frontend.app')
@section('title', 'News Category')
@section('header_js')
@stop
@section('main')



    <section id="page_header">
        <div class="page_title">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h2 class="title">News</h2>
                        <div class="page_link"><a href="#">Home</a><i class="fa fa-long-arrow-right"></i><span>News</span></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="padding">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="heading">{{ $news->title }}</h2>
                    <hr class="heading_space">
                </div>
                <div class="col-md-7 col-sm-6 department">
                    {!! $news->description !!}
                </div>
                <div class="col-md-5 col-sm-6">
                    @if($news->image != null)
                        <img class="img-responsive" src="{{ asset('uploads/news/'.$news->image) }}">
                    @endif
                </div>
            </div>
        </div>
    </section>


@stop