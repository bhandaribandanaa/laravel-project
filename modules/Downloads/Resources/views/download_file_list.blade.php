@extends('layout.frontend.app')
@section('title', 'File Download')
@section('header_js')
@stop
@section('main')

    <div class="container">
        <div class="row">
            <div class="col l9 col m12 col s12">
                <div class="blockquote z-depth-1">
                    <div class="breadcrumb"><a href="{{ route('home') }}">Home</a> <i class="fa fa-angle-right"></i>
                        File Downloads
                    </div>
                    <div class="title"> File Downloads</div>


                            {{--<div class="mem_search">--}}
                            {{--<div class="input-field">--}}
                            {{--<input id="msearch" type="text" class="validate" required>--}}
                            {{--<label for="msearch">Search Member</label>--}}
                            {{--</div>--}}
                            {{--</div>--}}
                            <table class="hoverable bordered reg_tbl" border="0"   id="card-table">
                               <thead>
                                <tr>
                                    <th><strong>S.N</strong></th>
                                    <th><strong>Name</strong></th>
                                    <th><strong>Category</strong></th>
                                    <th><strong>Event</strong></th>
                                    <th><strong>View/Download</strong></th>
                                </tr>
                                <thead>
                                @if(count($files)>0)
                                    @foreach($files as $index=>$file)
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
                                                    <a href="{{ asset('uploads/downloads/'.$file->download) }}" target="_blank"><i class="fa fa-download fa-lg"></i></a>
                                                @else

                                                    @if (Auth::guest())
                                                        <a href="{{ route('member.login') }}"><i class="fa fa-download fa-lg"></i></a>
                                                    @else
                                                        <a href="{{ asset('uploads/downloads/'.$file->download) }}" target="_blank"><i class="fa fa-download fa-lg"></i></a>
                                                    @endif


                                                @endif

                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="5">No Downloads found.</td>
                                    </tr>
                                @endif

                                </tbody>
                            </table>

                        

                        <div class="col m12 mgt20">
                            @include('partial.pagination', ['paginator' => $files])
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

        
