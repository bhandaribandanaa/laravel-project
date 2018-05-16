@extends('admin.layout.app')
@section('title', 'Packages Management')
@section('main')

    <div class="container">
        <div class="block-header">
            <h2>Package Management</h2>
        </div>

        <div class="card">
            <div class="card-header">
                    <a href="{{ route('admin.packages.add') }}" class="btn btn-primary waves-effect">Add New</a>
            </div>

            <div class="table-responsive">

                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>S N</th>
                        <th>Title</th>
                        <th>Price</th>
                        <th>Description</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    {{--*/$i=1/*--}}
                        @forelse($packages as $pack)
                            
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>
                                    {{ $pack->title }}
                                </td>
                                <td>
                                    {{ $pack->price }}
                                </td>
                                <td>{!! $pack->description !!}</td>
                                
                                <td>
                                
                                        @if($pack->status == 1)
                                            <a href="#" class="change-status btn btn-primary btn-icon waves-effect waves-circle waves-float waves-effect waves-circle waves-float" id="{!! $pack->id !!}"  data-toggle="tooltip" title="Change Status"><i
                                                        class="zmdi zmdi-check-circle zmdi-hc-fw"></i></a>
                                        @else
                                            <a href="#" class="change-status btn btn-primary btn-icon waves-effect waves-circle waves-float waves-effect waves-circle waves-float" id="{!! $pack->id !!}"  data-toggle="tooltip" title="Change Status"><i
                                                        class="zmdi zmdi-lock zmdi-hc-fw"></i></a>
                                        @endif
                                   
                                        <a href="{{ route('admin.packages.assignDoctor',[$pack->id]) }}" title="Assign Doctor"
                                           data-toggle="tooltip" class="btn btn-success btn-icon waves-effect waves-circle waves-float waves-effect waves-circle waves-float"><i class="zmdi zmdi-plus zmdi-hc-fw"></i></a>

                                        <a href="{{ route('admin.packages.edit',[$pack->id]) }}" title="Edit Package"
                                           data-toggle="tooltip" class="btn btn-success btn-icon waves-effect waves-circle waves-float waves-effect waves-circle waves-float"><i class="zmdi zmdi-edit zmdi-hc-fw"></i></a>
                                        <a href="#" class="delete-content btn btn-danger btn-icon waves-effect waves-circle waves-float waves-effect waves-circle waves-float" id="{!! $pack->id !!}"
                                           title="Delete Content" data-toggle="tooltip" ><i
                                                    class="zmdi zmdi-delete zmdi-hc-fw"></i></a>
                                </td>
                            </tr>

                        @empty
                            <tr>
                                <td colspan="7"><h5 style="text-align: center;">No packages added yet.</h5></td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                {!! $packages->render() !!}
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
                        url: '{{ route("admin.packages.delete") }}',
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
                    url: '{{ route("admin.packages.change_status") }}',
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