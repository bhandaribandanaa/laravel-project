@extends('admin.layout.app')
@section('title', 'Banner Management')
@section('main')

    <div class="container">
        <div class="block-header">
            <h2>Banner Management</h2>
        </div>

        <div class="card">
            <div class="card-header">
                @if(Access::hasAccess('gallery-management', 'access_add'))
                    <a href="{{ route('admin.banner.add') }}" class="btn btn-primary waves-effect">Add New</a>
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
                        <th>Image</th>
                        <th>URL</th>
                        <th>Action</th>

                    </tr>
                    </thead>
                    <tbody>
                    @if(count($banners)>0)
                        @foreach($banners as $banner)
                            <tr>
                                <td>{{ $banner->id }}</td>
                                <td>{{ $banner->title }} </td>
                                <td>@if($banner->image && file_exists('uploads/banner/'. $banner->image))
                                        <div class="fileinput fileinput-new" data-provides="fileinput">
                                            <div class="fileinput-preview thumbnail" data-trigger="fileinput">
                                        <img src="{{URL::asset('uploads/banner/'. $banner->image) }}">
                                        </div></div>
                                    @endif
                                </td>
                                <td>{{ $banner->url }}</td>
                                <td>
                                    @if(Access::hasAccess('gallery-management', 'access_publish'))
                                        @if($banner->is_active == 1)
                                            <a href="javascript:void(0)" class="change-status btn btn-primary btn-icon waves-effect waves-circle waves-float waves-effect waves-circle waves-float" data-toggle="tooltip" title="Change Status"
                                               id="{!! $banner->id !!}"><i
                                                        class="zmdi zmdi-check-circle zmdi-hc-fw"></i></a>
                                        @else
                                            <a href="javascript:void(0)" class="change-status btn btn-primary btn-icon waves-effect waves-circle waves-float waves-effect waves-circle waves-float" data-toggle="tooltip" title="Change Status"
                                               id="{!! $banner->id !!}"><i
                                                        class="zmdi zmdi-lock zmdi-hc-fw"></i></a>
                                        @endif
                                    @else
                                        @if($banner->is_active == 1)
                                            Published
                                        @else
                                            Draft
                                        @endif
                                    @endif

                                    @if(Access::hasAccess('gallery-management', 'access_update'))
                                        <a href="{{ route('admin.banner.edit',$banner->id) }}" data-toggle="tooltip"
                                           title="Edit Banner" data-placement="top" class="btn btn-success btn-icon waves-effect waves-circle waves-float waves-effect waves-circle waves-float" ><i
                                                    class="zmdi zmdi-edit zmdi-hc-fw"></i></a>
                                    @endif
                                    @if(Access::hasAccess('gallery-management', 'access_delete'))
                                        <a href="javascript:void(0)" class="delete btn btn-danger btn-icon waves-effect waves-circle waves-float waves-effect waves-circle waves-float" id="{!! $banner->id !!}"
                                           data-toggle="tooltip" title="Delete Banner" data-placement="top"><i
                                                    class="zmdi zmdi-delete zmdi-hc-fw"></i></a>
                                    @endif
                                </td>
                            </tr>

                        @endforeach
                    @else
                        <tr>
                            <td colspan="5"><h5 style="text-align: center;">No Banner added yet.</h5></td>
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
            $('.delete').click(function (event) {
                event.preventDefault();
                $object = this;
                swal({
                    title: "Are you sure?",
                    text: "Do you want to delete this Banner ?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Yes, delete it!",
                    closeOnConfirm: false
                }, function () {
                    debugger;
                    $.ajax({
                        type: 'POST',
                        url: '{{ route("admin.banner.delete") }}',
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
                    url: '{{ route("admin.banner.change_status") }}',
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