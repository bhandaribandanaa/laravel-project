@extends('admin.layout.app')
@section('title', 'Doctors Management')
@section('main')

    <div class="container">
        <div class="block-header">
            <h2>Doctor's Record Management</h2>
        </div>

        <div class="card">
            <div class="card-header">
                    <a href="{{ route('admin.doctors.add') }}" class="btn btn-primary waves-effect">Add New</a>
            </div>

            @if(Session::get('success'))
                <div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <strong>Success!</strong> {{ Session::get('success') }}
                </div>
            @endif

            @if(Session::get('error'))
                <div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <strong>Warning!</strong> {{ Session::get('error') }}
                </div>
            @endif

            <div class="table-responsive">

                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>S N</th>
                        <th>Full Name</th>
                        <th>Image</th>
                        <th>Specialization</th>
                        <th>Contact</th>
                        <th>Address</th>
                        <th>Description</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    {{--*/$i=1/*--}}
                        @forelse($doctors as $doc)
                            
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>
                                    {{ $doc->full_name }}
                                </td>
                                <td>
                                    @if($doc->image)
                                        <img src="{{ asset('uploads/doctors/'.$doc->image) }}" style="height:40px; width:40px;">
                                    @endif
                                </td>
                                <td><label class="label label-primary">{{ $doc->specialization_name }}</label></td>
                                <td>{{ $doc->contact }}</td>
                                <td>{{ $doc->address }}</td>
                                <td>{!! $doc->description !!}</td>
                                
                                <td>
                                
                                        @if($doc->status == 1)
                                            <a href="#" class="change-status btn btn-primary btn-icon waves-effect waves-circle waves-float waves-effect waves-circle waves-float" id="{!! $doc->id !!}"  data-toggle="tooltip" title="Change Status"><i
                                                        class="zmdi zmdi-check-circle zmdi-hc-fw"></i></a>
                                        @else
                                            <a href="#" class="change-status btn btn-primary btn-icon waves-effect waves-circle waves-float waves-effect waves-circle waves-float" id="{!! $doc->id !!}"  data-toggle="tooltip" title="Change Status"><i
                                                        class="zmdi zmdi-lock zmdi-hc-fw"></i></a>
                                        @endif
                                   
                                        <a href="{{ route('admin.doctors.timetable',[$doc->id]) }}" title="Manage Time Table"
                                           data-toggle="tooltip" class="btn btn-success btn-icon waves-effect waves-circle waves-float waves-effect waves-circle waves-float"><i class="zmdi zmdi-plus zmdi-hc-fw"></i></a>

                                        <a href="{{ route('admin.doctors.setUnavailability',[$doc->id]) }}" title="Set Unavailability Time"
                                               data-toggle="tooltip" class="btn btn-success btn-icon waves-effect waves-circle waves-float waves-effect waves-circle waves-float">

                                            <i class="zmdi zmdi-layers"></i>

                                        </a>

                                        <a href="{{ route('admin.doctors.edit',[$doc->id]) }}" title="Edit Doctor"
                                           data-toggle="tooltip" class="btn btn-success btn-icon waves-effect waves-circle waves-float waves-effect waves-circle waves-float"><i class="zmdi zmdi-edit zmdi-hc-fw"></i></a>
                                        <a href="#" class="delete-content btn btn-danger btn-icon waves-effect waves-circle waves-float waves-effect waves-circle waves-float" id="{!! $doc->id !!}"
                                           title="Delete Content" data-toggle="tooltip" ><i
                                                    class="zmdi zmdi-delete zmdi-hc-fw"></i></a>
                                </td>
                            </tr>

                        @empty
                            <tr>
                                <td colspan="7"><h5 style="text-align: center;">No doctor records added yet.</h5></td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                {!! $doctors->render() !!}
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
//
                swal({
                    title: "Are you sure?",
                    text: "You will do you want to delete this record ?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Yes, delete it!",
                    closeOnConfirm: false
                }, function () {
                    debugger;
                    $.ajax({
                        type: 'POST',
                        url: '{{ route("admin.doctors.delete") }}',
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
                    url: '{{ route("admin.doctors.change_status") }}',
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