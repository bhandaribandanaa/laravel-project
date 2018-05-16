@extends('layout.frontend.app')
@section('title', 'Life Time Members')
@section('header_js')
@stop
@section('main')

    <div class="container">
        <div class="row">
            <div class="col l9 col m12 col s12">
                <div class="blockquote z-depth-1">
                    <div class="breadcrumb"><a href="{{ route('home') }}">Home</a> <i class="fa fa-angle-right"></i>
                        Life Time Members List
                    </div>
                    <div class="title">Life Time Members List</div>


                    <div class="mem_search">
                        <div class="input-field">
                            <input id="msearch" type="text" class="validate" required>
                            <label for="msearch">Search Member</label>
                        </div>
                    </div>
                    <table class="hoverable bordered reg_tbl" border="0" id="card-table">
                        <thead>
                        <tr>
                            <th>S.N</th>
                            <th><strong>Dr Name</strong></th>
                            <th><strong>View Profile</strong></th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(count($members)>0)
                            @foreach($members as $index=>$member)
                                <tr>
                                    <td>{{ $index+1 }}</td>
                                    <td>{{ $member->salutation.' '.$member->first_name.' '.$member->last_name }}</td>
                                    <td>
                                        @if (Auth::guest())
                                            <a href="{{ route('member.login') }}" title="view profile"><i
                                                        class="fa fa-eye fa-lg"></i></a>
                                        @else
                                            <a href="{{ route('member.detail',array($member->id,str_replace(' ', '-', strtolower($member->first_name).' '.strtolower($member->last_name)))) }}"
                                               title="view profile"><i class="fa fa-eye fa-lg"></i></a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="3">No Member found.</td>
                            </tr>
                        @endif

                        </tbody>
                    </table>

                    <div class="col m12 mgt20">
                        @include('partial.pagination', ['paginator' => $members])
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