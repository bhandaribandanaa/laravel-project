@extends('layout.frontend.app')
@section('title', 'News Category')
@section('header_js')
@stop
@section('main')

    <!--Page header & Title-->
    <section id="page_header" class="page_header_small">
        <div class="page_title">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h2 class="title">News Category </h2>
                        <div class="page_link"><a href="#">Home</a><i class="fa fa-long-arrow-right"></i><span>News Category</span></div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section id="gallery" class="padding-top">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="work-filter">
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="row">
                    <div class="zerogrid">
                        <div class="wrap-container">
                            <div class="wrap-content clearfix">
                                @forelse($all_news as $news)
                                    <div class="col-md-6 col-xs-12 col-sm-12 work-item">
                                        <div class="wrap-col">
                                            <div class="item-container">
                                                <div class="image">
                                                    <a  href="{{ route('news.detail',$news->slug) }}"><img src="{{ asset('uploads/news/'.$news->image) }}" alt="work"/></a>

                                                </div>
                                                <div class="gallery_content text-left">
                                                    <a class="newstitle" href="{{ route('news.detail',$news->slug) }}">{{ $news->title }}</a>

                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    No news added.
                                @endforelse

                                <div align="center">
                                    {!! $all_news->render() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
             <h3 class="heading">Categories</h3>

                <ul class="catlsting">
                    @forelse($category as $cat)
                        <li><a href="{{ route('news.category',[$cat->slug]) }}">{{ $cat->category }}</a></li>
                    @empty
                        <li><a href="#">No Categories Present</a></li>
                    @endforelse
                </ul>
            </div>

        </div>
    </section>
@stop