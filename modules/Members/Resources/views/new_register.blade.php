@extends('layout.frontend.app')
@section('title', 'New Member Registration')
@section('header_css')
@endsection
@section('footer_js')

    {!! Html::script('js/parsley.js') !!}
    <script>
        var app = app || {};

        // Utils
        (function ($, app) {
            'use strict';

            app.utils = {};

            app.utils.formDataSuppoerted = (function () {
                return !!('FormData' in window);
            }());

        }(jQuery, app));

        // Parsley validators
        (function ($, app) {
            'use strict';

            window.Parsley
                    .addValidator('filemaxmegabytes', {
                        requirementType: 'string',
                        validateString: function (value, requirement, parsleyInstance) {

                            if (!app.utils.formDataSuppoerted) {
                                return true;
                            }

                            var file = parsleyInstance.$element[0].files;
                            var maxBytes = requirement * 1048576;

                            if (file.length == 0) {
                                return true;
                            }

                            return file.length === 1 && file[0].size <= maxBytes;

                        },
                        messages: {
                            en: 'Please choose file less than 1 mb.'
                        }
                    })
                    .addValidator('filemimetypes', {
                        requirementType: 'string',
                        validateString: function (value, requirement, parsleyInstance) {

                            if (!app.utils.formDataSuppoerted) {
                                return true;
                            }

                            var file = parsleyInstance.$element[0].files;

                            if (file.length == 0) {
                                return true;
                            }

                            var allowedMimeTypes = requirement.replace(/\s/g, "").split(',');
                            return allowedMimeTypes.indexOf(file[0].type) !== -1;

                        },
                        messages: {
                            en: 'Only pdf, png, jpg is allowed.'
                        }
                    });

        }(jQuery, app));


        // Parsley Init
        (function ($, app) {
            'use strict';

            $('#registration').parsley();

        }(jQuery, app));
    </script>


@endsection
@section('main')



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


                        <form id="registration" data-parsley-validate="" method="post"
                              action="{{ route('member.new.register') }}" enctype="multipart/form-data">

                            <!-- <div class="col m4 s12">
                                <div class="input-field">
                                    <input id="fname" type="text" class="validate" name="salutation"
                                           value="{{ old('salutation') }}" required=""
                                           data-parsley-required-message="Please enter your Salutation"
                                           aria-required="true"/>
                                    <label for="salutation">Salutation</label>


                                </div>
                            </div> -->
                            <div class="col m4 s12">
                                <div class="input-field">
                                    <select name="salutation" value="{{old('salutation')}}" id="fname" class="validate" required=""
                                           data-parsley-required-message="Please enter your Salutation" aria-required="true">
                                        <option value="" selected>Salutation</option>
                                        <option value="Dr">Dr.</option>
                                        <option value="Prof">Prof.</option>
                                        <option value="AssocProf">Assoc. Prof.</option>
                                        <option value="AsstProf">Asst. Prof.</option>
                                    </select>

                                </div>
                            </div>

                            <div class="col m6 s12">
                                <div class="input-field">

                                    {!! Form::select('member_type', $member_type, 1, array('class'=>'selectpicker input-sm','placeholder'=>'Applying for','required'=>'')) !!}

                                </div>
                            </div>

                            <div class="clearfix"></div>


                            <div class="col m4 s12">
                                <div class="input-field">
                                    <input id="fname" type="text" class="validate" name="first_name"
                                           value="{{ old('first_name') }}" required="" aria-required="true"
                                           data-parsley-required-message="Please enter your First name">
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
                                    <input id="lname" type="text" class="validate" required="" aria-required="true"
                                           name="last_name"
                                           value="{{ old('last_name') }}"
                                           data-parsley-required-message="Please enter your Last name">
                                    <label for="lname">Last Name</label>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="col m4 s12">
                                <div class="input-field">
                                    <input id="address" type="text" class="validate" name="address" required=""
                                           aria-required="true"
                                           value="{{ old('address') }}"
                                           data-parsley-required-message="Please enter your address">
                                    <label for="address">Address</label>
                                </div>
                            </div>
                            <div class="col m4 s12">
                                <div class="input-field">
                                    <input id="mobile" type="text" name="mobile_no" class="validate" required=""
                                           aria-required="true"
                                           value="{{ old('mobile_no') }}"
                                           data-parsley-required-message="Please enter your mobile no">
                                    <label for="mobile">Mobile No.</label>
                                </div>
                            </div>
                            <div class="col m4 s12">
                                <div class="input-field">
                                    <input id="email" type="email" class="validate" name="email"
                                           value="{{ old('email') }}" data-parsley-trigger="change" required=""
                                           data-parsley-required-message="Please enter your email">
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
                                           value="{{ old('nmc_no') }}" required="" aria-required="true"
                                           data-parsley-trigger="change" required=""
                                           data-parsley-required-message="Please enter your NMC No."
                                           parsley-filemaxsize="1.5">
                                    <label for="designation">NMC No. </label>
                                </div>
                            </div>
                            <div class="clearfix"></div>

                            <div class="col l6  m6  s12">
                                <div class="file-field input-field">
                                    <div class="btn">
                                        <span>Upload</span>
                                        <input type="file" data-parsley-filemaxmegabytes="1"
                                               data-parsley-trigger="change"
                                               data-parsley-filemimetypes="image/jpeg, image/png, application/pdf"
                                               required=""
                                               name="membership_form"
                                               data-parsley-required-message="Please choose Scan Copy of Membership Application Form">
                                    </div>
                                    <div class="file-path-wrapper">
                                        <input class="file-path validate" type="text">
                                    </div>

                                </div>
                                <label for="file1">Scan Copy of Membership Application Form</label>
                            </div>

                            <div class="clearfix"></div>


                            <div class="col l6  m6  s12">
                                <div class="file-field input-field">
                                    <div class="btn">
                                        <span>Upload</span>
                                        <input type="file" data-parsley-filemaxmegabytes="1"
                                               data-parsley-trigger="change"
                                               data-parsley-filemimetypes="image/jpeg, image/png, application/pdf"
                                               required=""
                                               name="atachment2"
                                               data-parsley-required-message="Please choose Scan Copy of NMC Certificate.">
                                    </div>
                                    <div class="file-path-wrapper">
                                        <input class="file-path validate" type="text">
                                    </div>

                                </div>
                                <label for="file1">Scan Copy of NMC Certificate</label>
                            </div>

                            <div class="clearfix"></div>

                            <div class="col l6  m6  s12">
                                <div class="file-field input-field">
                                    <div class="btn">
                                        <span>Upload</span>
                                        <input type="file" data-parsley-filemaxmegabytes="1"
                                               data-parsley-trigger="change"
                                               data-parsley-filemimetypes="image/jpeg, image/png, application/pdf"
                                               required=""
                                               name="atachment3"
                                               data-parsley-required-message="Please choose Scan Copy of Citizenship.">
                                    </div>
                                    <div class="file-path-wrapper">
                                        <input class="file-path validate" type="text">
                                    </div>

                                </div>
                                <label for="file1">Scan Copy of Citizenship</label>
                            </div>

                            <div class="clearfix"></div>

                            <br>
                            {!! csrf_field() !!}
                            <button class="btn btn-flat waves-effect waves-light shopping-cart-button " type="submit"
                                    name="action">Apply Form Membership
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