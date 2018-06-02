@extends('layout.frontend.app')
@section('title', 'Gallery')
@section('footer_js')

    <script type="text/javascript">
        $(document).ready(function () {
            $('#lightgallery').lightGallery();
        });
    </script>
    <script src="https://cdn.jsdelivr.net/picturefill/2.3.1/picturefill.min.js"></script>
    {!! Html::script('js/lightgallery.js') !!}
    {!! Html::script('js/lg-fullscreen.js') !!}
    {!! Html::script('js/lg-thumbnail.js') !!}
    {!! Html::script('js/lg-video.js') !!}
    {!! Html::script('js/lg-autoplay.js') !!}
    {!! Html::script('js/lg-zoom.js') !!}
    {!! Html::script('js/lg-hash.js') !!}
    {!! Html::script('js/lg-pager.js') !!}
    {!! Html::script('js/jquery.mousewheel.min.js') !!}


@stop
@section('header_css')

    {!! Html::style('css/lightgallery.css') !!}
    <style type="text/css">

        .demo-gallery > ul {
            margin-bottom: 0;
        }

        .demo-gallery > ul > li {
            float: left;
            margin-bottom: 15px;
            margin-right: 20px;
            width: 200px;
        }

        .demo-gallery > ul > li a {
            border: 3px solid #FFF;
            border-radius: 3px;
            display: block;
            overflow: hidden;
            position: relative;
            float: left;
        }

        .demo-gallery > ul > li a > img {
            -webkit-transition: -webkit-transform 0.15s ease 0s;
            -moz-transition: -moz-transform 0.15s ease 0s;
            -o-transition: -o-transform 0.15s ease 0s;
            transition: transform 0.15s ease 0s;
            -webkit-transform: scale3d(1, 1, 1);
            transform: scale3d(1, 1, 1);
            height: 120px;
            width: 100%;
        }

        .demo-gallery > ul > li a:hover > img {
            -webkit-transform: scale3d(1.1, 1.1, 1.1);
            transform: scale3d(1.1, 1.1, 1.1);
        }

        .demo-gallery > ul > li a:hover .demo-gallery-poster > img {
            opacity: 1;
        }

        .demo-gallery > ul > li a .demo-gallery-poster {
            background-color: rgba(0, 0, 0, 0.1);
            bottom: 0;
            left: 0;
            position: absolute;
            right: 0;
            top: 0;
            -webkit-transition: background-color 0.15s ease 0s;
            -o-transition: background-color 0.15s ease 0s;
            transition: background-color 0.15s ease 0s;
        }

        .demo-gallery > ul > li a .demo-gallery-poster > img {
            left: 50%;
            margin-left: -10px;
            margin-top: -10px;
            opacity: 0;
            position: absolute;
            top: 50%;
            -webkit-transition: opacity 0.3s ease 0s;
            -o-transition: opacity 0.3s ease 0s;
            transition: opacity 0.3s ease 0s;
        }

        .demo-gallery > ul > li a:hover .demo-gallery-poster {
            background-color: rgba(0, 0, 0, 0.5);
        }

        .demo-gallery .justified-gallery > a > img {
            -webkit-transition: -webkit-transform 0.15s ease 0s;
            -moz-transition: -moz-transform 0.15s ease 0s;
            -o-transition: -o-transform 0.15s ease 0s;
            transition: transform 0.15s ease 0s;
            -webkit-transform: scale3d(1, 1, 1);
            transform: scale3d(1, 1, 1);
            height: 150px;
            width: 100%;
        }

        .demo-gallery .justified-gallery > a:hover > img {
            -webkit-transform: scale3d(1.1, 1.1, 1.1);
            transform: scale3d(1.1, 1.1, 1.1);
        }

        .demo-gallery .justified-gallery > a:hover .demo-gallery-poster > img {
            opacity: 1;
        }

        .demo-gallery .justified-gallery > a .demo-gallery-poster {
            background-color: rgba(0, 0, 0, 0.1);
            bottom: 0;
            left: 0;
            position: absolute;
            right: 0;
            top: 0;
            -webkit-transition: background-color 0.15s ease 0s;
            -o-transition: background-color 0.15s ease 0s;
            transition: background-color 0.15s ease 0s;
        }

        .demo-gallery .justified-gallery > a .demo-gallery-poster > img {
            left: 50%;
            margin-left: -10px;
            margin-top: -10px;
            opacity: 0;
            position: absolute;
            top: 50%;
            -webkit-transition: opacity 0.3s ease 0s;
            -o-transition: opacity 0.3s ease 0s;
            transition: opacity 0.3s ease 0s;
        }

        .demo-gallery .justified-gallery > a:hover .demo-gallery-poster {
            background-color: rgba(0, 0, 0, 0.5);
        }

        .demo-gallery .video .demo-gallery-poster img {
            height: 48px;
            margin-left: -24px;
            margin-top: -24px;
            opacity: 0.8;
            width: 48px;
        }

        .demo-gallery.dark > ul > li a {
            border: 3px solid #04070a;
        }

        .home .demo-gallery {
            padding-bottom: 80px;
        }
    </style>
@stop
@section('main')
    <div class="container">
        <div class="row">
            <div class="col l12 col m12 col s12">
                <div class="title">{{ $album->name }}</div>
                <div class="demo-gallery" >
                    <!--<ul id="lightgallery" class="list-unstyled row ">-->
                    <div class="row gal_block" id="lightgallery">

                        @foreach($album->images as $image)

                            @if(!empty($image->image) && file_exists('uploads/gallery/'. $image->image))


                                <div class="col l3 col m3 col s6 gal_block_single" data-responsive=""
                                    data-src="{{ URL::asset('uploads/gallery/'. $image->image) }}" data-sub-html="">
                                    <a href="">
                                        <img class="img-responsive"
                                             src="{{ URL::asset('uploads/gallery/'. $image->image) }}">
                                    </a>
                                </div>

                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
            
        </div>
    </div>
@stop