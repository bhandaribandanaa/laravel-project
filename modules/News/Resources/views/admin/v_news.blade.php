@extends('admin.layout.app')
@section('title', 'News Management')
@section('main')

    <div class="container">
        <div class="block-header">
            <h2>News</h2>
        </div>
        <div class="card">
            <div class="card-header">
                <a href="{{ route('admin.news.add') }}" class="btn btn-primary waves-effect">Add News</a>
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
                        <th>Category</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th>Added On</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    {{--*/$i=1/*--}}

                    @forelse($news as $n)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{ $n->title }}</td>
                            <td>
                                @if($n->image&& file_exists('uploads/news/'. $n->image))
                                 <img src="{{ URL::asset('uploads/news/'.$n->image) }}" alt="" style="height: 90px; width: 160px;">
                                  {{--   <img src="{{asset('uploads/news/'.$n->image) }}" style="height: 90px; width: 160px;"> --}}
                                @endif
                            </td>
                            <td> <span class="badge">{{ $n->category }}</span></td>
                            <td>{!! Helpers::string_limit($n->description,100) !!}</td>
                            <td>
                                @if($n->status=='active')
                                    <a class="label label-success">Published</a>
                                @else
                                    <a class="label label-danger">Unpublished</a>
                                @endif
                            </td>
                            <td>{{ Carbon\Carbon::parse($n->published_date)->toFormattedDateString() }}</td>
                            <td>
                                <a href="{{ route('admin.news.edit',[$n->id]) }}" title="Edit News"
                                   data-toggle="tooltip"
                                   class="btn btn-success btn-icon waves-effect waves-circle waves-float waves-effect waves-circle waves-float"><i
                                            class="zmdi zmdi-edit zmdi-hc-fw"></i></a>

                                @if($n->status == 'active')
                                    <a href="{{ route('admin.news.changeStatus',[$n->id,'not_active']) }}"
                                       class="btn btn-primary btn-icon waves-effect waves-circle waves-float waves-effect waves-circle waves-float"
                                       data-toggle="tooltip" title="Change Status"><i
                                                class="zmdi zmdi-check-circle zmdi-hc-fw"></i></a>
                                @else
                                    <a href="{{ route('admin.news.changeStatus',[$n->id,'active']) }}"
                                       class="btn btn-primary btn-icon waves-effect waves-circle waves-float waves-effect waves-circle waves-float"
                                        data-toggle="tooltip" title="Change Status"><i
                                                class="zmdi zmdi-lock zmdi-hc-fw"></i></a>
                                @endif

                                <a href="javascript:void(0)"
                                   class="delete btn btn-danger btn-icon waves-effect waves-circle waves-float waves-effect waves-circle waves-float"
                                   data-id="{{ $n->id }} data-toggle="tooltip" title="Delete News" data-placement="top"><i
                                            class="zmdi zmdi-delete zmdi-hc-fw"></i></a>



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
                    {!! $news->render() !!}
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
                        var url = "{{ url('admin/news/delete') }}/"+id;
                        $.ajax({
                            type: "GET",
                            url: url,
                            datatype: "json",
                            success: function(data){
                                var obj = jQuery.parseJSON(data);
                                if(obj.status == 'success'){
                                    swal("Deleted!", "News has been deleted.", "success");
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
