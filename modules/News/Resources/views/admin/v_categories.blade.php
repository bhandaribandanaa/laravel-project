@extends('admin.layout.app')
@section('title', 'Doctors Management')
@section('main')

    <div class="container">
        <div class="block-header">
            <h2>Categories</h2>
        </div>
        <div class="card">
            <div class="card-header">
                <a href="{{ route('admin.news.addCategory') }}" class="btn btn-primary waves-effect">Add Category</a>
            </div>
            @if(Session::has('add_success'))
                <div class="alert alert-success fade in">
                    <button type="button" class="close close-sm" data-dismiss="alert">
                        <i class="fa fa-times"></i>
                    </button>
                    <strong>Success!</strong> {{ Session::get('add_success') }}
                </div>
            @endif

            @if(Session::has('edit_success'))
                <div class="alert alert-success fade in">
                    <button type="button" class="close close-sm" data-dismiss="alert">
                        <i class="fa fa-times"></i>
                    </button>
                    <strong>Success!</strong> {{ Session::get('edit_success') }}
                </div>
            @endif

            @if(Session::has('del_success'))
                <div class="alert alert-success fade in">
                    <button type="button" class="close close-sm" data-dismiss="alert">
                        <i class="fa fa-times"></i>
                    </button>
                    <strong>Success!</strong> {{ Session::get('del_success') }}
                </div>
            @endif

            @if(Session::has('status_success'))
                <div class="alert alert-success fade in">
                    <button type="button" class="close close-sm" data-dismiss="alert">
                        <i class="fa fa-times"></i>
                    </button>
                    <strong>Success!</strong> {{ Session::get('status_success') }}
                </div>
            @endif

            @if(Session::has('error'))
                <div class="alert alert-danger fade in">
                    <button type="button" class="close close-sm" data-dismiss="alert">
                        <i class="fa fa-times"></i>
                    </button>
                    <strong>Warning!</strong> {{ Session::get('error') }}
                </div>
            @endif
            <div class="card-body table-responsive">
                <table class="table">
                    <thead>
                    <tr>
                        <th>S.N.</th>
                        <th>Title</th>
                        <th>Image</th>
                        <th>Status</th>
                        <th>Added On</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    {{--*/$i=1/*--}}

                    @forelse($categories as $cat)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{ $cat->category }}</td>
                            <td>
                                @if($cat->image)
                                    <img src="{{ asset('uploads/news/'.$cat->image) }}" style="height: 90px; width: 160px;">
                                @endif
                            </td>
                            <td>
                                @if($cat->status=='active')
                                    <a class="label label-success">Published</a>
                                @else
                                    <a class="label label-danger">Unpublished</a>
                                @endif
                            </td>
                            <td>{{ Carbon\Carbon::parse($cat->created_at)->toFormattedDateString() }}</td>
                            <td>
                                <a href="{{ route('admin.news.editCategory',[$cat->id]) }}" class="btn btn-primary btn-xs">Edit</a>
                                @if($cat->status=='active')
                                    <a href="{{ route('admin.news.changeCategoryStatus',[$cat->id,'not_active']) }}" class="btn btn-info btn-xs">Disable</a>
                                @else
                                    <a href="{{ route('admin.news.changeCategoryStatus',[$cat->id,'active']) }}" class="btn btn-info btn-xs">Enable</a>
                                @endif
                                <a href="javascript:void(0)" class="btn btn-danger btn-xs delete" data-id="{{ $cat->id }}">Delete</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
                <div align="center">
                    {!! $categories->render() !!}
                </div>
            </div>
        </div>
    </div>
@stop
@section('footer_js')
    <script type="text/javascript">

        $(function(){
            $(".delete").click(function(){
                var id = $(this).data("id");
                var $tr = $(this).closest('tr')
                swal({
                        title: "Are you sure?",
                        text: "You will not be able to recover this news!",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "Yes, delete it!",
                        closeOnConfirm: false
                    },
                    function(){
                        var url = "{{ url('admin/news/deleteCategory') }}/"+id;
                        $.ajax({
                            type: "GET",
                            url: url,
                            datatype: "json",
                            success: function(data){
                                var obj = jQuery.parseJSON(data);
                                if(obj.status == 'success'){
                                    swal("Deleted!", "Category has been deleted.", "success");
                                    $tr.find('td').fadeOut(1000,function(){
                                        $tr.remove();
                                    });
                                }
                            }
                        });
                    });
            });
        });

    </script>
@stop
