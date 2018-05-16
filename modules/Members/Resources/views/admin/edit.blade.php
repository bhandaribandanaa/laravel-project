@extends('admin.layout.app')
@section('title', 'Edit Member')
@section('header_css')
    {!! Html::style('backend/plugins/bootstrap-select/dist/css/bootstrap-select.css') !!}
    {!! Html::style('backend/plugins/chosen_v1.4.2/chosen.min.css') !!}
    {!! Html::style('backend/css/formValidation.min.css') !!}
@stop

@section('main')
    <div class="container">
    <ol class="breadcrumb" style="margin-bottom: 5px;">
        <li><a href="{{ route('admin.dashboard') }}">Home</a></li>
        <li><a href="{{ route('admin.member.index') }}">Member</a></li>
        <li class="active">Edit Member</li>
    </ol>

    <div class="card">
        <div class="card-header">
            <h2>Edit Member
                <small></small>
            </h2>
        </div>

        <div class="card-body card-padding">
            @if (count($errors) > 0)
                <div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                aria-hidden="true">×</span></button>
                    <ul class="list-unstyled">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ route('admin.member.edit',$member->id) }}" method="post" class="row" role="form"
                  enctype="multipart/form-data" id="memberForm">

                <div class="col-sm-4">
                                <div class="form-group fg-line">
                                <label class="" for="exampleInputEmail2">Salutation</label>
                                    <select name="salutation" class="selectpicker">
                                        
                                        <option value="Dr" <?php echo (($member->salutation== 'Dr' || $member->salutation == '')? 'selected="selected"' : '') ?> >Dr.</option>
                                        <option value="Prof" <?php echo (($member->salutation == 'Prof' || $member->salutation == '')? 'selected="selected"' : '') ?> >Prof.</option>
                                        <option value="AssocProf" <?php echo (($member->salutation == 'AssocProf' || $member->salutation == '')? 'selected="selected"' : '') ?> >Assoc. Prof.</option>
                                        <option value="AsstProf" <?php echo (($member->salutation == 'AsstProf' || $member->salutation == '')? 'selected="selected"' : '') ?> >Asst. Prof.</option>

                                        
                                    </select>

                                </div>
                </div><div class='clearfix'></div>
                <div class="col-sm-4">
                    <div class="form-group fg-line">
                        <label class="" for="exampleInputEmail2">First Name*</label>
                        <input type="text" class="form-control input-sm" name="first_name" id=""
                               placeholder="Enter First Name" value="{{ $member->first_name }}">
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="form-group fg-line">
                        <label class="" for="exampleInputEmail2">Middle Name</label>
                        <input type="text" class="form-control input-sm" name="middle_name" id=""
                               placeholder="Enter Middle Name" value="{{ $member->middle_name }}">
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="form-group fg-line">
                        <label class="" for="exampleInputEmail2">Last Name *</label>
                        <input type="text" class="form-control input-sm" name="last_name" id=""
                               placeholder="Enter Last Name" value="{{ $member->last_name }}">
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="form-group fg-line">
                        <label class="" for="exampleInputEmail2">Member Type *</label>
                        {!! Form::select('member_type', $member_type, $member->member_type, array('class'=>'selectpicker form-control input-sm','placeholder'=>'Please member type')) !!}
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group fg-line">
                        <label class="" for="exampleInputEmail2">Membership No.</label>
                        <input type="text" class="form-control input-sm" name="membership_no" id=""
                               placeholder="Membership No." value="{{ $member->membership_no }}">
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group fg-line">
                        <label class="" for="exampleInputEmail2">NMC No. *</label>
                        <input type="text" class="form-control input-sm" name="nmc_no" id=""
                               placeholder="Enter NMC No." value="{{ $member->nmc_no }}">
                    </div>
                </div>
                <div class='clearfix'></div>

                <div class="col-sm-4">
                    <div class="form-group fg-line">
                        <label class="" for="">Email *</label>
                        <input type="email" class="form-control input-sm" name="email" id=""
                               placeholder="Enter Email" value="{{ $member->email }}" disabled>
                    </div>
                </div>
                <div class="col-sm-8">
                    <div class="form-group fg-line">
                        <label class="" for="">Address *</label>
                        <input type="text" class="form-control input-sm" name="address" id=""
                               placeholder="Enter address" value="{{ $member->address }}">
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="form-group fg-line">
                        <label class="" for="">Phone No</label>
                        <input type="text" class="form-control input-sm" name="phone_no" id=""
                               placeholder="Enter phone no." value="{{ $member->phone_no }}">
                    </div>
                </div>

                <div class="col-sm-6">

                    <div class="form-group fg-line">
                        <label class="" for="">Mobile No.*</label>
                        <input type="text" class="form-control input-sm" name="mobile_no" id=""
                               placeholder="Enter mobile no" value="{{ $member->mobile_no }}">
                    </div>
                </div>


                <div class="col-sm-6">
                    <div class="form-group fg-line">
                        <label class="" for="">Organization</label>
                        <input type="text" class="form-control input-sm" name="organization" id=""
                               placeholder="Enter organization" value="{{ $member->organization }}">
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="form-group fg-line">
                        <label class="" for="">Designation</label>
                        <input type="text" class="form-control input-sm" name="designation" id=""
                               placeholder="Enter Designation" value="{{ $member->designation }}">
                    </div>
                </div>

                <div class="col-sm-12">
                    <div class="form-group fg-line">
                        <label class="" for="">User Image</label>
                        <br/>

                        <div class="fileinput fileinput-new" data-provides="fileinput">
                            <div class="fileinput-preview thumbnail" data-trigger="fileinput">

                                @if(!empty($member->member_photo) && file_exists('uploads/member/'. $member->member_photo))
                                    <img src="{{URL::asset('uploads/member/'. $member->member_photo) }}">
                                @endif

                            </div>
                            <div>
                                    <span class="btn btn-info btn-file">
                                        <span class="fileinput-new">Select image</span>
                                        <span class="fileinput-exists">Change</span>
                                        <input type="file" name="member_photo">
                                    </span>
                                <a href="#" class="btn btn-danger fileinput-exists" data-dismiss="fileinput">Remove</a>
                            </div>
                        </div>
                    </div>
                </div>

                {{--<div class="col-sm-6">--}}
                    {{--<div class="form-group fg-line">--}}
                        {{--<label class="" for="">Status</label>--}}
                        {{--<br/>--}}
                        {{--<br/>--}}
                        {{--<label class="radio radio-inline m-r-20">--}}
                            {{--<input type="radio" name="is_active" value="1"--}}
                                   {{--@if($member->is_active==1)checked="checked" @endif>--}}
                            {{--<i class="input-helper"></i>--}}
                            {{--Active--}}
                        {{--</label>--}}
                        {{--<label class="radio radio-inline m-r-20">--}}
                            {{--<input type="radio" name="is_active" value="0"--}}
                                   {{--@if($member->is_active==0)checked="checked" @endif>--}}
                            {{--<i class="input-helper"></i>--}}
                            {{--Inactive--}}
                        {{--</label>--}}
                    {{--</div>--}}
                {{--</div>--}}

                <div class="clearfix"></div>
                {!! csrf_field() !!}
                <div class="col-sm-4">
                    <button type="submit" class="btn btn-primary btn-sm m-t-5">Edit Member</button>
                </div>
            </form>
        </div>
    </div>
        </div>
@stop
@section('footer_js')
    {!! Html::script('backend/js/formValidation.min.js') !!}
    {!! Html::script('backend/js/form_bootstrap.min.js') !!}
    {!! Html::script('backend/plugins/bootstrap-select/dist/js/bootstrap-select.js') !!}
    {!! Html::script('backend/plugins/fileinput/fileinput.min.js') !!}
    {!! Html::script('backend/plugins/chosen_v1.4.2/chosen.jquery.min.js') !!}

    <script>
        $(document).ready(function () {
            $('#memberForm')
                    .find('[name="member_type"]')
                    .selectpicker()
                    .change(function (e) {
                        $('#bootstrapSelectForm').formValidation('revalidateField', 'member_type');
                    })
                    .end()
                    .formValidation({
                        framework: 'bootstrap',
                        excluded: [':disabled'],
                        icon: {
                            valid: 'glyphicon glyphicon-ok',
                            invalid: 'glyphicon glyphicon-remove',
                            validating: 'glyphicon glyphicon-refresh'
                        },
                        fields: {
                            first_name: {
                                validators: {
                                    notEmpty: {
                                        message: 'The First Name is required'
                                    }
                                }
                            },
                            last_name: {
                                validators: {
                                    notEmpty: {
                                        message: 'The Last Name is required'
                                    }
                                }
                            },
                            "email": {
                                validators: {
                                    notEmpty: {
                                        message: 'The Email in is required'
                                    },
                                    emailAddress: {
                                        message: 'The value is not a valid email address'
                                    }

                                }
                            },
                            address: {
                                validators: {
                                    notEmpty: {
                                        message: 'The address is required'
                                    }
                                }
                            },
                            mobile_no: {
                                validators: {
                                    notEmpty: {
                                        message: 'The Mobile No is required'
                                    }
                                }
                            },
                            nmc_no: {
                                validators: {
                                    notEmpty: {
                                        message: 'The NMC Number is required'
                                    }
                                }
                            },
                            member_type: {
                                validators: {
                                    notEmpty: {
                                        message: 'The Member Type is required'
                                    }
                                }
                            },

                        }
                    })
                    .on('err.form.fv', function (e) {
                    })
                    .end();
        });
    </script>
@stop