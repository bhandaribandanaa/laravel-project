@extends('layout.frontend.app')
@section('title', 'Profile')
@section('header_js')
@stop
@section('main')
    <div class="container">
        <div class="row">


            <div class="col l4 m12 col s12">

                <div class="blockquote z-depth-1 mem_sidebar">
                    <div class="profile-image">
                        @if($userInfo->member_photo && file_exists('uploads/member/'. $userInfo->member_photo))
                            <img class="responsive-img circle"
                                 src="{{URL::asset('uploads/member/'. $userInfo->member_photo) }}">
                        @else
                            <img class="responsive-img circle"
                                 src="{{ URL::asset('images/no-profile-img.gif') }}">
                        @endif

                        <br> {{ $userInfo->salutation.' '.$userInfo->first_name.' '.$userInfo->last_name }}
                    </div>
                    <p>{{ $userInfo->about }} </p>

                    <div class="list">
                        <ul>

                            <li><a href="{{ route('member.profile.edit') }}"><i class="fa fa-user"></i> Edit Profile</a>
                            </li>
                            <li><a href="{{ route('member.change.password') }}"><i class="fa fa-lock"></i> Change
                                    Password</a></li>
                            <li><a href="{{ route('member.logout') }}"><i class="fa fa-sign-out"></i> Log Out</a></li>

                        </ul>
                    </div>

                </div>


            </div>

            <!-- col4 end-->
            <div class="col l8 m12 col s12">

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
                        <div class="col l4  m4  s4"><i class="fa  fa-map-marker"></i> <strong>Address</strong></div>
                        <div class="col l8  m8  s8">{{ $userInfo->address }}</div>
                        <div class="clearfix"></div>
                        <div class="col l4  m4  s4"><i class="fa fa-envelope"></i> <strong>Email</strong></div>
                        <div class="col l8  m8  s8">{{ $userInfo->email }}</div>
                        <div class="clearfix"></div>
                        <div class="col l4  m4  s4"><i class="fa fa-phone"></i> <strong>Phone</strong></div>
                        <div class="col l8  m8  s8">{{ $userInfo->phone_no }}</div>
                        <div class="clearfix"></div>
                        <div class="col l4  m4  s4"><i class="fa fa-mobile"></i> <strong>Mobile</strong></div>
                        <div class="col l8  m8  s8">{{ $userInfo->mobile_no }}</div>
                        <div class="clearfix"></div>
                        <div class="col l4  m4  s6"><i class="fa fa-group"></i> <strong>Membership No.</strong></div>
                        <div class="col l8  m8  s6">{{ $userInfo->membership_no }}</div>
                        <div class="clearfix"></div>
                        <div class="col l4  m4  s4"><i class="fa fa-book"></i> <strong>NMC No.</strong></div>
                        <div class="col l8  m8  s8">{{ $userInfo->nmc_no }}</div>
                        <div class="clearfix"></div>
                    </div> <!--row end-->

                </div> <!--blockquote end-->
                <div class="blockquote z-depth-1">
                    <div class="sub_title">Other Information</div>

                    <div class="row mem_info">
                        <div class="col l4  m4  s6"><i class="fa fa-briefcase"></i> <strong>Organization</strong></div>
                        <div class="col l8  m8  s6">{{ $userInfo->organization }}</div>
                        <div class="clearfix"></div>
                        <div class="col l4  m4  s6"><i class="fa fa-star"></i> <strong>Special Interest</strong></div>
                        <div class="col l8  m8  s6">{{ $userInfo->interests }}</div>
                        <div class="clearfix"></div>

                        <div class="col l4  m4  s6"><i class="fa fa-sitemap"></i> <strong>Social Network</strong></div>
                        <div class="col l8  m8  s6">
                            <div class="social-icon">
                                @if(!empty($userInfo->facebook_url))
                                    <a href="{{ $userInfo->facebook_url }}" target="_blank"><i
                                                class="fa fa-facebook"></i></a>
                                @endif
                                @if(!empty($userInfo->twitter_url))
                                    <a href="{{ $userInfo->twitter_url }}" target="_blank"><i class="fa fa-twitter"></i></a>
                                @endif
                                @if(!empty($userInfo->linkedin_url))
                                    <a href="{{ $userInfo->linkedin_url }}" target="_blank"><i
                                                class="fa fa-linkedin"></i></a>
                                @endif
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