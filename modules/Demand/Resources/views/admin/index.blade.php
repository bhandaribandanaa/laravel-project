@extends('admin.layout.app')
@section('title', 'Demand Management')
@section('main')


    <div class="container">
        <div class="block-header">
            <h2>Demand</h2>
        </div>
        <div class="card">
            <div class="card-header">
                <a href="{{ route('admin.demands.add') }}" class="btn btn-primary waves-effect">Add Demand</a>
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
                        <th>Job Position</th>
                        <th>Salary</th>
                        <th>Type</th>
                        <th>Request Number</th>
                        <th>Fooding</th>
                        <th>Accomodation</th>
                        <th>Date</th>
                        <th>Added On</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    {{--*/$i=1/*--}}

                    @forelse($demands as $d)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{ $d->job_position }}</td>
                            <td>{{ $d->salary }}</td>
                            <td>{{ $d->type }}</td>
                            <td>{{ $d->request_number }}</td>
                            <td>{{ $d->fooding }}</td>
                            <td>{{ $d->accomodation}}</td>
                            <td>{{ $d->published_date}}</td>

                            <td>{{ Carbon\Carbon::parse($d->created_at)->toFormattedDateString() }}</td>

                            <td>
                                <a href="{{ route('admin.demands.edit',[$d->id]) }}" title="Edit Demands"
                                   data-toggle="tooltip"
                                   class="btn btn-success btn-icon waves-effect waves-circle waves-float waves-effect waves-circle waves-float"><i
                                            class="zmdi zmdi-edit zmdi-hc-fw"></i></a>


                                  @if($d->status == 'active')
                                   <a href="{{ route('admin.demands.changeStatus',[$d->id,'not_active']) }}" class="change-status btn btn-primary btn-icon waves-effect waves-circle waves-float waves-effect waves-circle waves-float" id="{!! $d->id !!}"  data-toggle="tooltip" title="Change Status"><i
                                                        class="zmdi zmdi-check-circle zmdi-hc-fw"></i></a>
                                        @else
                                            <a href="{{ route('admin.demands.changeStatus',[$d->id,'active']) }}" class="change-status btn btn-primary btn-icon waves-effect waves-circle waves-float waves-effect waves-circle waves-float" id="{!! $d->id !!}"  data-toggle="tooltip" title="Change Status"><i
                                                        class="zmdi zmdi-lock zmdi-hc-fw"></i></a>
                                @endif

                                <a href="javascript:void(0)"
                                   class="delete btn btn-danger btn-icon waves-effect waves-circle waves-float waves-effect waves-circle waves-float"
                                   data-id="{{ $d->id }} data-toggle="tooltip" title="Delete Demand" data-placement="top"><i
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
                    {!! $demands->render() !!}
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
                        text: "You will not be able to recover this demands!",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "Yes, delete it!",
                        closeOnConfirm: false
                    },
                    function(){
                        var url = "{{ url('admin/demands/delete') }}/"+id;
                        $.ajax({
                            type: "GET",
                            url: url,
                            datatype: "json",
                            success: function(data){
                                var obj = jQuery.parseJSON(data);
                                if(obj.status == 'success'){
                                    swal("Deleted!", "demands has been deleted.", "success");
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
