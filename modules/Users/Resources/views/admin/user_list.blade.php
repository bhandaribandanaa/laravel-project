@extends('admin.layout.app')
@section('title', 'Users')
@section('footer_js')
    <script type="text/javascript">

        $(document).ready(function () {
            $('.delete').click(function (event) {
                event.preventDefault();
                $object = this;
                swal({
                    title: "Are you sure?",
                    text: "Do you want to delete this User ?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Yes, delete it!",
                    closeOnConfirm: false
                }, function () {
                    debugger;
                    $.ajax({
                        type: 'POST',
                        url: '{{ route("admin.user.delete") }}',
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
                    url: '{{ route("admin.user.change_status") }}',
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
@endsection
@section('main')

    <ol class="breadcrumb" style="margin-bottom: 5px;">
        <li><a href="{{ route('admin.dashboard') }}">Home</a></li>
        <li class="active">Users</li>
    </ol>

    <div class="container">
        <div class="block-header">
            <h2>Users</h2>
        </div>

        <div class="card">
            <div class="card-header">
                @if(Access::hasAccess('users', 'access_add'))
                    <a href="{{ route('admin.users.add') }}" class="btn btn-primary waves-effect">Add User</a>
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
                        <th>Full Name</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>User Type</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(count($users)>0)
                        @foreach($users as $index=>$user)
                            <tr>
                                <td>{{ ++$index }}</td>
                                <td>{{ $user->full_name }}</td>
                                <td>{{ $user->username }}</td>
                                <td>{{ $user->email_address }}</td>
                                <td>{{ $user->userType->user_type_name }}</td>

                                <td>
                                    @if($user->editable == 1)

                                        @if(Access::hasAccess('users', 'access_publish'))
                                            @if($user->is_active == 1)
                                                <a href="javascript:void(0)"
                                                   class="change-status btn btn-primary btn-icon waves-effect waves-circle waves-float waves-effect waves-circle waves-float"
                                                   data-toggle="tooltip" title="Change Status"
                                                   id="{!! $user->id !!}"><i
                                                            class="zmdi zmdi-check-circle zmdi-hc-fw"></i></a>
                                            @else
                                                <a href="javascript:void(0)"
                                                   class="change-status btn btn-primary btn-icon waves-effect waves-circle waves-float waves-effect waves-circle waves-float"
                                                   data-toggle="tooltip" title="Change Status"
                                                   id="{!! $user->id !!}"><i
                                                            class="zmdi zmdi-lock zmdi-hc-fw"></i></a>
                                            @endif
                                        @else
                                            @if($user->is_active == 1)
                                                Active
                                            @else
                                                Inactive
                                            @endif
                                        @endif
                                        {{--@if(Access::hasAccess('users', 'access_update'))--}}
                                        {{--<a href="{{ route('admin.event.edit',$user->id) }}" data-toggle="tooltip"--}}
                                        {{--title="Edit Event" data-placement="top"--}}
                                        {{--class="btn btn-success btn-icon waves-effect waves-circle waves-float waves-effect waves-circle waves-float"><i--}}
                                        {{--class="zmdi zmdi-edit zmdi-hc-fw"></i></a>--}}
                                        {{--@endif--}}
                                        @if(Access::hasAccess('users', 'access_delete'))
                                            <a href="javascript:void(0)"
                                               class="delete btn btn-danger btn-icon waves-effect waves-circle waves-float waves-effect waves-circle waves-float"
                                               id="{!! $user->id !!}"
                                               data-toggle="tooltip" title="Delete User" data-placement="top"><i
                                                        class="zmdi zmdi-delete zmdi-hc-fw"></i></a>
                                        @endif


                                    @endif

                                </td>
                            </tr>

                        @endforeach
                    @else
                        <tr>
                            <td colspan="6"><h5 style="text-align: center;">No Users added yet.</h5></td>
                        </tr>
                    @endif
                    </tbody>
                </table>
                {{--                                {!! $users->render() !!}--}}
            </div>
        </div>
    </div>

@endsection