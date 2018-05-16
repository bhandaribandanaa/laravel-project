@extends('admin.layout.app')
@section('title', 'Edit Participant')
@section('header_css')
@stop

@section('main')
    <div class="container">
    <ol class="breadcrumb" style="margin-bottom: 5px;">
        <li><a href="{{ route('admin.dashboard') }}">Home</a></li>
        <li><a href="{{ route('admin.event.index') }}">Events</a></li>
        <li class="active">Edit Participant</li>
    </ol>
    <div class="card">
        <div class="card-header">
            <h2>Edit Participant
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
            <form action="{{ route('admin.event.participant.edit',array($participant->event->id,$participant->event->slug,$participant->id)) }}"
                  method="post" class="row"
                  role="form"
                  enctype="multipart/form-data" id="contentForm">

                  <div class="col-sm-2">

                    <label class="" for="">Assigned Barcode</label>

                    <div class="input-group form-group">
                        {{$participant->barcode}}
                    </div>

                </div>

                <div class="col-sm-2">

                    <label class="" for="">Salutation</label>

                    <!-- <div class="input-group form-group">
                        {!! Form::select('salutation', array('Mr' => 'Mr', 'Mrs' => 'Mrs','Miss'=>'Miss','Dr'=>'Dr'), $participant->salutation, ['placeholder' => 'Salutation','class'=>'form-control']) !!}
                    </div> -->
                    <div class="input-group form-group">
                        {!! Form::select('salutation', array('Dr' => 'Dr', 'Prof' => 'Prof'), $participant->salutation, ['placeholder' => 'Salutation','class'=>'form-control']) !!}
                    </div>

                </div>
                <div class="col-sm-3">
                    <label class="" for="">First Name </label>

                    <div class="input-group form-group">


                        <input type='text' class="form-control" name="first_name"
                               value="{{ $participant->first_name  }}">

                    </div>

                </div>
                <div class="col-sm-3">

                    <label class="" for="">Middle Name</label>

                    <div class="input-group form-group">
                        <input type='text' class="form-control" name="middle_name"
                               value="{{ $participant->middle_name }}">

                    </div>
                </div>
                <div class="col-sm-3">

                    <label class="" for="">Last Name</label>

                    <div class="input-group form-group">

                        <input type='text' class="form-control" name="last_name"
                               value="{{ $participant->last_name }}">
                    </div>
                </div>


                <div class="col-sm-12">
                    <div class="form-group fg-line">
                        <label class="" for="exampleInputEmail2">Registration Type</label>
                        {!! Form::select('event_registration_type', $event_participants_type, $participant->event_registration_type, ['placeholder' => 'Registration Type','class'=>'form-control']) !!}


                    </div>
                </div>


                <div class="col-sm-12">
                    <div class="form-group fg-line">
                        <label class="" for="">Address</label>
                        <input type="text" class="form-control input-sm" name="address" id=""
                               placeholder="Enter address" value="{{ $participant->address }}">
                    </div>
                </div>

                <div class="col-sm-12">
                    <div class="form-group fg-line">
                        <label class="" for="">Phone No</label>
                        <input type="text" class="form-control input-sm" name="phone_no" id=""
                               placeholder="Enter phone no" value="{{ $participant->phone_no }}">
                    </div>
                </div>

                <div class="col-sm-12">

                    <div class="form-group fg-line">
                        <label class="" for="">Mobile No</label>
                        <input type="text" class="form-control input-sm" name="mobile_no" id=""
                               placeholder="Enter mobile no" value="{{ $participant->mobile_no }}">
                    </div>
                </div>
                <div class="col-sm-12">

                    <div class="form-group fg-line">
                        <label class="" for="">Email</label>
                        <input type="text" class="form-control input-sm" name="email" id=""
                               placeholder="Enter email" value="{{ $participant->email }}">
                    </div>
                </div>

                <div class="col-sm-12">

                    <div class="form-group fg-line">
                        <label class="" for="">Organization</label>
                        <input type="text" class="form-control input-sm" name="organization" id=""
                               placeholder="Enter organization" value="{{ $participant->organization }}">
                    </div>
                </div>

                <div class="col-sm-12">

                    <div class="form-group fg-line">
                        <label class="" for="">Designation</label>
                        <input type="text" class="form-control input-sm" name="designation" id=""
                               placeholder="Enter organization" value="{{ $participant->designation }}">
                    </div>
                </div>

                <div class="col-sm-12">

                    <div class="form-group fg-line">
                        <label class="" for="">Payment Status</label>
                        {!! Form::select('payment_status', array('0' => 'Unpaid', '1' => 'Paid','2'=>'Credit'), $participant->payment_status, ['placeholder' => 'Payment Status','class'=>'form-control status', 'id'=>"status"]) !!}
                    </div>
                </div>

                <div class="col-sm-12" id="credit_note" style="display:none;">
                    <div class="form-group fg-line">
                        <label class="" for="">Credit Note</label>
                        <input type="text" class="form-control input-sm" name="remarks" id=""
                               placeholder="Remarks" value="{{ $participant->remarks }}">
                    </div>
                </div>

                <div class="col-sm-12" id="receipt_no" style="display:none;">
                    <div class="form-group fg-line">
                        <label class="" for="">Receipt No.</label>
                        <input type="text" class="form-control input-sm" name="receipt_no" id=""
                               placeholder="Receipt No." value="{{ $participant->receipt_no }}">
                    </div>
                </div>

                <div class="clearfix"></div>
                {!! csrf_field() !!}
                <div class="col-sm-4">
                    <button type="submit" class="btn btn-primary btn-sm m-t-5">Update Participant</button>
                </div>
            </form>
        </div>
    </div>
        </div>
@stop
@section('footer_js')
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
        });
    </script>
@stop