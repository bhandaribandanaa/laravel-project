@extends('layout.frontend.app')
@section('title', 'News Category')
@section('footer_js')
    <script src="{{ asset('js/slider.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/jquery.fancybox.js') }}"></script>
    <script>
        $("#lightbox").on("click", "a.add", function(){
            var new_caption = prompt("Enter a new caption");
            if(new_caption){
                var parent_id = $(this).data("id"),
                    img_title = $(parent_id).data("title"),
                    new_caption_tag = "<span class='caption'>" + new_caption + "</span>";

                $(parent_id).attr("data-title", img_title.replace(/<span class='caption'>.*<\/span>/, new_caption_tag));
                $(this).next().next().text(new_caption);

                // Make an AJAX request to save the data to the database
            }
        });
    </script>
@stop
@section('main')

    <!--Page header & Title-->
    <section id="page_header" class="page_header_small">
        <div class="page_title">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h2 class="title">Company Document</h2>
                        <div class="page_link"><a href="#">Home</a><i class="fa fa-long-arrow-right"></i><span>Company Document</span></div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section id="gallery" class="padding-top">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                   
                </div>
            </div>
            <div class="row">
                <div class="zerogrid">
                    <div class="wrap-container">
                        <div class="wrap-content clearfix">
                            {{--*/$i=1/*--}}
                            @forelse($images as $gal)
                                <div class="col-xs-12 col-sm-6 col-md-3 ">
                                    <div class="wrap-col">
                                        <div class="item-container">
                                            <div class="image">
                                                <a href="{{ asset('uploads/companydocument/'.$gal->image) }}"
                                                   data-lightbox="gallery-{{$i}}" id="{{$i}}">
                                                    <img src="{{ asset('uploads/companydocument/'.$gal->image) }}">
                                                </a>
                                            </div>
                                            <div class="gallery_content">

                                                <p>{{ Helpers::string_limit($gal->description,80) }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                No news added.
                            @endforelse

                            <div align="center">
                                {!! $images->render() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop