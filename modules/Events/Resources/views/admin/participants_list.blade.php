@extends('admin.layout.app')
@section('title', $event->name.'&#39;s Participants')
@section('header_css')
    {!! Html::style('backend/sweetAlert/sweetalert.css') !!}
    {!! Html::style('backend/sweetAlert/swal-forms.css') !!}
    {!! Html::style('backend/css/dataTables.material.min.css') !!}
    {!! Html::style('backend/css/material.min.css') !!}
@stop
@section('main')
    <div class="container">
        <div class="block-header">
            <h2>{{ $event->name.'&#39;s Participants' }}</h2>
        </div>


        <div class="card">
            {!! Form::open(array('files' => true, 'class' => '', 'id' => '', 'method' => 'get')) !!}

            <div class="card-body card-padding">
                <div class="row">
                    <div class="col-sm-3 course-div">
                        <div class="form-group fg-float fg-toggled">
                            <div class="fg-line">
                                {!!   Form::select('payment_status', array('1' => 'Paid', '2' => 'Credit', '3' => 'Unpaid'), (Input::get('payment_status')) ? Input::get('payment_status') : "", ['placeholder' => 'Choose payment status',"class"=>"form-control fg-input"]) !!}

                            </div>
                            {{--                            {!!  Form::label('payment_status', 'Payment  Status', array('class'=>'fg-label')) !!}--}}
                        </div>
                    </div>

                    <div class="col-sm-4 course-div">
                        <div class="form-group fg-float fg-toggled">
                            <div class="fg-line">
                                {!! Form::select('event_registration_type', $event_registration_type, (Input::get('event_registration_type')) ? Input::get('event_registration_type') : "", array("class"=>"form-control fg-input", 'id'=>'event_registration_type')) !!}

                            </div>
                            {{--                            {!!  Form::label('event_registration_type', 'Registration Type', array('class'=>'fg-label')) !!}--}}
                        </div>
                    </div>


                    <div class="col-md-3 actionbtns">

                        {!! Form::submit('SUBMIT',array('class' => 'btn btn-primary waves-effect','style'=>'background-color: #2196f3;')) !!}{!! Form::close() !!}
                    </div>

                    {{--<div class="col-md-3 actionbtns">--}}
                        {{--<a href="{{ route('admin.event.participant.barcode.download',$event->id) }}"--}}
                           {{--class="btn btn-primary btn-lg waves-effect">--}}
                            {{--Download Barcode--}}
                        {{--</a>--}}
                    {{--</div>--}}
                    {{--<div class="col-md-2 actionbtns">--}}

                        {{--<a href="{{ route('admin.event.participants.attendance',array($event->id,$event->slug)) }}"--}}
                           {{--class="btn btn-primary btn-lg waves-effect">--}}
                            {{--Attendance--}}
                        {{--</a>--}}
                    {{--</div>--}}
                </div>
            </div>

        </div>


        <div class="card">
            <div class="card-header">
                @if(Access::hasAccess('events-management', 'access_add'))
                    <a href="{{ route('admin.event.participants.add',array($event->id,$event->slug)) }}"
                       class="left btn btn-primary waves-effect">Add Participants</a>
                @endif
            </div>

            <?php $success = Session::get('success'); ?>
            @if($success)
                <div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                aria-hidden="true">×</span></button>
                    {{ $success }}
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-striped datatable">
                    <thead>
                    <tr>
                        <th>S N</th>
                        <th>Name</th>
                        <th>Register Type</th>
                        {{--<th>Mobile No.</th>--}}
                        {{--<th>Email</th>--}}
                        {{--<th>Orgn</th>--}}
                        <th>Payment Status</th>
                        <th>Receipt /Remarks</th>
                        {{--<th>Remarks</th>--}}
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(count($participants)>0)
                        @foreach($participants as $index=>$participant)
                            <tr>
                                <td>{{ ++$index }}</td>
                                <td>{{ $participant->salutation.' '.$participant->first_name.' '.$participant->middle_name.' '.$participant->last_name }}</td>
                                <td> {{ $participant->eventRegistrationType->name }}</td>
                                {{--<td>{{ $participant->mobile_no }}</td>--}}
                                {{--<td>{{ $participant->email }}</td>--}}
                                {{--<td>{{ $participant->organization }}</td>--}}
                                <td>

                                    @if($participant->payment_status == 0)
                                        Unpaid
                                    @elseif($participant->payment_status == 1)
                                        Paid
                                    @elseif($participant->payment_status == 2)
                                        Credit
                                    @else
                                        N/A
                                    @endif
                                </td>
                                <td>
                                    @if($participant->payment_status == 1)
                                        {{ $participant->receipt_no }}
                                    @elseif($participant->payment_status == 2)
                                        {{ $participant->remarks }}
                                    @endif
                                </td>

                                {{--                                <td>{{ $participant->receipt_no }}</td>--}}
                                {{--                                <td>{{ $participant->remarks }}</td>--}}
                                <td>
                                    <a href="{{ route('admin.event.participant.edit',array($event->id,$event->slug,$participant->id)) }}"
                                       title="Edit Participant" data-toggle="tooltip"
                                       class="btn btn-success btn-icon waves-effect waves-circle waves-float waves-effect waves-circle waves-float"><i
                                                class="zmdi zmdi-edit zmdi-hc-fw"></i></a>
                                    <a href="{{ route('admin.event.participant.payment.update',array($event->id,$participant->id)) }} "
                                       title="Change Payment Status"
                                       class="btn btn-primary btn-icon waves-effect waves-circle waves-float waves-effect waves-circle waves-float"
                                       data-toggle="tooltip" id="{{ $participant->id }}"><i
                                                class="zmdi zmdi zmdi-swap zmdi-hc-fw"></i></a>
                                    <a href="javascript:void(0)"
                                       class="delete-participant btn btn-danger btn-icon waves-effect waves-circle waves-float waves-effect waves-circle waves-float"
                                       title="Delete Participant"
                                       data-toggle="tooltip" id="{{ $participant->id }}"><i
                                                class="zmdi zmdi-delete zmdi-hc-fw"></i></a>
                                    <a href="javascript:void(0) " title="Assign New Barcode"
                                       class="change-barcode btn btn-success btn-icon waves-effect waves-circle waves-float waves-effect waves-circle waves-float"
                                       data-toggle="tooltip" id="{{ $participant->id }}"><i
                                                class="zmdi zmdi-assignment-returned"></i></a>
                                    {{--<a href="{{ route('admin.event.participant.ticket.download',array($participant->id,$participant->event_id)) }}"--}}
                                       {{--title="Download Barcode" data-toggle="tooltip"--}}
                                       {{--class="btn btn-primary btn-icon waves-effect waves-circle waves-float waves-effect waves-circle waves-float"><i--}}
                                                {{--class="zmdi zmdi-download zmdi-hc-fw"></i></a>--}}
                                </td>
                            </tr>

                        @endforeach
                    @else
                        <tr>
                            <td colspan="7"><h5 style="text-align: center;">No participants registered yet.</h5></td>
                        </tr>
                    @endif
                    </tbody>
                </table>

                {!! str_replace('/?', '?', $participants->appends(Input::only('payment_status','event_registration_type'))->render()) !!}

            </div>
        </div>
    </div>
@stop
@section('footer_js')
    {!! Html::script('backend/sweetAlert/sweetalert.min.js') !!}
    {!! Html::script('backend/js/jquery.dataTables.min.js') !!}
    {!! Html::script('backend/js/dataTables.material.min.js') !!}

    <script type="text/javascript">

        $(document).ready(function () {
            $('.delete-participant').click(function (event) {
                event.preventDefault();
                $object = this;
                swal({
                    title: "Are you sure?",
                    text: "You will do you want to delete this Participant ?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Yes, delete it!",
                    closeOnConfirm: false
                }, function () {
                    debugger;
                    $.ajax({
                        type: 'POST',
                        url: '{{ route("admin.event.participant.delete") }}',
                        data: {id: $object.id, _token: '{!! csrf_token() !!}'},
                        success: function (response) {
                            debugger;
                            if (response.status == true) {
                                $($object).parent('td').parent('tr').remove();
                                swal("Deleted!", response.message, "success");
                            }
                            else {

                                swal("Error !", response.message, "error");
                            }

                        },
                        error: function (e) {
                            swal("Error !", response.message, "error");
                        },
                    });
                });
            });
            $('.change-barcode').click(function (event) {
                event.preventDefault();
                $object = this;
                swal({
                            title: "Assign Barcode",
                            text: "Barcode:",
                            type: "input",
                            showCancelButton: true,
                            closeOnConfirm: false,
                            animation: "slide-from-top",
                            inputPlaceholder: "New Barcode number"
                        },
                        function (inputValue) {
                            if (inputValue === false) return false;
                            if (inputValue === "") {
                                swal.showInputError("Barcode number is required");
                                return false
                            } else {
                                debugger;
                                $.ajax({
                                    type: 'POST',
                                    url: '{{ route("admin.event.participant.update.barcode") }}',
                                    data: {
                                        id: $object.id,
                                        event_id: '{{$event->id}}',
                                        barcode: inputValue,
                                        _token: '{!! csrf_token() !!}'
                                    },
                                    success: function (response) {
                                        debugger;
                                        if (response.status == true) {
                                            swal("Updated !", response.message, "success");
                                        }
                                        else {
                                            swal("Error !", response.message, "error");
                                        }
                                    },
                                    error: function (e) {
                                        swal("Error !", response.message, "error");
                                    },
                                });
                            }
                        });
            });
        });
    </script>
    <script type="text/javascript" language="javascript" class="init">
        $(document).ready(function () {

            $('.datatable').DataTable({
                columnDefs: [
                    {
                        targets: [0, 1, 2],
                        className: 'mdl-data-table__cell--non-numeric'
                    }
                ]
            });

            $("#data-table-basic").bootgrid({
                css: {
                    icon: 'zmdi icon',
                    iconColumns: 'zmdi-view-module',
                    iconDown: 'zmdi-expand-more',
                    iconRefresh: 'zmdi-refresh',
                    iconUp: 'zmdi-expand-less'
                },

            });
        });
    </script>
@stop