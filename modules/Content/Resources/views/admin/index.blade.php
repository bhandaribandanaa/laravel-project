@extends('admin.layout.app')
@section('title', 'Content Management')
@section('main')

    <div class="container">
        <div class="block-header">
            <h2>Content Management</h2>
        </div>
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.18/css/jquery.dataTables.min.css">

        <div class="card">
            <div class="card-header">
                @if(Access::hasAccess('content-management', 'access_add'))
                    <a href="{{ route('admin.content.add') }}" class="btn btn-primary waves-effect">Add New</a>
                @endif
            </div>

            <div class="table-responsive">

                <table id="content" class="table table-striped">
                    <thead>
                    <tr>
                        <th>S N</th>
                        <th>Page Title</th>
                        <th>Parent</th>
                        <th>Display In</th>
                        <th>Display Order</th>
                        <th>View Count</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(count($contents)>0)
                        @foreach($contents as $index=>$content)
                            <tr>
                                <td>{{ ++$index }}</td>
                                <td>{{ $content->heading }}</td>
                                {{--<td>{{ count($content->children) }}</td>--}}
                                {{--<td>{{ count($content->children) }}</td>--}}
                                <td>{{ $content->parent['heading'] }}</td>
                                <td>
                                    @foreach (explode(', ', $content->display_in) as $singleMenuKey)
                                        <span class="badge">{{ $menu_array[$singleMenuKey] }}</span> &nbsp;
                                    @endforeach
                                </td>
                                <td>{{ $content->order_postition }}</td>
                                <td>{{ $content->view_count }}</td>
                                <td>
                                    @if(Access::hasAccess('content-management', 'access_publish'))
                                        @if($content->is_active == 1)
                                            <a href="" class="change-status btn btn-primary btn-icon waves-effect waves-circle waves-float waves-effect waves-circle waves-float" id="{!! $content->id !!}"  data-toggle="tooltip" title="Change Status"><i
                                                        class="zmdi zmdi-check-circle zmdi-hc-fw"></i></a>
                                        @else
                                            <a href="#" class="change-status btn btn-primary btn-icon waves-effect waves-circle waves-float waves-effect waves-circle waves-float" id="{!! $content->id !!}"  data-toggle="tooltip" title="Change Status"><i
                                                        class="zmdi zmdi-lock zmdi-hc-fw"></i></a>
                                        @endif
                                    @else
                                        @if($content->is_active == 1)
                                            Published
                                        @else
                                            Draft
                                        @endif
                                    @endif

                                    @if(Access::hasAccess('content-management', 'access_update'))
                                        <a href="{{ route('admin.content.edit',$content->id) }}" title="Edit Content"
                                           data-toggle="tooltip" class="btn btn-success btn-icon waves-effect waves-circle waves-float waves-effect waves-circle waves-float"><i class="zmdi zmdi-edit zmdi-hc-fw"></i></a>
                                    @endif
                                    @if(Access::hasAccess('content-management', 'access_delete'))
                                        <a href="#" class="delete-content btn btn-danger btn-icon waves-effect waves-circle waves-float waves-effect waves-circle waves-float" id="{!! $content->id !!}"
                                           title="Delete Content" data-toggle="tooltip" ><i
                                                    class="zmdi zmdi-delete zmdi-hc-fw"></i></a>
                                    @endif
                                </td>
                            </tr>

                        @endforeach
                    @else
                        <tr>
                            <td colspan="7"><h5 style="text-align: center;">No content added yet.</h5></td>
                        </tr>
                    @endif
                    </tbody>
                </table>
                {!! $contents->render() !!}
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
                    text: "You will do you want to delete this Content ?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Yes, delete it!",
                    closeOnConfirm: false
                }, function () {
                    debugger;
                    $.ajax({
                        type: 'POST',
                        url: '{{ route("admin.content.delete") }}',
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
                    url: '{{ route("admin.content.change_status") }}',
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
    <script type="text/javascript"
        src="{{ asset('js/datatable.js') }}"></script>
     <script>
$(document).ready( function () {
    $('#content').DataTable({
    "lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
    // "bFilter" : false,               
    // "bLengthChange": false

} );
} );
</script>
@stop