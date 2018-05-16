@extends('layout.frontend.app')
@section('title', 'Gallery')
@section('header_css')
    <style>
        .news.vertical {
            min-height: 320px;
        }
    </style>
@stop
@section('main')
    <div class="container">
        <div class="row">
            <div class="col l12 col m12 col s12">
                <div class="title">Gallery</div>
                @if(count($albums)>0)

                    @foreach($albums as $album)
                        @if(count($album->images)>0 )
                            <div class="col l3 col m3 col s6">
                                <div class="news vertical z-depth-1" style="min-height: 250px !important;">
                                    <div class="news-image">
                                        <a href="{{ route('gallery.view',array($album->id)) }}">

                                            @if($album->images && file_exists('uploads/gallery/'. $album->images[0]->image))
                                                <img src="{{URL::asset('uploads/gallery/'. $album->images[0]->image) }}"
                                                     class="responsive-img">
                                            @else
                                                <img src="{{ asset('images/no-photo.jpg' ) }}" class="responsive-img">
                                            @endif
                                        </a>

                                    </div>
                                    <div class="news-description">
                                        <div class="news-title"><a
                                                    href="{{ route('gallery.view',array($album->id)) }}">{{ $album->name }}</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach

                @else


                    <p>No Gallery Added yet.</p>
                @endif

                <div class="col m12 mgt20">
                    @include('partial.pagination', ['paginator' => $albums])
                </div>

            </div>
            
        </div>
    </div>
@stop