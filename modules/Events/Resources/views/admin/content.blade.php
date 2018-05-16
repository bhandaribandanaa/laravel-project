@extends('admin.layout.app')
@section('title', 'Event Management')
@section('main')

    <div class="container">
        <div class="block-header">
            <h2>{{ $event->name }}</h2>
        </div>

        <div class="card">
            <div class="card-header">
                @if(Access::hasAccess('events-management', 'access_add'))
                    <a href="{{ route('admin.event.content.add',$event->id) }}" class="btn btn-primary waves-effect">Add
                        New</a>
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
                        <th>Title</th>
                        <th>Added on</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(count($event->contents)>0)
                        @foreach($event->contents as $index=>$content)
                            <tr>
                                <td>{{ ++$index }}</td>
                                <td>{{ $content->title }}</td>
                                <td>{{ $content->created_at }}</td>
                                <td>
                                    @if(Access::hasAccess('events-management', 'access_publish'))
                                        @if($content->is_active == 1)
                                            <a href="javascript:void(0)"
                                               class="change-status btn btn-primary btn-icon waves-effect waves-circle waves-float waves-effect waves-circle waves-float"
                                               id="{!! $content->id !!}"><i
                                                        class="zmdi zmdi-check-circle zmdi-hc-fw"></i></a>
                                        @else
                                            <a href="javascript:void(0)"
                                               class="change-status btn btn-primary btn-icon waves-effect waves-circle waves-float waves-effect waves-circle waves-float"
                                               id="{!! $content->id !!}"><i
                                                        class="zmdi zmdi-lock zmdi-hc-fw"></i></a>
                                        @endif
                                    @else
                                        @if($content->is_active == 1)
                                            Published
                                        @else
                                            Draft
                                        @endif
                                    @endif

                                    @if(Access::hasAccess('events-management', 'access_update'))
                                        <a href="{{ route('admin.event.content.edit',array($event->id,$content->id)) }}"
                                           data-toggle="tooltip"
                                           class="btn btn-success btn-icon waves-effect waves-circle waves-float waves-effect waves-circle waves-float"
                                           title="Edit Event Content" data-placement="top"><i
                                                    class="zmdi zmdi-edit zmdi-hc-fw"></i></a>
                                    @endif
                                    @if(Access::hasAccess('events-management', 'access_delete'))
                                        <a href="javascript:void(0)"
                                           class="delete-event btn btn-danger btn-icon waves-effect waves-circle waves-float waves-effect waves-circle waves-float"
                                           id="{!! $content->id !!}"
                                           data-toggle="tooltip" title="Delete Event Content" data-placement="top"><i
                                                    class="zmdi zmdi-delete zmdi-hc-fw"></i></a>
                                    @endif
                                </td>


                            </tr>

                        @endforeach
                    @else
                        <tr>
                            <td colspan="4"><h5 style="text-align: center;">No content added yet.</h5></td>
                        </tr>
                    @endif
                    </tbody>
                </table>

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
                    text: "Do you want to delete this Content ?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Yes, delete it!",
                    closeOnConfirm: false
                }, function () {
                    debugger;
                    $.ajax({
                        type: 'POST',
                        url: '{{ route("admin.event.content.delete") }}',
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
                    url: '{{ route("admin.event.content.change_status") }}',
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