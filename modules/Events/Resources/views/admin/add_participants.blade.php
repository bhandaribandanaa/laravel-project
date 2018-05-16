@extends('admin.layout.app')
@section('title', 'Add Participant')
@section('header_css')
    {!! Html::style('backend/plugins/bootstrap-select/dist/css/bootstrap-select.css') !!}
    {!! Html::style('backend/plugins/chosen_v1.4.2/chosen.min.css') !!}
    {!! Html::style('backend/css/formValidation.min.css') !!}
@stop

@section('main')
    <div class="container">
    <ol class="breadcrumb" style="margin-bottom: 5px;">
        <li><a href="{{ route('admin.dashboard') }}">Home</a></li>
        <li><a href="{{ route('admin.event.index') }}">Events</a></li>
        <li class="active">Add Participant</li>
    </ol>
    <div class="card">
        <div class="card-header">
            <h2>Add Participant to : {{ $event->name }}
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

            <?php $error = Session::get('error'); ?>
            @if($error)
                <div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                aria-hidden="true">×</span></button>
                    <ul class="list-unstyled">

                        <li>{{ $error }}</li>

                    </ul>
                </div>

            @endif
            <form action="{{ route('admin.event.participants.add',array($event->id,$event->slug)) }}"
                  method="post" class="row"
                  role="form"
                  enctype="multipart/form-data" id="participantForm">

                <div class="col-sm-3">
                    <label class="" for="">Salutation</label>

                    <div class="input-group form-group">
                        <!-- {!! Form::select('salutation', array('Mr' => 'Mr', 'Mrs' => 'Mrs','Miss'=>'Miss','Dr'=>'Dr'), 'Dr', ['placeholder' => 'Salutation','class'=>'form-control']) !!} -->
                        {!! Form::select('salutation', array('Dr' => 'Dr', 'Prof' => 'Prof'), 'Dr', ['placeholder' => 'Salutation','class'=>'form-control']) !!}
                    </div>
                </div>
                <div class="col-sm-3">
                    <label class="" for="">First Name *</label>

                    <div class="input-group form-group">
                        <input type='text' class="form-control" name="first_name"
                               value="{{ old('first_name') }}">
                    </div>

                </div>
                <div class="col-sm-3">
                    <label class="" for="">Middle Name</label>

                    <div class="input-group form-group">
                        <input type='text' class="form-control" name="middle_name"
                               value="{{ old('middle_name') }}">
                    </div>
                </div>
                <div class="col-sm-3">
                    <label class="" for="">Last Name*</label>

                    <div class="input-group form-group">
                        <input type='text' class="form-control" name="last_name"
                               value="{{ old('last_name') }}">
                    </div>
                </div>


                <div class="col-sm-12">
                    <div class="form-group fg-line">
                        <label class="" for="">Registration Type</label>
                        {!! Form::select('event_registration_type', $event_participants_type, '', array('class'=>'selectpicker form-control input-sm with_spouse','placeholder'=>'Please member type','id'=>"with_spouse")) !!}

                    </div>
                </div>

                <div>
<p>Do you have accompanying person? </p>
    <div>
   <input type="radio" name="has_accompanying_person" value="0" id="no1" " checked="checked"> <label for="no1">No</label>
   <input type="radio" name="has_accompanying_person" value="1" id="yes1"><label for="yes1"> Yes</label>
</div>
<p colspan="4" class="box" id="krish">
    <span id="question" class="redd box"><span>Accompanying Name : </span><input type="text" name="accompanying_name" class="form-control input-sm" id="accompanying_name" ></span>
    </p>
    </div><br/>

    
       <p> Are you also registrating for workshop?</p>
    <div>
    <input type="radio" name="has_workshop_registration" value="0" id="no2" checked="checked"> <label for="no2" >No</label>
    <input type="radio" name="has_workshop_registration" value="1" id="yes2"> <label for="yes2">Yes</label>
    </div>
    <div class="yes box2" id="question2" class="form-control">
                                         <p> <table class="yes box2" id="null">
                                            <tr>
                                        <td><input name="workshop_type" type="radio" value="1" id="workshop1"/>
                                            <label for="workshop1"></label></td>
                                        <td >Emergency Neurological Life Support</td>
                                        <td >NPR. 5000</td>
                                        <td></td>
                                        <td></td>

                                    </tr>
                                            <tr>
                                        <td><input name="workshop_type" type="radio" value="2" id="workshop2"/>
                                            <label for="workshop2"></label></td>
                                        <td colspan="1">Royal College of Physicians of Edinburg Acute Medicine</td>
                                        <td>NPR. 4000</td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                          </table></p>
                                        
                                         </div>
</div>



                <div id="spouse_name" style="display:none;">

                    <div class="col-sm-3">
                        <label class="" for="">Spouse Salutation</label>

                        <div class="input-group form-group">
                            {!! Form::select('spouse_salutation', array('Mr' => 'Mr', 'Mrs' => 'Mrs','Miss'=>'Miss','Dr'=>'Dr'), 'Dr', ['placeholder' => 'Salutation','class'=>'form-control']) !!}
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <label class="" for="">Spouse First Name *</label>

                        <div class="input-group form-group">
                            <input type='text' class="form-control" name="spouse_first_name"
                                   value="{{ old('spouse_first_name') }}">
                        </div>

                    </div>
                    <div class="col-sm-3">
                        <label class="" for=""> Spouse Middle Name</label>

                        <div class="input-group form-group">
                            <input type='text' class="form-control" name="spouse_middle_name"
                                   value="{{ old('spouse_middle_name') }}">
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <label class="" for="">Spouse Last Name*</label>

                        <div class="input-group form-group">
                            <input type='text' class="form-control" name="spouse_last_name"
                                   value="{{ old('spouse_last_name') }}">
                        </div>
                    </div>



                </div>


                <div class="col-sm-6" id="barcode1" style="">
                    <label class="" for="">Barcode Participant *</label>

                    <div class="form-group fg-line">

                        <input type="text" class="form-control input-sm" name="barcode1" id=""
                               placeholder="Participant barcode" value="{{ old('barcode1') }}">
                    </div>

                </div>
                <div class="col-sm-6" id="barcode2" style="display:none;">
                    <label class="" for="">Barcode Spouse *</label>

                    <div class="form-group fg-line">

                        <input type="text" class="form-control input-sm" name="barcode2" id=""
                               placeholder="Spouse barcode" value="{{ old('barcode2') }}">
                    </div>

                </div>



                <div class="col-sm-12">
                    <div class="form-group fg-line">
                        <label class="" for="">Address*</label>
                        <input type="text" class="form-control input-sm" name="address" id=""
                               placeholder="Enter address" value="{{ old('address') }}">
                    </div>
                </div>

                <div class="col-sm-12">
                    <div class="form-group fg-line">
                        <label class="" for="">Phone No</label>
                        <input type="text" class="form-control input-sm" name="phone_no" id=""
                               placeholder="Enter phone no" value="{{ old('phone_no') }}">
                    </div>
                </div>

                <div class="col-sm-12">

                    <div class="form-group fg-line">
                        <label class="" for="">Mobile No*</label>
                        <input type="text" class="form-control input-sm" name="mobile_no" id=""
                               placeholder="Enter mobile no" value="{{ old('mobile_no') }}">
                    </div>
                </div>
                <div class="col-sm-12">

                    <div class="form-group fg-line">
                        <label class="" for="">Email*</label>
                        <input type="text" class="form-control input-sm" name="email" id=""
                               placeholder="Enter email" value="{{ old('email') }}">
                    </div>
                </div>

                <div class="col-sm-12">

                    <div class="form-group fg-line">
                        <label class="" for="">Organization</label>
                        <input type="text" class="form-control input-sm" name="organization" id=""
                               placeholder="Enter organization" value="{{ old('organization') }}">
                    </div>
                </div>

                <div class="col-sm-12">

                    <div class="form-group fg-line">
                        <label class="" for="">Designation</label>
                        <input type="text" class="form-control input-sm" name="designation" id=""
                               placeholder="Enter organization" value="{{ old('designation') }}">
                    </div>
                </div>

                <div class="col-sm-12">

                    <div class="form-group fg-line">
                        <label class="" for="">Payment Status*</label>
                        {!! Form::select('payment_status',   array('0' => 'Unpaid', '1' => 'Paid','2'=>'Credit'), '', array('class'=>'form-control input-sm status','placeholder'=>'Payment Status','id'=>"status")) !!}
                    </div>
                </div>

                <div class="col-sm-12" id="credit_note" style="display:none;">
                    <div class="form-group fg-line">
                        <label class="" for="">Credit Note</label>
                        <input type="text" class="form-control input-sm" name="remarks" id=""
                               placeholder="Remarks" value="{{ old('remarks') }}">
                    </div>
                </div>

                <div class="col-sm-12" id="receipt_no" style="display:none;">
                    <div class="form-group fg-line">
                        <label class="" for="">Receipt No.</label>
                        <input type="text" class="form-control input-sm" name="receipt_no" id=""
                               placeholder="Receipt No." value="{{ old('receipt_no') }}">
                    </div>
                </div>

                <div class="clearfix"></div>
                {!! csrf_field() !!}
                <div class="col-sm-4">
                    <button type="submit" class="btn btn-primary btn-sm m-t-5">Add Participant</button>
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
            $('#status').bind('change', function (e) {
                if ($('#status').val() == '1') {
                    $('#receipt_no').show();
                    $('#credit_note').hide();
                }
                else if ($('#status').val() == '2') {
                    $('#receipt_no').hide();
                    $('#credit_note').show();
                }
                else {
                    $('#receipt_no').hide();
                    $('#credit_note').hide();
                }
            }).trigger('change');



            $('#with_spouse').bind('change', function (e) {
                if ($('#with_spouse').val() == '3') {
//                    $('#barcode1').show();
                    $('#barcode2').show();
                    $('#spouse_name').show();
                }
                else if ($('#with_spouse').val() == '4') {
//                    $('#barcode1').show();
                    $('#barcode2').show();
                    $('#spouse_name').show();
                }
                else {
//                    $('#barcode1').hide();
                    $('#barcode2').hide();
                    $('#spouse_name').hide();
                }
            }).trigger('change');

//            $('#spouse_name').bind('change', function (e) {
//                if ($('#spouse_name').val() == '1') {
//                    $('#receipt_no').show();
//                    $('#receipt_no').show();
//                }
//
//                else {
//                    $('#receipt_no').hide();
//                    $('#receipt_no').hide();
//                }
//            }).trigger('change');

            $('#participantForm')
                    .find('[name="event_registration_type"]')
                    .selectpicker()
                    .change(function (e) {
                        $('#bootstrapSelectForm').formValidation('revalidateField', 'event_registration_type');
                    })
                    .end()
                    .find('[name="payment_status"]')
                    .selectpicker()
                    .change(function (e) {
                        $('#bootstrapSelectForm').formValidation('revalidateField', 'payment_status');
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
//                            email: {
//                                validators: {
//                                    notEmpty: {
//                                        message: 'The Email in is required'
//                                    },
//                                    emailAddress: {
//                                        message: 'The value is not a valid email address'
//                                    }
//
//                                }
//                            },
//                            address: {
//                                validators: {
//                                    notEmpty: {
//                                        message: 'The address is required'
//                                    }
//                                }
//                            },
//                            mobile_no: {
//                                validators: {
//                                    notEmpty: {
//                                        message: 'The Mobile No is required'
//                                    }
//                                }
//                            },
                            nmc_no: {
                                validators: {
                                    notEmpty: {
                                        message: 'The NMC Number is required'
                                    }
                                }
                            },
                            event_registration_type: {
                                validators: {
                                    notEmpty: {
                                        message: 'The Registration Type is required'
                                    }
                                }
                            },
                            payment_status: {
                                validators: {
                                    notEmpty: {
                                        message: 'The Payment status is required'
                                    }
                                }
                            },

//                            remarks: {
//                                validators: {
//                                    callback: {
//                                        message: 'Please specific the framework',
//                                        callback: function(value, validator, $field) {
//                                            var framework = $('#participantForm').find('[name="payment_status"]:selected').val();
//
//                                            alert(framework);
//                                          return (framework === '2')
//                                            // The field is valid if user picks a given framework from the list
//                                            ? true
//                                                // Otherwise, the field value is required
//                                                    : (value !== '');
//                                        }
//                                    }
//                                }
//                            }


                        }
                    })
                    .on('err.form.fv', function (e) {
                    })
                    .end();
        });

$(document).ready(function(){
            $("$no1").click(function(){
                alert("hello");
            });
        });

    </script>
    <!-- <script type="text/javascript">
        $(document).ready(function(){
            $("$no1").click(function(){
                alert("hello");
            });
        });
    </script> -->
@stop