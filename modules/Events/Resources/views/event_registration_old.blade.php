@extends('layout.frontend.app')
@section('title', $event->name)
@section('header_js')
@stop
@section('header_css')
@stop
@section('main')
    <div class="container">
        <div class="row">
            <div class="col l9 col m12 col s12">
                <div class="blockquote z-depth-1">
                    <div class="breadcrumb"><a href="{{ route('home') }}">Home</a> <i class="fa fa-angle-right"></i> <a
                                href="#">Events</a> <i class="fa fa-angle-right"></i> <a
                                href="{{ route('event.detail', array($event->id,$event->slug)) }}">{{ $event->name }}</a>
                        <i class="fa fa-angle-right"></i> Registration
                    </div>
                    <div class="title">Registration</div>
                    <div class="row">

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

                        <form name="registration" id="registration" method="post"
                              action="{{ route('event.registration',array($event->id,$event->slug)) }}">
                            <div class="col m4 s12">
                                <div class="input-field">
                                    <select name="salutation">
                                        <option value="" selected>Salutation</option>
                                        <option value="Mr">Mr</option>
                                        <option value="Mrs">Mrs</option>
                                        <option value="Miss">Miss</option>
                                        <option value="Dr">Dr</option>
                                    </select>

                                </div>
                            </div>

                            <div class="clearfix"></div>

                            <div class="col m4 s12">
                                <div class="input-field">
                                    <input id="fname" type="text" name="first_name"
                                           value="{{ Input::old('first_name') }}" class="validate" required>
                                    <label for="fname">First Name</label>
                                </div>
                            </div>
                            <div class="col m4 s12">
                                <div class="input-field">
                                    <input id="mname" type="text" name="middle_name"
                                           value="{{ Input::old('middle_name') }}">
                                    <label for="mname">Middle Name</label>
                                </div>
                            </div>
                            <div class="col m4 s12">
                                <div class="input-field">
                                    <input id="lname" type="text" name="last_name" class="validate"
                                           value="{{ Input::old('last_name') }}" required>
                                    <label for="lname">Last Name</label>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="col m4 s12">
                                <div class="input-field">
                                    <input id="address" type="text" name="address" class="validate"
                                           value="{{ Input::old('address') }}" required>
                                    <label for="address">Address</label>
                                </div>
                            </div>
                            <div class="col m4 s12">
                                <div class="input-field">
                                    <input id="mobile" type="text" class="validate" name="mobile_no"
                                           value="{{ Input::old('mobile_no') }}" required>
                                    <label for="mobile">Mobile No.</label>
                                </div>
                            </div>
                            <div class="col m4 s12">
                                <div class="input-field">
                                    <input id="email" type="email" name="email" class="validate"
                                           value="{{ Input::old('email') }}" required>
                                    <label for="email">Email</label>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="col m4 s12">
                                <div class="input-field">
                                    <input id="organization" type="text" name="organization"
                                           value="{{ Input::old('organization') }}" class="validate" required>
                                    <label for="organization">Organization</label>
                                </div>
                            </div>
                            <div class="col m4 s12">
                                <div class="input-field">
                                    <input id="designation" type="text" name="designation" class="validate"
                                           value="{{ Input::old('designation') }}" required>
                                    <label for="designation">Designation </label>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <br>

                            <div class="col m12">
                                <table class="hoverable bordered reg_tbl" border="0">
                                    <tbody>
                                    <tr>
                                        <td></td>
                                        <td><strong>Conference Registrations
                                                (11th
                                                & 12th
                                                March 2016)</strong></td>
                                        <td><strong>Till March 5th 2016</strong></td>
                                        <td><strong>From March 6th

                                                2016 onwards</strong></td>
                                    </tr>
                                    <tr>
                                        <td><input name="member_type" type="radio" value="1" id="mem" checked/>
                                            <label for="mem"></label></td>
                                        <td>SIMON members and Residents</td>
                                        <td>3,500/-</td>
                                        <td>5,000/-</td>
                                    </tr>
                                    <tr>
                                        <td><input name="member_type" type="radio" value="2" id="nonmen"/>
                                            <label for="nonmen"></label></td>
                                        <td>Non Members</td>
                                        <td>4,000/-</td>
                                        <td>6,000/-</td>
                                    </tr>
                                    <tr>
                                        <td><input name="member_type" type="radio" value="3" id="mem_spouse"/>
                                            <label for="mem_spouse"></label></td>
                                        <td>SIMON members with spouse</td>
                                        <td>5,000/-</td>
                                        <td>7,000/-</td>
                                    </tr>
                                    <tr class="mem_spouse_wrap">
                                        <td>&nbsp;</td>
                                        <td colspan="3">
                                            <div class="input-field">
                                                <input id="" type="text" name="mem_spouse_name">
                                                <label for="">Spouse Name</label>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td><input name="member_type" type="radio" value="4" id="nonmem_spouse"/>
                                            <label for="nonmem_spouse"></label></td>
                                        <td>Non members with spouse</td>
                                        <td>6,000/-</td>
                                        <td>8,000/-</td>
                                    </tr>
                                    <tr class="nonmem_spouse_wrap">
                                        <td>&nbsp;</td>
                                        <td colspan="3">
                                            <div class="input-field">
                                                <input id="" type="text" name="nonmem_spouse_name">
                                                <label for="">Spouse Name</label>
                                            </div>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                                <div style="font-size:11px; margin:10px 0; color:#999">Note: Registration fee doesn’t
                                    include accomodation.
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="clearfix"></div>
                            <br>
                            {!! csrf_field() !!}
                            {{--<input type="submit"  value="Register Now">--}}
                            <button type="submit" class="btn btn-flat waves-effect waves-light shopping-cart-button"
                                    name="action">Register Now
                            </button>
                        </form>
                    </div>
                    <!--row end-->
                </div>
            </div>
            <div class="col l3 col m12 col s12">
                <!-- Sidebar -->
                <div class="sidbar_wrap">
                    <div class="sidbar-box z-depth-1">

                        <ul>
                            <?php
                            $curDate = strtotime(date("Y-m-j"));
                            $eventDate = strtotime($event->start_date);
                            ?>

                            {{--@if($curDate < $eventDate)--}}
                                {{--<li>--}}
                                    {{--<a href="{{ route('event.registration',array($event->id,$event->slug)) }}">Registration--}}
                                        {{--Here </a>--}}
                                {{--</li>--}}
                            {{--@endif--}}
                            @if(count($event->contents)>0)
                                @foreach($event->contents as $content)
                                    <li>
                                        <a href="{{ route('event.detail.content',array($event->id,$event->slug,$content->slug)) }}">{{ $content->title }}</a>
                                    </li>
                                @endforeach
                            @endif
                        </ul>

                    </div>
                    <div class="sidbar-box z-depth-1">
                        @include('frontend.facebook')
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@stop