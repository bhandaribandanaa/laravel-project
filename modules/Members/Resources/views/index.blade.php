@extends('layout.frontend.app')
@section('title', 'Members Registration')
@section('header_js')
@stop
@section('main')

    <div class="container">

        <div class="row">
            <div class="col l9 col m12 col s12">

                <div class="breadcrumb"><a href="{{ route('home') }}">Home</a> <i
                            class="fa fa-angle-right"></i> Member Registration
                </div>
                <div class="title">Member Registration</div>
                <div class="row">
                <div class="col l6 col m12 col s12">
                    <div class="">
                        <div class="card ">
                            <div class="card-content ">
                                <span class="card-title" style="color:#000">Existing Simon Member</span>

                                <p>User already register to Simon</p>
                                <br />
                                <div class="divider"></div>
                                 <br />
                                <a class="btn btn-flat link waves-effect waves-light " href="{{ route('member.register') }}" style="margin-top: 0px;">Click Here</a>
                                
                            </div>
                            
                        </div>
                    </div>
                </div>

                <div class="col l6 col m12 col s12">
                    <div class="">
                        <div class="card ">
                            <div class="card-content ">
                                <span class="card-title" style="color:#000">Apply for new Simon Member</span>

                                <p>Apply for Simon membership</p>
                                <br />
                                <div class="divider"></div>
                                 <br />
                                <a class="btn btn-flat link waves-effect waves-light " href="{{ route('member.new.register') }}" style="margin-top: 0px;">Click Here</a>
                            </div>
                            
                        </div>
                    </div>
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