@extends('admin.layout.app')
@section('title', 'Video Download Management')
@section('main')
    <div class="container">
        <div class="block-header">
            <h2>Video Download Management</h2>
        </div>

        <div class="card">
            <div class="card-header">
                @if(Access::hasAccess('downloads', 'access_add'))
                    <a href="{{ route('admin.download.video.add') }}" class="btn btn-primary waves-effect">Add New</a>
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
                        <th>Category</th>
                        <th>Event</th>
                        <th>File</th>
                        <th>Access Type</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(count($videos)>0)
                        @foreach($videos as $index=>$video)
                            <tr>
                                <td>{{ ++$index }}</td>
                                <td>{{ $video->name }}</td>
                                <td>@foreach (explode(', ', $video->categories) as $singleCategoryKey)
                                        <span class="badge">{{ $categories[$singleCategoryKey] }}</span> &nbsp;
                                    @endforeach</td>
                                <td>
                                    @if($video->event_id !=0)
                                        {{ $video->event->name }}
                                    @else
                                        N/A
                                    @endif

                                </td>
                                <td><a href="{{ $video->download }}" target="_blank">View</a>
                                </td>
                                <td>@if($video->access_type ==1)
                                        Public
                                    @else
                                        Members Only
                                    @endif</td>

                                <td>
                                    @if(Access::hasAccess('downloads', 'access_publish'))
                                        @if($video->is_active == 1)
                                            <a href="#"
                                               class="change-status btn btn-primary btn-icon waves-effect waves-circle waves-float waves-effect waves-circle waves-float"
                                               id="{!! $video->id !!}" data-toggle="tooltip" title="Change Status"><i
                                                        class="zmdi zmdi-check-circle zmdi-hc-fw"></i></a>
                                        @else
                                            <a href="#"
                                               class="change-status btn btn-primary btn-icon waves-effect waves-circle waves-float waves-effect waves-circle waves-float"
                                               id="{!! $video->id !!}" data-toggle="tooltip" title="Change Status"><i
                                                        class="zmdi zmdi-lock zmdi-hc-fw"></i></a>
                                        @endif
                                    @else
                                        @if($video->is_active == 1)
                                            Published
                                        @else
                                            Draft
                                        @endif
                                    @endif
                                    @if(Access::hasAccess('downloads', 'access_update'))
                                        <a href="{{ route('admin.downloads.video.edit',$video->id) }}" title="Edit File"
                                           data-toggle="tooltip"
                                           class="btn btn-success btn-icon waves-effect waves-circle waves-float waves-effect waves-circle waves-float"><i
                                                    class="zmdi zmdi-edit zmdi-hc-fw"></i></a>
                                    @endif
                                    @if(Access::hasAccess('downloads', 'access_delete'))
                                        <a href="#"
                                           class="delete-content btn btn-danger btn-icon waves-effect waves-circle waves-float waves-effect waves-circle waves-float"
                                           id="{!! $video->id !!}"
                                           title="Delete File" data-toggle="tooltip"><i
                                                    class="zmdi zmdi-delete zmdi-hc-fw"></i></a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="7"><h5 style="text-align: center;">No videos added yet.</h5></td>
                        </tr>
                    @endif
                    </tbody>
                </table>
                {!! $videos->render() !!}
            </div>
        </div>
    </div>
@stop
@section('footer_js')
    <script type="text/javascript">
        $(document).ready(function () {
            $('.delete-content').click(function (event) {
                event.preventDefault();
                $object = this;
                swal({
                    title: "Are you sure?",
                    text: "You will do you want to delete this File ?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Yes, delete it!",
                    closeOnConfirm: false
                }, function () {
                    debugger;
                    $.ajax({
                        type: 'POST',
                        url: '{{ route("admin.downloads.delete") }}',
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
                    url: '{{ route("admin.downloads.change_status") }}',
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