@extends('admin.layout.app')
@section('title', 'Edit Participant')
@section('header_css')
@stop

@section('main')
    <div class="container">
    <ol class="breadcrumb" style="margin-bottom: 5px;">
        <li><a href="{{ route('admin.dashboard') }}">Home</a></li>
        <li><a href="{{ route('admin.event.index') }}">Events</a></li>
        <li class="active">Update Payment</li>
    </ol>
    <div class="card">
        <div class="card-header">
            <h2>{{ $participant->salutation.' '.$participant->first_name.' '.$participant->last_name  }} Payment Update
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
            <form action="{{ route('admin.event.participant.payment.update',array($event->id,$participant->id)) }}"
                  method="post" class="row"
                  role="form"
                  enctype="multipart/form-data" id="contentForm">

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
                    <button type="submit" class="btn btn-primary btn-sm m-t-5">Update Payment</button>
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