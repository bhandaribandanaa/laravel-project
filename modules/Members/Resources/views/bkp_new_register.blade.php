@extends('layout.frontend.app')
@section('title', 'New Member Registration')
@section('header_css')
{{--    {!! Html::style('plugins/formvalidation/formValidation.min.css') !!}--}}
@endsection
@section('footer_js')
    {!! Html::script('js/jquery.validate.min.js') !!}
    {!! Html::script('js/additional-methods.min.js') !!}

    <script>

        $(document).ready(function() {
            $("#registration").validate();
        });

    </script>

    @endsection
@section('main')
<style>
    label:after {
        transition-property: all !important;
        font-size: 0.8rem;
        transform: none;
    }
    label:not(.active):after {
        transform: translateY(-140%);
    }
    label {
        width: 100%;
    }
    label:after {
        -moz-transition-property: all !important;
        -o-transition-property: all !important;
        -webkit-transition-property: all !important;
        transition-property: all !important;
        font-size: 0.8rem;
        -moz-transform: none;
        -ms-transform: none;
        -o-transform: none;
        -webkit-transform: none;
        transform: none;
    }

    label:not(.active):after {
        -moz-transform: translateY(-140%);
        -ms-transform: translateY(-140%);
        -o-transform: translateY(-140%);
        -webkit-transform: translateY(-140%);
        transform: translateY(-140%);
    }
</style>
    <div class="container">
        <div class="row">
            <div class="col l9 col m12 col s12">
                <div class="blockquote z-depth-1">
                    <div class="breadcrumb"><a href="{{ route('home') }}">Home</a> <i class="fa fa-angle-right"></i>
                        Members <i
                                class="fa fa-angle-right"></i> Register
                    </div>
                    <div class="title">Applying For Simon Membership</div>
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
                              action="{{ route('member.new.register') }}">

                            <div class="col m4 s12">
                                <div class="input-field">
                                    <input id="fname" type="text" class="validate" name="salutation"
                                           value="{{ old('salutation') }}" required placeholder="Dr.">
                                    <label for="fname">Salutation</label>


                                </div>
                            </div>


                            <div class="col m6 s12">
                                <div class="input-field">

                                    {!! Form::select('member_type', $member_type, null, array('class'=>'selectpicker form-control input-sm','placeholder'=>'Applying for','required'=>'required')) !!}

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


                            <div class="col l6  m6  s12">
                                <div class="file-field input-field">
                                    <div class="btn">
                                        <span>Upload</span>
                                        <input type="file">
                                    </div>
                                    <div class="file-path-wrapper">
                                        <input class="file-path validate" type="text">
                                    </div>
                                </div>
                                <label>Scan Copy of Membership Application Form</label>
                            </div>

                            <div class="clearfix"></div>


                            <div class="col l6  m6  s12">
                                <div class="file-field input-field">
                                    <div class="btn">
                                        <span>Upload</span>
                                        <input type="file">
                                    </div>
                                    <div class="file-path-wrapper">
                                        <input class="file-path validate" type="text">
                                    </div>
                                </div>
                                <label>Scan Copy of Membership Application Form</label>
                            </div>

                            <div class="clearfix"></div>


                            <div class="col l6  m6  s12">
                                <div class="file-field input-field">
                                    <div class="btn">
                                        <span>Upload</span>
                                        <input type="file">
                                    </div>
                                    <div class="file-path-wrapper">
                                        <input class="file-path validate" type="text">
                                    </div>
                                </div>
                                <label>Scan Copy of Membership Application Form</label>
                            </div>

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