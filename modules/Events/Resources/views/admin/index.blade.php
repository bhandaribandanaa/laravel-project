@extends('admin.layout.app')
@section('title', 'Event Management')
@section('main')

    <div class="container">
        <div class="block-header">
            <h2>Event Management</h2>
        </div>

        <div class="card">
            <div class="card-header">
                @if(Access::hasAccess('events-management', 'access_add'))
                    <a href="{{ route('admin.event.add') }}" class="btn btn-primary waves-effect">Add New</a>
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
                        <th>Event Type</th>
                        <th>Date</th>
                        {{--<th>No Of Users</th>--}}
                        <th>Action</th>

                    </tr>
                    </thead>
                    <tbody>
                    @if(count($events)>0)
                        @foreach($events as $index=>$event)
                            <tr>
                                <td>{{ ++$index }}</td>
                                <td>{{ $event->name }}</td>
                                <td>{{ $event->eventType->name }}</td>
                                <td>
                                    <?php
                                    $starting = strtotime($event->start_date);
                                    $ending = strtotime($event->end_date);
                                    echo date('d', $starting) . ' - ' . date('d M Y', $ending);;
                                    ?>
                                </td>
                                {{--                                <td>{{ $event->no_of_participants }}</td>--}}

                                <td>
                                    @if(Access::hasAccess('events-management', 'access_publish'))
                                        @if($event->is_active == 1)
                                            <a href="javascript:void(0)"
                                               class="change-status btn btn-primary btn-icon waves-effect waves-circle waves-float waves-effect waves-circle waves-float"
                                               data-toggle="tooltip" title="Change Status"
                                               id="{!! $event->id !!}"><i
                                                        class="zmdi zmdi-check-circle zmdi-hc-fw"></i></a>
                                        @else
                                            <a href="javascript:void(0)"
                                               class="change-status btn btn-primary btn-icon waves-effect waves-circle waves-float waves-effect waves-circle waves-float"
                                               data-toggle="tooltip" title="Change Status"
                                               id="{!! $event->id !!}"><i
                                                        class="zmdi zmdi-lock zmdi-hc-fw"></i></a>
                                        @endif
                                    @else
                                        @if($event->is_active == 1)
                                            Published
                                        @else
                                            Draft
                                        @endif
                                    @endif



                                    @if(Access::hasAccess('events-management', 'access_view'))
                                        <a href="{{ route('admin.event.content.index',$event->id) }}"
                                           class="btn btn-primary btn-icon waves-effect waves-circle waves-float waves-effect waves-circle waves-float"
                                           data-toggle="tooltip" data-placement="top" title="Add/View Event Content"><i
                                                    class="zmdi zmdi-file-plus zmdi-hc-fw"></i></a>
                                    @endif

                                    @if(Access::hasAccess('events-management', 'access_view'))
                                        <a href="{{ route('admin.event.participants', array( $event->id,$event->slug)) }}"
                                           title="View Participants"
                                           class="btn btn-success btn-icon waves-effect waves-circle waves-float waves-effect waves-circle waves-float"
                                           data-toggle="tooltip" data-placement="top"><i
                                                    class="zmdi zmdi-eye zmdi-hc-fw"></i></a>
                                    @endif


                                    @if(Access::hasAccess('events-management', 'access_view'))
                                        <a href="{{ route('admin.event.participant.download',array($event->id,$event->slug)) }}"
                                           class="btn btn-info btn-icon waves-effect waves-circle waves-float waves-effect waves-circle waves-float"
                                           data-toggle="tooltip" data-placement="top" title="Download All Participants"><i
                                                    class="zmdi zmdi-download zmdi-hc-fw"></i></a>
                                    @endif
                                    @if(Access::hasAccess('events-management', 'access_view'))
                                        <a href="{{ route('admin.event.participants.attendance',array($event->id,$event->slug)) }}"
                                           class="btn btn-success btn-icon waves-effect waves-circle waves-float waves-effect waves-circle waves-float"
                                           data-toggle="tooltip" data-placement="top" title="View Attendance"><i
                                                    class="zmdi zmdi-spellcheck zmdi-hc-fw"></i></a>
                                    @endif

                                    @if(Access::hasAccess('events-management', 'access_view'))
                                        <a href="{{ route('admin.event.participant.unassigned.barcode.download',$event->id) }}"
                                           class="btn btn-info btn-icon waves-effect waves-circle waves-float waves-effect waves-circle waves-float"
                                           data-toggle="tooltip" data-placement="top"
                                           title="Download Unassigned Barcode"><i
                                                    class="zmdi zmdi-download zmdi-hc-fw"></i></a>
                                    @endif

                                    @if(Access::hasAccess('events-management', 'access_view'))
                                        <a href="{{ route('admin.event.participant.barcode.download',$event->id) }}"
                                           class="btn btn-success btn-icon waves-effect waves-circle waves-float waves-effect waves-circle waves-float"
                                           data-toggle="tooltip" data-placement="top"
                                           title="Download All Assigned Barcode"><i
                                                    class="zmdi zmdi-download zmdi-hc-fw"></i></a>
                                    @endif

                                    @if(Access::hasAccess('events-management', 'access_update'))
                                        <a href="{{ route('admin.event.edit',$event->id) }}" data-toggle="tooltip"
                                           title="Edit Event" data-placement="top"
                                           class="btn btn-success btn-icon waves-effect waves-circle waves-float waves-effect waves-circle waves-float"><i
                                                    class="zmdi zmdi-edit zmdi-hc-fw"></i></a>
                                    @endif
                                    @if(Access::hasAccess('events-management', 'access_delete'))
                                        <a href="javascript:void(0)"
                                           class="delete-event btn btn-danger btn-icon waves-effect waves-circle waves-float waves-effect waves-circle waves-float"
                                           id="{!! $event->id !!}"
                                           data-toggle="tooltip" title="Delete Event" data-placement="top"><i
                                                    class="zmdi zmdi-delete zmdi-hc-fw"></i></a>
                                    @endif


                                </td>
                            </tr>

                        @endforeach
                    @else
                        <tr>
                            <td colspan="6"><h5 style="text-align: center;">No Event added yet.</h5></td>
                        </tr>
                    @endif
                    </tbody>
                </table>
                {!! $events->render() !!}
            </div>
        </div>
    </div>
@stop
@section('footer_js')
    <script type="text/javascript">

        $(document).ready(function () {
            $('.delete-event').click(function (event) {
                event.preventDefault();
                $object = this;
                swal({
                    title: "Are you sure?",
                    text: "You will do you want to delete this Event ?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Yes, delete it!",
                    closeOnConfirm: false
                }, function () {
                    debugger;
                    $.ajax({
                        type: 'POST',
                        url: '{{ route("admin.event.delete") }}',
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

            $('.change-status').click(function (event) {
                event.preventDefault();
                $object = this;
                debugger;
                $.ajax({
                    type: 'POST',
                    url: '{{ route("admin.event.change_status") }}',
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