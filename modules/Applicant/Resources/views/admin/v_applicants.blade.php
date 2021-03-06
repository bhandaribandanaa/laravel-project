@extends('admin.layout.app')
@section('title', 'Applicants Management')
@section('main')


    <div class="container">
        <div class="block-header">
            <h2>Applicants</h2>
        </div>
        <div class="card">
           

          

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

                <table id="applicants" class="table">

                    <thead>
                    <tr>
                     <th>S.N</th>
                 <th>Job Position</th>
                 <th>Job Apply email</th>
                 <th>name</th>
                 <th>address</th>
                 <th>phone</th>
                 <th>email</th>
                 <th>Date</th>
                 <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    {{--*/$i=1/*--}}

                      @forelse($applicants as $d)
                         <tr>
                            <td>{{$i++ }}</td>
                            <td>{{ $d->demand->job_position ?? "" }}</td>
                            <td>{{$d->job_position}}
                            <td>{{ $d->name }}</td>
                            <td>{{ $d->address }}</td>
                            <td>{{ $d->phone }}</td>
                            <td>{{ $d->email }}</td>
                           
                            <td>{{ $d->published_date}}</td>
                             <td> <td>
                             <a href="javascript:void(0)"
                                   class="delete btn btn-danger btn-icon waves-effect waves-circle waves-float waves-effect waves-circle waves-float"
                                   data-id="{{ $d->id }} data-toggle="tooltip" title="Delete Applicants" data-placement="top"><i
                                            class="zmdi zmdi-delete zmdi-hc-fw"></i></a>          


                                   
                                </td> </td>
                           
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
                </table>
               <div align="center">
                   {!! $applicants->render() !!}
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
                        text: "You will not be able to recover this Applicants!",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "Yes, delete it!",
                        closeOnConfirm: false
                    },
                    function(){
                        var url = "{{ url('admin/applicants/delete') }}/"+id;
                        $.ajax({
                            type: "GET",
                            url: url,
                            datatype: "json",
                            success: function(data){
                                var obj = jQuery.parseJSON(data);
                                if(obj.status == 'success'){
                                    swal("Deleted!", "Applicants has been deleted.", "success");
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

   <!-- <script type="text/javascript"
        src="{{ asset('js/datatable.js') }}"></script>

    <script>
$(document).ready( function () {
    $('#applicants').DataTable({
    "lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
    // "bFilter" : false,               
    // "bLengthChange": false

} );
} );
</script> -->
@stop




