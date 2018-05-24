@extends('admin.layout.app')
@section('title', 'Testimonial Management')
@section('main')

    <div class="container">
        <div class="block-header">
            <h2>Testimonial Management</h2>
        </div>

        <div class="card">
            <div class="card-header">
                @if(Access::hasAccess('testimonial-management', 'access_add'))
                    <a href="{{ route('admin.testimonial.add') }}" class="btn btn-primary waves-effect">Add New</a>
                @endif
            </div>

            <div class="table-responsive">

                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>S N</th>
                        <th>Name</th>
                        <th>Company Name</th>
                        <th>Rating</th>
                        <th>Image</th>
                        <th>Description</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(count($testimonials)>0)
                        @foreach($testimonials as $index=>$testimonial)
                            <tr>
                                <td>{{ ++$index }}</td>
                                <td>{{ $testimonial->heading }}</td>
                                {{--<td>{{ count($testimonial->children) }}</td>--}}
                                {{--<td>{{ count($testimonial->children) }}</td>--}}
                                <td>{{ $testimonial->parent['heading'] }}</td>
                                <td>
                                    @foreach (explode(', ', $testimonial->display_in) as $singleMenuKey)
                                        <span class="badge">{{ $menu_array[$singleMenuKey] }}</span> &nbsp;
                                    @endforeach
                                </td>
                                <td>{{ $testimonial->order_postition }}</td>
                                <td>{{ $testimonial->view_count }}</td>
                                <td>
                                    @if(Access::hasAccess('testimonial-management', 'access_publish'))
                                        @if($testimonial->is_active == 1)
                                            <a href="#" class="change-status btn btn-primary btn-icon waves-effect waves-circle waves-float waves-effect waves-circle waves-float" id="{!! $testimonial->id !!}"  data-toggle="tooltip" title="Change Status"><i
                                                        class="zmdi zmdi-check-circle zmdi-hc-fw"></i></a>
                                        @else
                                            <a href="#" class="change-status btn btn-primary btn-icon waves-effect waves-circle waves-float waves-effect waves-circle waves-float" id="{!! $testimonial->id !!}"  data-toggle="tooltip" title="Change Status"><i
                                                        class="zmdi zmdi-lock zmdi-hc-fw"></i></a>
                                        @endif
                                    @else
                                        @if($testimonial->is_active == 1)
                                            Published
                                        @else
                                            Draft
                                        @endif
                                    @endif

                                    @if(Access::hasAccess('testimonial-management', 'access_update'))
                                        <a href="{{ route('admin.testimonial.edit',$testimonial->id) }}" title="Edit Testimonial"
                                           data-toggle="tooltip" class="btn btn-success btn-icon waves-effect waves-circle waves-float waves-effect waves-circle waves-float"><i class="zmdi zmdi-edit zmdi-hc-fw"></i></a>
                                    @endif
                                    @if(Access::hasAccess('testimonial-management', 'access_delete'))
                                        <a href="#" class="delete-testimonial btn btn-danger btn-icon waves-effect waves-circle waves-float waves-effect waves-circle waves-float" id="{!! $testimonial->id !!}"
                                           title="Delete Testimonial" data-toggle="tooltip" ><i
                                                    class="zmdi zmdi-delete zmdi-hc-fw"></i></a>
                                    @endif
                                </td>
                            </tr>

                        @endforeach
                    @else
                        <tr>
                            <td colspan="7"><h5 style="text-align: center;">No testimonial added yet.</h5></td>
                        </tr>
                    @endif
                    </tbody>
                </table>
                {!! $testimonials->render() !!}
            </div>
        </div>
    </div>
@stop
@section('footer_js')
    <script type="text/javascript">

        $(document).ready(function () {
            $('.delete-testimonial').click(function (event) {
                event.preventDefault();
                $object = this;
//
                swal({
                    title: "Are you sure?",
                    text: "You will do you want to delete this Testimonial ?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Yes, delete it!",
                    closeOnConfirm: false
                }, function () {
                    debugger;
                    $.ajax({
                        type: 'POST',
                        url: '{{ route("admin.testimonial.delete") }}',
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
                    url: '{{ route("admin.testimonial.change_status") }}',
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