@extends('layout.frontend.app')
@section('title', 'Video Download')
@section('footer_js')
    <link href="{{ asset('fancybox/jquery.fancybox.css?v=2.1.5') }}" rel="stylesheet">
    <script src="{{ asset('fancybox/jquery.fancybox.pack.js?v=2.1.5') }}"></script>
    <script src="{{ asset('fancybox/helpers/jquery.fancybox-media.js?v=1.0.6') }}"></script>
    <script>
        $(document).ready(function () {
            $(".fancybox-media").fancybox({
                helpers: {
                    media: {}
                }
            });
        });
    </script>
@stop
@section('main')

    <div class="container">
        <div class="row">
            <div class="col l9 col m12 col s12">
                <div class="blockquote z-depth-1">
                    <div class="breadcrumb"><a href="{{ route('home') }}">Home</a> <i class="fa fa-angle-right"></i>
                        Videos
                    </div>
                    <div class="title"> Videos</div>


                            {{--<div class="mem_search">--}}
                            {{--<div class="input-field">--}}
                            {{--<input id="msearch" type="text" class="validate" required>--}}
                            {{--<label for="msearch">Search Member</label>--}}
                            {{--</div>--}}
                            {{--</div>--}}
                            <table class="hoverable bordered reg_tbl" border="0" id="card-table">
                              <thead>
                                <tr>
                                    <th><strong>S.N</strong></th>
                                    <th><strong>Name</strong></th>
                                    <th><strong>Category</strong></th>
                                    <th><strong>Event</strong></th>
                                    <th><strong>View</strong></th>
                                </tr>
                                 </thead>
                                     <tbody id="tablebody">
                                @if(count($videos)>0)
                                    @foreach($videos as $index=>$file)
                                        <tr>
                                            <td>{{ $index+1 }}</td>
                                            <td>{{ $file->name }}</td>
                                            <td>@foreach (explode(', ', $file->categories) as $singleCategoryKey)
                                                    <div class="chip">
                                                        {{ $categories[$singleCategoryKey] }}
                                                    </div>
                                                @endforeach
                                            </td>
                                            <td> @if($file->event_id !=0)
                                                    {{ $file->event->name }}
                                                @endif
                                            </td>
                                            <td align="center">
                                                @if($file->access_type ==='1')

                                                    <a class="fancybox-media" style="color: #0c7235;" href="{{ $file->download }}"><i class="fa fa-eye fa-lg"></i></a>
                                                @else

                                                    @if (Auth::guest())
                                                        <a href="{{ route('member.login') }}"><i class="fa fa-eye fa-lg"></i></a>
                                                    @else
                                                        <a class="fancybox-media" style="color: #0c7235;" href="{{ $file->download }}"><i class="fa fa-eye fa-lg"></i></a>
                                                    @endif


                                                @endif

                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="5">No Videos found.</td>
                                    </tr>
                                @endif

                                </tbody>
                            </table>

                  

                        <div class="col m12 mgt20">
                            @include('partial.pagination', ['paginator' => $videos])
                        </div>


                </div>
            </div>
            <div class="col l3 col m12 col s12">
                <!-- Sidebar -->
                <div class="sidbar_wrap">

                    <div class="sidbar-box z-depth-1">
                        @include('frontend.facebook')
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop