@extends('admin.layout.app')
@section('title', 'Appointments')
@section('header_css')
    <style>

        div.text-container {
            margin: 0 auto;
            width: 75%;
        }

        .text-content{
            line-height: 1em;
        }

        .short-text {
            overflow: hidden;
            height: 2em;
        }

        .full-text{
            height: auto;
        }

        h1 {
            font-size: 24px;
        }

        .show-more {
            padding: 10px 0;
            text-align: center;
        }
        .cardstyle ul li a{ background: #fff;color: #717171;}

    </style>

    {!! Html::style('backend/sweetAlert/sweetalert.css') !!}
    {!! Html::style('backend/sweetAlert/swal-forms.css') !!}
    {!! Html::style('backend/css/dataTables.material.min.css') !!}
    {!! Html::style('backend/css/material.min.css') !!}
    {!! Html::style('backend/plugins/bootstrap-select/dist/css/bootstrap-select.css') !!}
    {!! Html::style('datepicker.min.css') !!}

@stop

@section('main')
    <div class="container">
        <div class="block-header">
            <h2>Confirmed Bookings</h2>
        </div>

        <div class="card cardstyle" style="margin-bottom:0;">
            <div class="card-header ch-alt ">
                <ul class="nav nav-pills nav-justified row">
                    <li class=" col-xs-12 col-sm-4 col-md-4 active"><a href="{{ route('admin.appointments.packages') }}">Confirmed</a></li>
                    <li class="col-xs-12 col-sm-4 col-md-4"><a href="{{ route('admin.appointments.successfulPackages') }}">Successful</a></li>
                    <li class="col-xs-12 col-sm-4 col-md-4"><a href="{{ route('admin.appointments.pendingPackages') }}">Requests</a></li>
                    <a class="manuallink" href="{{ route('admin.appointments.manualBooking') }}">
                        <i class="fa fa-plus-circle" aria-hidden="true"></i>
                    </a>
                </ul>
            </div>
        </div>


        <div class="card cardstyle">


            <form action="" method="get">

                <div class="card-body card-padding" style="padding-bottom:0;">
                    <div class="row">
                        <div class="col-sm-3 course-div">
                            <div class="form-group fg-float fg-toggled">
                                <div class="fg-line">
                                    {{--*/$doctors = Helpers::getAllDoctors()/*--}}
                                    <select name="doctor" id="" class="selectpicker" data-live-search="true">
                                        <option value="" @if($doctor_selected == "") selected @endif>Select Doctor</option>
                                        @forelse($doctors as $doc)
                                            <option value="{{$doc->id}}" @if($doctor_selected == $doc->id) selected @endif>{{$doc->full_name}}</option>
                                        @empty
                                            No doctors present.
                                        @endforelse
                                    </select>

                                </div>
                            </div>
                        </div>

                        <div class="col-sm-offset-4 col-sm-4 course-div dateselector">
                            <div class="">
                                <div>
                                    Select Date: <input type="text" name="date"  id="datepicker" @if($date_selected != "") value="{{ $date_selected }}" @endif>


                                </div>
                            </div>
                        </div>
                        <div class="col-sm-1">
                            <!--<input type="submit" class="" value="Filter">-->
                            <button type="submit" class="btn btn-primary waves-effect">Filter</button>
                        </div>


                    </div>
                </div>
            </form>



            <div class="table-responsive">
                <table class="table table-striped datatable">
                    <thead>
                    <tr>
                        <th>S N</th>
                        <th>Patient Name</th>
                        <th>Doctor</th>
                        <th>Package</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    {{--*/$i=1/*--}}
                    @forelse($conf_app as $app)

                        <tr>
                            <td>{{ $i }}</td>
                            <td>{{ $app->f_name }}</td>
                            <td>{{ $app->doctor }}</td>
                            <td>{{ $app->package }}</td>
                            <td>{{ $app->date }}</td>
                            <td>
                                <a class="btn btn-primary btn-icon waves-effect waves-circle waves-float waves-effect waves-circle waves-float zmdi zmdi-eye" data-toggle="modal" data-target="#myModal{{$i}}"></a>
                                <!-- Modal -->
                                <div id="myModal{{$i++}}" class="modal fade" role="dialog">
                                    <div class="modal-dialog">

                                        <!-- Modal content-->
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title">Appointment Details</h4>
                                            </div>
                                            <div class="modal-body">
                                                <p>Patient Name : {{ $app->f_name }}</p>
                                                <p>Package : {{ $app->package }}</p>
                                                <p>Doctor : {{ $app->doctor }}</p>
                                                <p>Date : {{ $app->date }}</p>
                                                <p>Shift : {{ $app->shift }}</p>
                                                <p>Address : {{ $app->address }}</p>
                                                <p>Mobile : {{ $app->mobile }}</p>
                                                <p>Email : {{ $app->email }}</p>
                                                <p>Message : {!! $app->message !!}</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                @if($app->is_success == 1)
                                    <a href="#" class="change-success btn btn-primary btn-icon waves-effect waves-circle waves-float waves-effect waves-circle waves-float" id="{!! $app->id !!}"  data-toggle="tooltip" title="Switch to Success Mode"><i
                                                class="zmdi zmdi-check-circle zmdi-hc-fw"></i></a>
                                @else
                                    <a href="#" class="change-success btn btn-primary btn-icon waves-effect waves-circle waves-float waves-effect waves-circle waves-float" id="{!! $app->id !!}"  data-toggle="tooltip" title="Switch to Success Mode"><i
                                                class="zmdi zmdi-lock zmdi-hc-fw"></i></a>
                                @endif



                                @if($app->is_confirmed == 1)
                                    <a href="#" class="change-status btn btn-primary btn-icon waves-effect waves-circle waves-float waves-effect waves-circle waves-float" id="{!! $app->id !!}"  data-toggle="tooltip" title="Switch to Pending Mode"><i
                                                class="zmdi zmdi-check-circle zmdi-hc-fw"></i></a>
                                @else
                                    <a href="#" class="change-status btn btn-primary btn-icon waves-effect waves-circle waves-float waves-effect waves-circle waves-float" id="{!! $app->id !!}"  data-toggle="tooltip" title="Switch to Pending Mode"><i
                                                class="zmdi zmdi-lock zmdi-hc-fw"></i></a>
                                @endif

                            </td>
                        </tr>

                    @empty
                        <tr>
                            <td colspan="7"><h5 style="text-align: center;">No doctor records added yet.</h5></td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>

                <div align="center">
                    {!! $conf_app->appends(Input::only('doctor','date'))->render() !!}
                </div>

            </div>
        </div>
    </div>
@stop
@section('footer_js')
    {!! Html::script('backend/sweetAlert/sweetalert.min.js') !!}
    {!! Html::script('backend/plugins/bootstrap-select/dist/js/bootstrap-select.js') !!}
    {!! Html::script('datepicker.min.js') !!}

    {!! Html::script('backend/js/jquery.dataTables.min.js') !!}
    {!! Html::script('backend/js/dataTables.material.min.js') !!}

    <script type="text/javascript">

        $(document).ready(function () {

            $('.change-status').click(function (event) {
                event.preventDefault();
                $object = this;
                $.ajax({
                    type: 'POST',
                    url: '{{ route("admin.appointments.change_statusPackage") }}',
                    data: {id: $object.id, _token: '{!! csrf_token() !!}'},
                    success: function (response) {
                        if (response.is_confirmed == 1) {
                            $($object).html('<i class="zmdi zmdi-check-circle zmdi-hc-fw"></i>');
                        } else {
                            $($object).html('<i class="zmdi zmdi-lock zmdi-hc-fw"></i>');
                        }
                        swal({
                            title: "Success!",
                            text: response.message,
                            imageUrl: AdminAssetPath + "img/thumbs-up.png",
                            timer: 2000,
                            showConfirmButton: false
                        });
                    },
                    error: function (e) {
                        debugger;
                    },
                });
            });

            $('.change-success').click(function (event) {
                event.preventDefault();
                $object = this;
                $.ajax({
                    type: 'POST',
                    url: '{{ route("admin.appointments.change_successPackage") }}',
                    data: {id: $object.id, _token: '{!! csrf_token() !!}'},
                    success: function (response) {
                        if (response.is_success == 1) {
                            $($object).html('<i class="zmdi zmdi-check-circle zmdi-hc-fw"></i>');
                        } else {
                            $($object).html('<i class="zmdi zmdi-lock zmdi-hc-fw"></i>');
                        }
                        swal({
                            title: "Success!",
                            text: response.message,
                            imageUrl: AdminAssetPath + "img/thumbs-up.png",
                            timer: 2000,
                            showConfirmButton: false
                        });
                    },
                    error: function (e) {
                        debugger;
                    },
                });
            });
        });

    </script>


    <script type="text/javascript" language="javascript" class="init">
        $(document).ready(function () {
            $("#datepicker").datepicker({
                format: 'yyyy-mm-dd'
            });

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