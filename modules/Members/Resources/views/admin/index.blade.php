@extends('admin.layout.app')
@section('title', 'Member Management')
@section('main')
    <div class="loading_modal" style="display: none">
        <div class="loading">
            <!-- <img alt="" src="{{ asset('backend/img/loading.gif') }}"/> -->
        </div>
    </div>
    {{--admin.member.add--}}
    <div class="container">
        <div class="block-header">
            <h2>Member Management</h2>
        </div>

        <div class="card">
            <div class="card-header">
                @if(Access::hasAccess('member-management', 'access_add'))
                    <a href="{{ route('admin.member.add') }}" class="btn btn-primary waves-effect">Add New Member</a>
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
                        <th>Email</th>
                        <th>Type Type</th>
                        <th>Membership No.</th>
                        <th>NMC No</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(count($members)>0)
                        @foreach($members as $index=>$member)
                            <tr>
                                <td>{{ ++$index }}</td>
                                <td>{{ $member->first_name.' '.$member->last_name }}</td>
                                <td>{{ $member->email }}</td>
                                <td>{{ $member->memberType->member_type_name }}</td>
                                <td>{{ $member->membership_no }}</td>
                                <td>{{ $member->nmc_no }}</td>

                                <td>
                                    @if(Access::hasAccess('member-management', 'access_view'))
                                        <a href="{{ route('admin.member.existing.view',$member->id) }}"
                                           class=" btn btn-success btn-icon waves-effect waves-circle waves-float waves-effect waves-circle waves-float"
                                           data-toggle="tooltip" title="View Member"><i
                                                    class="zmdi zmdi-eye zmdi-hc-fw"></i></a>
                                    @endif
                                    @if(Access::hasAccess('member-management', 'access_publish'))
                                        @if($member->is_active == 1)
                                            <a href="javascript:void(0)"
                                               class="change-status btn btn-primary btn-icon waves-effect waves-circle waves-float waves-effect waves-circle waves-float"
                                               id="{!! $member->id !!}" data-toggle="tooltip" title="Disable Member"><i
                                                        class="zmdi zmdi-check-circle zmdi-hc-fw"></i></a>
                                        @else
                                            <a href="javascript:void(0)"
                                               class="change-status btn btn-primary btn-icon waves-effect waves-circle waves-float waves-effect waves-circle waves-float"
                                               id="{!! $member->id !!}" data-toggle="tooltip" title="Enable Member"><i
                                                        class="zmdi zmdi-lock zmdi-hc-fw"></i></a>
                                        @endif
                                    @else
                                        @if($member->is_active == 1)
                                            Active
                                        @else
                                            Inactive
                                        @endif
                                    @endif

                                    @if(Access::hasAccess('member-management', 'access_update'))
                                        <a href="{{ route('admin.member.edit',$member->id) }}" data-toggle="tooltip"
                                           title="Edit Member" data-placement="top"
                                           class="btn btn-success btn-icon waves-effect waves-circle waves-float waves-effect waves-circle waves-float"><i
                                                    class="zmdi zmdi-edit zmdi-hc-fw"></i></a>
                                    @endif
                                    @if(Access::hasAccess('member-management', 'access_delete'))
                                        <a href="javascript:void(0)"
                                           class="delete btn btn-danger btn-icon waves-effect waves-circle waves-float waves-effect waves-circle waves-float"
                                           id="{!! $member->id !!}"
                                           data-toggle="tooltip" title="Delete Member" data-placement="top"><i
                                                    class="zmdi zmdi-delete zmdi-hc-fw"></i></a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="7"><h5 style="text-align: center;">No Member found.</h5></td>
                        </tr>
                    @endif
                    </tbody>
                </table>
                {!! $members->render() !!}
            </div>
        </div>
    </div>
@stop
@section('footer_js')
    <script type="text/javascript">
        $(document).ready(function () {

            $('.change-status').click(function (event) {
                event.preventDefault();
                $object = this;

                swal({
                    title: "Are you sure?",
                    text: "Do you want to Change Member status ?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Yes, Change it!",
                    closeOnConfirm: true
                }, function () {
                    $(".loading_modal").show();
                    debugger;
                    $.ajax({
                        type: 'POST',
                        url: '{{ route("admin.member.change_status") }}',
                        data: {id: $object.id, _token: '{!! csrf_token() !!}'},
                        success: function (response) {
                            debugger;
                            if (response.status == true) {
                                if (response.is_active == 1) {
                                    $($object).html('<i class="zmdi zmdi-check-circle zmdi-hc-fw"></i>');
                                } else {
                                    $($object).html('<i class="zmdi zmdi-lock zmdi-hc-fw"></i>');
                                }
                                $(".loading_modal").hide();
                                swal("Success!", response.message, "success");
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


            $('.delete').click(function (event) {
                event.preventDefault();
                $object = this;
                swal({
                    title: "Are you sure?",
                    text: "Do you want to delete this Member ?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Yes, delete it!",
                    closeOnConfirm: false
                }, function () {
                    debugger;
                    $.ajax({
                        type: 'POST',
                        url: '{{ route("admin.member.delete") }}',
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

        });
    </script>
@stop