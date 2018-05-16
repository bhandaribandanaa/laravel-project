@extends('admin.layout.app')
@section('title', 'Gallery Management')
@section('main')

    <div class="container">
        <div class="block-header">
            <h2>Why Choose Us?</h2>
        </div>

        <div class="card">
            <div class="card-header">
               
                    <a href="{{ route('admin.choose.add') }}" class="btn btn-primary waves-effect">Add New</a>

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
                        <th>Sub Title</th>
                        <th>Action</th>

                    </tr>
                    </thead>
                    <tbody>
                    @if(count($choose)>0)
                        @foreach($choose as $index=>$choice)
                            <tr>
                                <td>{{ ++$index }}</td>
                                <td>{{ $choice->title }}</a>
                                </td>
                                <td>{{ $choice->subtitle }}</td>
                                <td>
                                        @if($choice->is_active == 1)
                                            <a href="javascript:void(0)"
                                               class="change-status btn btn-primary btn-icon waves-effect waves-circle waves-float waves-effect waves-circle waves-float"
                                               data-toggle="tooltip" title="Change Status"
                                               id="{!! $choice->id !!}"><i
                                                        class="zmdi zmdi-check-circle zmdi-hc-fw"></i></a>
                                        @else
                                            <a href="javascript:void(0)"
                                               class="change-status btn btn-primary btn-icon waves-effect waves-circle waves-float waves-effect waves-circle waves-float"
                                               data-toggle="tooltip" title="Change Status"
                                               id="{!! $choice->id !!}"><i
                                                        class="zmdi zmdi-lock zmdi-hc-fw"></i></a>
                                        @endif
                                   

                                        <a href="{{ route('admin.choose.edit',$choice->id) }}" data-toggle="tooltip"
                                           title="Edit Choose"
                                           class="btn btn-success btn-icon waves-effect waves-circle waves-float waves-effect waves-circle waves-float"
                                           data-placement="top"><i
                                                    class="zmdi zmdi-edit zmdi-hc-fw"></i></a>
                                        <a href="javascript:void(0)"
                                           class="delete btn btn-danger btn-icon waves-effect waves-circle waves-float waves-effect waves-circle waves-float"
                                           id="{!! $choice->id !!}"
                                           data-toggle="tooltip" title="Delete Choose" data-placement="top"><i
                                                    class="zmdi zmdi-delete zmdi-hc-fw"></i></a>
                                </td>
                            </tr>

                        @endforeach
                    @else
                        <tr>
                            <td colspan="4"><h5 style="text-align: center;">No records added yet.</h5></td>
                        </tr>
                    @endif
                    </tbody>
                </table>
                {!! $choose->render() !!}
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
                    text: "Do you want to delete this Question?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Yes, delete it!",
                    closeOnConfirm: false
                }, function () {
                    debugger;
                    $.ajax({
                        type: 'POST',
                        url: '{{ route("admin.choose.delete") }}',
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
                    url: '{{ route("admin.choose.change_status") }}',
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