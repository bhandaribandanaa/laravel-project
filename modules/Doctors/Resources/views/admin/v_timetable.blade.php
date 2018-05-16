@extends('admin.layout.app')
@section('title', 'Timetable Management')
@section('main')


    <div class="container">
        <div class="block-header">
            <h2>{{ $doctor }}'s Timetable</h2>
        </div>

        @if(Session::get('success'))
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <strong>Success!</strong> {{ Session::get('success') }}
            </div>
        @endif

        <div class="card">
            <div class="card-header">
                <a href="{{ route('admin.doctors.addSchedule',[$doctor_id]) }}" class="btn btn-primary">Add New</a>
            </div>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>S N</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Shift</th>
                        <th>Days</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    {{--*/$i=1/*--}}

                    @if(count($unavailable)==2)
                        <tr style="background-color: #ffb3b8k !important">
                            <td>{{ $i++ }}</td>
                            <td>{{ $unavailable[0] }}</td>
                            <td>{{ $unavailable[1] }}</td>
                            <td>Unavailable</td>
                            <td>Unavailable</td>
                            <td>
                                <a href="#" class="delete-unavailable-time btn btn-danger btn-icon waves-effect waves-circle waves-float waves-effect waves-circle waves-float" id="{{ $doctor_id }}"
                                   title="Delete Time" data-toggle="tooltip" ><i
                                            class="zmdi zmdi-delete zmdi-hc-fw"></i></a>
                            </td>
                        </tr>
                    @endif
                    @forelse($timetable as $time)

                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{ $time->start_date }}</td>
                            <td>{{ $time->end_date }}</td>
                            <td>{!! $time->shift !!}</td>

                            <td>{!! $time->days !!}</td>
                            <td>

                                @if($time->status == 1)
                                    <a href="#" class="change-status btn btn-primary btn-icon waves-effect waves-circle waves-float waves-effect waves-circle waves-float" id="{!! $time->id !!}"  data-toggle="tooltip" title="Change Status"><i
                                                class="zmdi zmdi-check-circle zmdi-hc-fw"></i></a>
                                @else
                                    <a href="#" class="change-status btn btn-primary btn-icon waves-effect waves-circle waves-float waves-effect waves-circle waves-float" id="{!! $time->id !!}"  data-toggle="tooltip" title="Change Status"><i
                                                class="zmdi zmdi-lock zmdi-hc-fw"></i></a>
                                @endif

                                <a href="{{ route('admin.doctors.editTime',[$time->id]) }}" title="Edit Time"
                                   data-toggle="tooltip" class="btn btn-success btn-icon waves-effect waves-circle waves-float waves-effect waves-circle waves-float"><i class="zmdi zmdi-edit zmdi-hc-fw"></i></a>
                                <a href="#" class="delete-time btn btn-danger btn-icon waves-effect waves-circle waves-float waves-effect waves-circle waves-float" id="{!! $time->id !!}"
                                   title="Delete Time" data-toggle="tooltip" ><i
                                            class="zmdi zmdi-delete zmdi-hc-fw"></i></a>
                            </td>
                        </tr>

                    @empty
                        <tr>
                            <td colspan="7"><h5 style="text-align: center;">No doctor schedule added yet.</h5></td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
                {!! $timetable->render() !!}

            </div>
        </div>
    </div>


@stop

@section('footer_js')
    <script type="text/javascript">

        $(document).ready(function () {
            $('.delete-time').click(function (event) {
                event.preventDefault();
                $object = this;
//
                swal({
                    title: "Are you sure?",
                    text: "You will do you want to delete this record ?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Yes, delete it!",
                    closeOnConfirm: false
                }, function () {
                    debugger;
                    $.ajax({
                        type: 'POST',
                        url: '{{ route("admin.doctors.timeDelete") }}',
                        data: {id: $object.id, _token: '{!! csrf_token() !!}'},
                        success: function (response) {
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

            $('.delete-unavailable-time').click(function (event) {
                event.preventDefault();
                $object = this;
//
                swal({
                    title: "Are you sure?",
                    text: "You will do you want to delete this record ?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Yes, delete it!",
                    closeOnConfirm: false
                }, function () {
                    $.ajax({
                        type: 'POST',
                        url: '{{ route("admin.doctors.untimeDelete") }}',
                        data: {id: $object.id, _token: '{!! csrf_token() !!}'},
                        success: function (response) {
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

            $('.change-status').click(function (event) {
                event.preventDefault();
                $object = this;
                debugger;
                $.ajax({
                    type: 'POST',
                    url: '{{ route("admin.doctors.change_time_status") }}',
                    data: {id: $object.id, _token: '{!! csrf_token() !!}'},
                    success: function (response) {
                        if (response.is_active == 1) {
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
@stop
