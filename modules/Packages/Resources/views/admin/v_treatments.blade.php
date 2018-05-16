@extends('admin.layout.app')
@section('title', 'Treatments Management')
@section('main')

    <div class="container">
        <div class="block-header">
            <h2>Treatments Management</h2>
        </div>

        <div class="card">
            <div class="card-header">
                <a href="{{ route('admin.packages.addTreatment') }}" class="btn btn-primary waves-effect">Add New</a>
            </div>

            <div class="table-responsive">

                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>S N</th>
                        <th>Title</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    {{--*/$i=1/*--}}
                    @forelse($treatments as $t)

                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>
                                {{ $t->title }}
                            </td>
                            <td>
                                @if($t->status == 1)
                                    <a href="#" class="change-status btn btn-primary btn-icon waves-effect waves-circle waves-float waves-effect waves-circle waves-float" id="{!! $t->id !!}"  data-toggle="tooltip" title="Change Status"><i
                                                class="zmdi zmdi-check-circle zmdi-hc-fw"></i></a>
                                @else
                                    <a href="#" class="change-status btn btn-primary btn-icon waves-effect waves-circle waves-float waves-effect waves-circle waves-float" id="{!! $t->id !!}"  data-toggle="tooltip" title="Change Status"><i
                                                class="zmdi zmdi-lock zmdi-hc-fw"></i></a>
                                @endif

                                <a href="{{ route('admin.packages.editTreatment',[$t->id]) }}" title="Edit Package"
                                   data-toggle="tooltip" class="btn btn-success btn-icon waves-effect waves-circle waves-float waves-effect waves-circle waves-float"><i class="zmdi zmdi-edit zmdi-hc-fw"></i></a>
                                <a href="#" class="delete-treatment btn btn-danger btn-icon waves-effect waves-circle waves-float waves-effect waves-circle waves-float" id="{!! $t->id !!}"
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
                {!! $treatments->render() !!}
            </div>
        </div>
    </div>
@stop
@section('footer_js')
    <script type="text/javascript">

        $(document).ready(function () {
            $('.delete-treatment').click(function (event) {
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
                        url: '{{ route("admin.packages.deleteTreatment") }}',
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
                    url: '{{ route("admin.packages.change_statusTreatment") }}',
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