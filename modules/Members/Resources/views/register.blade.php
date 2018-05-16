@extends('layout.frontend.app')
@section('title', 'Member Registration')
@section('header_js')
@stop
@section('main')

    <div class="container">
        <div class="row">
            <div class="col l9 col m12 col s12">
                <div class="blockquote z-depth-1">
                    <div class="breadcrumb"><a href="{{ route('home') }}">Home</a> <i class="fa fa-angle-right"></i>
                        Members <i
                                class="fa fa-angle-right"></i> Register
                    </div>
                    <div class="title">Existing Member Registration</div>
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

                        <?php $success = Session::get('success'); ?>
                        @if($success)
                            <div class="alert alert-success reg_success">
                                {!! $success !!}
                            </div>
                        @endif


                        <form name="registration" id="registration" method="post"
                              action="{{ route('member.register') }}">

                            <!-- <div class="col m4 s12">
                                <div class="input-field">
                                    <input id="fname" type="text" class="validate" name="salutation"
                                           value="{{ old('salutation') }}" required placeholder="Dr.">
                                    <label for="fname">Salutation</label>


                                </div>
                            </div> -->
                            <div class="col m4 s12">
                                <div class="input-field">
                                    <select name="salutation" value="{{old('salutation')}}" id="fname" class="validate">
                                        <option value="" selected>Salutation</option>
                                        <option value="Dr">Dr.</option>
                                        <option value="Prof">Prof.</option>
                                        <option value="AssocProf">Assoc. Prof.</option>
                                        <option value="AsstProf">Asst. Prof.</option>
                                    </select>

                                </div>
                            </div>


                            <div class="col m4 s12">
                                <div class="input-field">

                                    {!! Form::select('member_type', $member_type, '1', array('class'=>'selectpicker form-control input-sm','placeholder'=>'Please Member Type','required'=>'required')) !!}

                                </div>
                            </div>

                            <div class="col m4 s12">
                                <div class="input-field">
                                    <input id="fname" type="text" class="validate" name="membership_no"
                                           value="{{ old('membership_no') }}">
                                    <label for="fname">Membership No</label>
                                </div>
                            </div>

                            <div class="clearfix"></div>

                            <div class="col m4 s12">
                                <div class="input-field">
                                    <input id="fname" type="text" class="validate" name="first_name"
                                           value="{{ old('first_name') }}" required>
                                    <label for="fname">First Name</label>
                                </div>
                            </div>
                            <div class="col m4 s12">
                                <div class="input-field">
                                    <input id="mname" type="text" class="validate" value="{{ old('middle_name') }}"
                                           name="middle_name">
                                    <label for="mname">Middle Name</label>
                                </div>
                            </div>
                            <div class="col m4 s12">
                                <div class="input-field">
                                    <input id="lname" type="text" class="validate" required name="last_name"
                                           value="{{ old('last_name') }}">
                                    <label for="lname">Last Name</label>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="col m4 s12">
                                <div class="input-field">
                                    <input id="address" type="text" class="validate" name="address"
                                           value="{{ old('address') }}">
                                    <label for="address">Address</label>
                                </div>
                            </div>
                            <div class="col m4 s12">
                                <div class="input-field">
                                    <input id="mobile" type="text" name="mobile_no" class="validate" required
                                           value="{{ old('mobile_no') }}">
                                    <label for="mobile">Mobile No.</label>
                                </div>
                            </div>
                            <div class="col m4 s12">
                                <div class="input-field">
                                    <input id="email" type="email" class="validate" required name="email"
                                           value="{{ old('email') }}">
                                    <label for="email">Email</label>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="col m4 s12">
                                <div class="input-field">
                                    <input id="organization" type="text" class="validate" name="organization"
                                           value="{{ old('organization') }}">
                                    <label for="organization">Organization</label>
                                </div>
                            </div>
                            <div class="col m4 s12">
                                <div class="input-field">
                                    <input id="organization" type="text" class="validate" name="designation"
                                           value="{{ old('designation') }}">
                                    <label for="organization">Designation</label>
                                </div>
                            </div>
                            <div class="col m4 s12">
                                <div class="input-field">
                                    <input id="designation" type="text" class="validate" name="nmc_no"
                                           value="{{ old('nmc_no') }}">
                                    <label for="designation">NMC No. </label>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <br>


                            <div class="clearfix"></div>
                            <div class="clearfix"></div>
                            <br>
                            {!! csrf_field() !!}
                            <button class="btn btn-flat waves-effect waves-light shopping-cart-button " type="submit"
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
                        @include('frontend.facebook')
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop