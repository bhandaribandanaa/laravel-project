@extends('layout.frontend.app')
@section('title', 'Profile')
@section('header_js')
@stop
@section('main')
    <div class="container">
        <div class="row">


            <div class="col l4 m4 col s12">

                <div class="blockquote z-depth-1 mem_sidebar">
                    <div class="profile-image">
                        @if($memberInfo->member_photo && file_exists('uploads/member/'. $memberInfo->member_photo))
                            <img class="responsive-img circle"
                                 src="{{URL::asset('uploads/member/'. $memberInfo->member_photo) }}">
                        @else
                            <img class="responsive-img circle"
                                 src="{{ URL::asset('images/no-profile-img.gif') }}">
                        @endif

                        <br> {{ $memberInfo->salutation.' '.$memberInfo->first_name.' '.$memberInfo->last_name }}
                    </div>
                    <p>{{ $memberInfo->about }} </p>


                </div>


            </div>

            <!-- col4 end-->
            <div class="col l8 m8 col s12">

                <div class="blockquote z-depth-1">

                    @if (count($errors) > 0)
                        <div class="alert alert-error">
                            <ul style="margin-top: 0px;">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <?php $error = Session::get('error'); ?>

                    @if($error)
                        <div class="alert alert-error" style="padding-bottom: 30px;">
                            {{ $error }}
                        </div>
                    @endif

                    <?php $success = Session::get('success'); ?>
                    @if($success)
                        <div class="alert alert-success reg_success">
                            {!! $success !!}
                        </div>
                    @endif


                    <div class="sub_title">Personal Information</div>

                    <div class="row mem_info">
                        <div class="col l4  m4  s12">Address</div>
                        <div class="col l8  m8  s12">{{ $memberInfo->address }}</div>
                        <div class="clearfix"></div>
                        <div class="col l4  m4  s12"> Email</div>
                        <div class="col l8  m8  s12">{{ $memberInfo->email }}</div>
                        <div class="clearfix"></div>
                        <div class="col l4  m4  s12"> Phone</div>
                        <div class="col l8  m8  s12">{{ $memberInfo->phone_no }}</div>
                        <div class="clearfix"></div>
                        <div class="col l4  m4  s12"> Mobile</div>
                        <div class="col l8  m8  s12">{{ $memberInfo->mobile_no }}</div>
                        <div class="clearfix"></div>
                        <div class="col l4  m4  s12"> Membership No.</div>
                        <div class="col l8  m8  s12">{{ $memberInfo->membership_no }}</div>
                        <div class="clearfix"></div>
                        <div class="col l4  m4  s12"> NMC No.</div>
                        <div class="col l8  m8  s12">{{ $memberInfo->nmc_no }}</div>
                        <div class="clearfix"></div>
                    </div> <!--row end-->

                </div> <!--blockquote end-->
                <div class="blockquote z-depth-1">
                    <div class="sub_title">Other Information</div>

                    <div class="row mem_info">
                        <div class="col l4  m4  s12"> Organization</div>
                        <div class="col l8  m8  s12">{{ $memberInfo->organization }}</div>
                        <div class="clearfix"></div>
                        <div class="col l4  m4  s12"> Special Interest</div>
                        <div class="col l8  m8  s12">{{ $memberInfo->interests }}</div>
                        <div class="clearfix"></div>

                        <div class="col l4  m4  s12"> Social Network</div>
                        <div class="col l8  m8  s12">
                            <div class="social-icon">
                                @if(!empty($memberInfo->facebook_url))
                                    <a href="{{ $memberInfo->facebook_url }}" target="_blank"><i
                                                class="fa fa-facebook"></i></a>
                                @endif
                                @if(!empty($memberInfo->twitter_url))
                                    <a href="{{ $memberInfo->twitter_url }}" target="_blank"> <i
                                                class="fa fa-twitter"></i></a>
                                @endif
                                @if(!empty($memberInfo->linkedin_url))
                                    <a href="{{ $memberInfo->linkedin_url }}" target="_blank"><i
                                                class="fa fa-linkedin"></i></a>
                                @endif
                                {{--<a href="javascript:void(0);"><i class="fa fa-pinterest"></i></a>--}}
                                {{--<a href="javascript:void(0);"><i class="fa fa-instagram"></i></a>--}}
                                {{--<a href="javascript:void(0);"><i class="fa fa-google-plus"></i></a>--}}
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div> <!--row end-->

                </div> <!--blockquote end-->
            </div>
            <!-- col 8 end-->
        </div>
    </div>
@stop