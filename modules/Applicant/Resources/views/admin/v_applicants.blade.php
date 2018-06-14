@extends('admin.layout.app')
@section('title', 'Applicants Management')
@section('main')

    <div class="container">
        <div class="block-header">
            <h2>Applicants</h2>
        </div>
        <div class="card">
            <div class="card-body table-responsive">
                <table class="table">
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


                   
                
@stop
@section('footer_js')
    <script type="text/javascript">

        $(function(){
            $(".delete").click(function(){
                var id = $(this).data("id");
                var $tr = $(this).closest('tr')
                swal({
                        title: "Are you sure?",
                        text: "You will not be able to recover this testimonials!",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "Yes, delete it!",
                        closeOnConfirm: false
                    },
                    function(){
                        var url = "{{ url('admin/testimonials/delete') }}/"+id;
                        $.ajax({
                            type: "GET",
                            url: url,
                            datatype: "json",
                            success: function(data){
                                var obj = jQuery.parseJSON(data);
                                if(obj.status == 'success'){
                                    swal("Deleted!", "testimonials has been deleted.", "success");
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





