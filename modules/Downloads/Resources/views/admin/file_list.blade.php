@extends('admin.layout.app')
@section('title', 'Download Management')
@section('main')
    <div class="container">
        <div class="block-header">
            <h2>File Download Management</h2>
        </div>

        <div class="card">
            <div class="card-header">
                @if(Access::hasAccess('downloads', 'access_add'))
                    <a href="{{ route('admin.download.file.add') }}" class="btn btn-primary waves-effect">Add New</a>
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
                    @if(count($files)>0)
                        @foreach($files as $index=>$file)
                            <tr>
                                <td>{{ ++$index }}</td>
                                <td>{{ $file->name }}</td>
                                <td>@foreach (explode(', ', $file->categories) as $singleCategoryKey)
                                        <span class="badge">{{ $categories[$singleCategoryKey] }}</span> &nbsp;
                                    @endforeach</td>
                                <td>
                                    @if($file->event_id !=0)
                                        {{ $file->event->name }}
                                    @else
                                        N/A
                                    @endif

                                </td>
                                <td><a href="{{ asset('uploads/downloads/'.$file->download) }}" target="_blank">View</a>
                                </td>
                                <td>@if($file->access_type ==1)
                                        Public
                                    @else
                                        Members Only
                                    @endif</td>

                                <td>
                                    @if(Access::hasAccess('downloads', 'access_publish'))
                                        @if($file->is_active == 1)
                                            <a href="#"
                                               class="change-status btn btn-primary btn-icon waves-effect waves-circle waves-float waves-effect waves-circle waves-float"
                                               id="{!! $file->id !!}" data-toggle="tooltip" title="Change Status"><i
                                                        class="zmdi zmdi-check-circle zmdi-hc-fw"></i></a>
                                        @else
                                            <a href="#"
                                               class="change-status btn btn-primary btn-icon waves-effect waves-circle waves-float waves-effect waves-circle waves-float"
                                               id="{!! $file->id !!}" data-toggle="tooltip" title="Change Status"><i
                                                        class="zmdi zmdi-lock zmdi-hc-fw"></i></a>
                                        @endif
                                    @else
                                        @if($file->is_active == 1)
                                            Published
                                        @else
                                            Draft
                                        @endif
                                    @endif
                                    @if(Access::hasAccess('downloads', 'access_update'))
                                        <a href="{{ route('admin.downloads.file.edit',$file->id) }}" title="Edit File"
                                           data-toggle="tooltip"
                                           class="btn btn-success btn-icon waves-effect waves-circle waves-float waves-effect waves-circle waves-float"><i
                                                    class="zmdi zmdi-edit zmdi-hc-fw"></i></a>
                                    @endif
                                    @if(Access::hasAccess('downloads', 'access_delete'))
                                        <a href="#"
                                           class="delete-content btn btn-danger btn-icon waves-effect waves-circle waves-float waves-effect waves-circle waves-float"
                                           id="{!! $file->id !!}"
                                           title="Delete File" data-toggle="tooltip"><i
                                                    class="zmdi zmdi-delete zmdi-hc-fw"></i></a>
                                    @endif
                                </td>
                            </tr>
                            {{----}}
                        @endforeach
                    @else
                        <tr>
                            <td colspan="7"><h5 style="text-align: center;">No file added yet.</h5></td>
                        </tr>
                    @endif
                    </tbody>
                </table>
                {!! $files->render() !!}
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