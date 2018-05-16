@extends('admin.layout.app')
@section('title', 'Event Registration Type ')
@section('header_css')
    {!! Html::style('backend/sweetAlert/sweetalert.css') !!}

@stop
@section('main')
    <div class="container">
        <div class="block-header">
            <h2>Event Registration Type</h2>
        </div>

        <div class="card">
            <div class="card-header">
                @if(Access::hasAccess('events-management', 'access_add'))
                    {{--<a href="#"--}}
                    {{--class="left btn btn-primary waves-effect">Add Participants</a>--}}
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
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>S N</th>
                        <th>Name</th>
                        <th>Added On</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(count($registrationTypes)>0)
                        @foreach($registrationTypes as $index=>$registrationType)
                            <tr>
                                <td>{{ ++$index }}</td>
                                <td>{{ $registrationType->name }}</td>
                                <td>{{ $registrationType->created_at }}</td>
                                <td>

                                    {{--@if(Access::hasAccess('events-management', 'access_publish'))--}}
                                        {{--@if($registrationType->is_active == 1)--}}
                                            {{--<a href="javascript:void(0)"--}}
                                               {{--class="change-status btn btn-primary btn-icon waves-effect waves-circle waves-float waves-effect waves-circle waves-float"--}}
                                               {{--data-toggle="tooltip" title="Change Status"--}}
                                               {{--id="{!! $registrationType->id !!}"><i--}}
                                                        {{--class="zmdi zmdi-check-circle zmdi-hc-fw"></i></a>--}}
                                        {{--@else--}}
                                            {{--<a href="javascript:void(0)"--}}
                                               {{--class="change-status btn btn-primary btn-icon waves-effect waves-circle waves-float waves-effect waves-circle waves-float"--}}
                                               {{--data-toggle="tooltip" title="Change Status"--}}
                                               {{--id="{!! $registrationType->id !!}"><i--}}
                                                        {{--class="zmdi zmdi-lock zmdi-hc-fw"></i></a>--}}
                                        {{--@endif--}}
                                    {{--@else--}}
                                        {{--@if($registrationType->is_active == 1)--}}
                                            {{--Published--}}
                                        {{--@else--}}
                                            {{--Draft--}}
                                        {{--@endif--}}
                                    {{--@endif--}}

                                    {{--@if(Access::hasAccess('events-management', 'access_update'))--}}
                                        {{--<a href="#" data-toggle="tooltip"--}}
                                           {{--title="Edit Registration Type" data-placement="top"--}}
                                           {{--class="btn btn-success btn-icon waves-effect waves-circle waves-float waves-effect waves-circle waves-float"><i--}}
                                                    {{--class="zmdi zmdi-edit zmdi-hc-fw"></i></a>--}}
                                    {{--@endif--}}
                                    {{--@if(Access::hasAccess('events-management', 'access_delete'))--}}
                                        {{--<a href="javascript:void(0)"--}}
                                           {{--class="delete-event btn btn-danger btn-icon waves-effect waves-circle waves-float waves-effect waves-circle waves-float"--}}
                                           {{--id="{!! $registrationType->id !!}"--}}
                                           {{--data-toggle="tooltip" title="Delete Event Type" data-placement="top"><i--}}
                                                    {{--class="zmdi zmdi-delete zmdi-hc-fw"></i></a>--}}
                                    {{--@endif--}}

                                    @if(Access::hasAccess('events-management', 'access_view'))
                                        <a href="{{ route('admin.event.register.type.permission',array($eventInfo->id,$registrationType->id)) }}"
                                           title="View Permission"
                                           class="btn btn-success btn-icon waves-effect waves-circle waves-float waves-effect waves-circle waves-float"
                                           data-toggle="tooltip" data-placement="top"><i
                                                    class="zmdi zmdi-eye zmdi-hc-fw"></i></a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="4"><h5 style="text-align: center;">No Registration type added yet.</h5></td>
                        </tr>
                    @endif
                    </tbody>
                </table>

                {!! $registrationTypes->render() !!}
            </div>
        </div>
    </div>
@stop
@section('footer_js')
    {!! Html::script('backend/sweetAlert/sweetalert.min.js') !!}
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
                                        event_id: '',
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

@stop