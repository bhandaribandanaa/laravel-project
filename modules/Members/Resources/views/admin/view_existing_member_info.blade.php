@extends('admin.layout.app')
@section('title', 'Member Management')
@section('main')
    {{--admin.member.add--}}
    <div class="container">
        <div class="block-header">
            <h2>{{ $member->salutation.' '.$member->first_name.' '.$member->middle_name.' '.$member->last_name }}'s
                Info</h2>
        </div>

        <div class="card">
            <div class="card-header">
                Member Info
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
                <table class="table">

                    <tr>
                        <td width="150">Full Name</td>
                        <td>{{ $member->salutation.' '.$member->first_name.' '.$member->middle_name.' '.$member->last_name }}</td>
                    </tr>
                    <tr>
                        <td>Member Type</td>
                        <td>{{ $member->memberType->member_type_name }}</td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td>{{ $member->email }}</td>
                    </tr>
                    <tr>
                        <td>Address</td>
                        <td>{{ $member->address }}</td>
                    </tr>
                    <tr>
                        <td>Mobile No</td>
                        <td>{{ $member->mobile_no }}</td>
                    </tr>
                    <tr>
                        <td>Organization</td>
                        <td>{{ $member->organization }}</td>
                    </tr>
                    <tr>
                        <td>Designation</td>
                        <td>{{ $member->designation }}</td>
                    </tr>
                    <tr>
                        <td>Scan Copy of Membership Application Form</td>
                        <td>
                            @if(file_exists("uploads/member/".$member->attachment_1) && $member->attachment_1 != '')
                            <a target="_blank" href="{{ asset('uploads/member/'.$member->attachment_1) }}">View</a>
                            @else
                            No File Attach
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <td>Scan Copy of NMC Certificate</td>
                        <td>
                        @if(file_exists("uploads/member/".$member->attachment_2) && $member-> attachment_2 != '')
                        <a href="{{asset('uploads/member/'.$member->attachment_2)}}" target="_blank">View</a>
                        @else
                        No File Attach
                        @endif
                        </td>
                    </tr>

                    <tr>
                        <td>Scan Copy of Citizenship</td>
                        <td>
                            @if(file_exists("uploads/member/".$member->attachment_3) && $member->attachment_3 != '')
                            <a href="{{ asset('uploads/member/'.$member->attachment_3) }}" target="_blank">View </a>
                            @else
                            No File Attach
                            @endif
                        </td>
                    </tr>

                    


                </table>

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
                    closeOnConfirm: false
                }, function () {
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
                                swal({
                                    title: "Success!",
                                    text: response.message,
                                    imageUrl: AdminAssetPath + "img/thumbs-up.png",
                                    timer: 2000,
                                    showConfirmButton: false
                                });
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
    {!! Html::style('backend/vendors/bower_components/lightgallery/light-gallery/css/lightGallery.css') !!}
    {!! Html::script('backend/vendors/bower_components/lightgallery/light-gallery/js/lightGallery.min.js') !!}

@stop