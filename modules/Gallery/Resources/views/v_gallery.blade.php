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
                        <h2 class="title">Gallery</h2>
                        <div class="page_link"><a href="#">Home</a><i class="fa fa-long-arrow-right"></i><span>Gallery</span></div>
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
            <div class="row">
                <div class="zerogrid">
                    <div class="wrap-container">
                        <div class="wrap-content clearfix">
                            @forelse($gallery as $gal)
                                <div class="col-1-3 work-item">
                                    <div class="wrap-col">
                                        <div class="item-container">
                                            <div class="image">
                                                @if($gal->cover_image != null)
                                                    <a href="{{ route('gallery.all',[$gal->id]) }}"><img src="{{ asset('uploads/gallery/'.$gal->cover_image) }}"/></a>
                                                @else
                                                    <a href="{{ route('gallery.all',[$gal->id]) }}""><img src="{{ asset('default_image.png') }}"/></a>
                                                @endif
                                            </div>
                                            <div class="gallery_content text-left">
                                                <a href="{{ route('gallery.all',[$gal->id]) }}"">{{ $gal->name }}</a>


                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                No news added.
                            @endforelse

                            <div align="center">
                                {!! $gallery->render() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop