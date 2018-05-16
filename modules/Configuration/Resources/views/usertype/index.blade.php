@extends('admin.layout.app')

@section('title', 'User Type')

@section('main')
    <ol class="breadcrumb" style="margin-bottom: 5px;">
        <li><a href="{{ route('admin.dashboard') }}">Home</a></li>
        <li class="active">User Types</li>
    </ol>

    <div class="container">
        <div class="block-header">
            <h2>User Types</h2>
        </div>

        <div class="card">
            <div class="card-header">
                @if(Access::hasAccess('user-type', 'access_add'))
                    <a href="{{ route('admin.usertype.add') }}" class="btn btn-primary waves-effect">Add New</a>
                @endif
            </div>

            <div class="card-body table-responsive">
                <table class="table">
                    <thead>
                    <tr>
                        <th>S N</th>
                        <th>User Type</th>
                        @if(Access::hasAccess('user-type', 'access_publish'))
                            <th>Published</th>
                        @endif
                        @if(Access::hasAccess('user-type', 'access_delete') || Access::hasAccess('user-type', 'access_update'))
                            <th>Action</th>
                        @endif
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($user_types as $index=>$user_type)
                        <tr>
                            <td>{{ ++$index }}</td>
                            <td>{{ $user_type->user_type_name }}</td>
                            @if(Access::hasAccess('user-type', 'access_publish'))
                                <td>
                                    @if($user_type->editable == 1)
                                        @if($user_type->is_active == 1)
                                            <a href="#" class="change-status" id="{!! $user_type->id !!}"><i
                                                        class="zmdi zmdi-check-circle zmdi-hc-fw"></i></a>
                                        @else
                                            <a href="#" class="change-status" id="{!! $user_type->id !!}"><i
                                                        class="zmdi zmdi-lock zmdi-hc-fw"></i></a>
                                        @endif
                                    @endif
                                </td>
                            @endif
                            <td>
                                @if(Access::hasAccess('user-type', 'access_delete') || Access::hasAccess('user-type', 'access_update'))
                                    @if($user_type->editable == 1)
                                        @if(Access::hasAccess('user-type', 'access_update'))
                                            <a href="{{ route('admin.usertype.edit', $user_type->id) }}"><i
                                                        class="zmdi zmdi-edit zmdi-hc-fw"></i>Edit </a>
                                        @endif
                                        @if(Access::hasAccess('user-type', 'access_delete'))
                                            <a href="#" class="delete-usertype" id="{!! $user_type->id !!}"><i
                                                        class="zmdi zmdi-delete zmdi-hc-fw"></i>Delete </a>
                                        @endif
                                        <a href="{{ route('admin.accesslist', $user_type->id) }}"><i
                                                    class="zmdi zmdi-eye zmdi-hc-fw"></i>View Access List</a>
                                    @endif
                                @endif
                            </td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
                {!! $user_types->render() !!}
            </div>
        </div>
    </div>

@stop
@section('footer_js')
    <script type="text/javascript">

        $(document).ready(function () {
            $('.delete-usertype').click(function (event) {
                event.preventDefault();
                $object = this;

                swal({
                    title: "Are you sure?",
                    text: "You will do you want to delete this User Type ?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Yes, delete it!",
                    closeOnConfirm: false
                }, function () {
                    debugger;
                    $.ajax({
                        type: 'POST',
                        url: '{{ route("admin.usertype.delete") }}',
                        data: {id: $object.id, _token: '{!! csrf_token() !!}'},
                        success: function (response) {
                            $($object).parent('td').parent('tr').remove();
                            swal("Deleted!", response.message, "success");
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
                    url: '{{ route("admin.usertype.publish") }}',
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