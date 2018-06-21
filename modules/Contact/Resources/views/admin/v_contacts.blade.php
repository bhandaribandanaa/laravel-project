@extends('admin.layout.app')
@section('title', 'Contacts Management')
@section('main')

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.18/css/jquery.dataTables.min.css">
    <div class="container">
        <div class="block-header">
            <h2>Demand</h2>
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
                 <table id="contacts" class="table">
            <thead>
               <tr>
                  <th>S.N</th>
                  <th>name</th>
                  <th>email</th>
                  <th>phone</th>
                  <th>subject</th>
                  <th>message</th>
                  <th>Created_at</th>
                  <th>Action</th>
               </tr>
            </thead>
            <tbody>
               {{--*/$i=1/*--}}
               @forelse($contacts as $d)
               <tr>
                  <td>{{$i++ }}</td>
                  <td>{{ $d->name }}</td>
                  <td>{{ $d->email }}</td>
                  <td>{{ $d->phone }}</td>
                  <td>{{ $d->subject}}</td>
                  <td>{{ $d->message}}</td>
                  <td>{{ $d->created_at}}</td>
                  <td>
                  <td> <a href="javascript:void(0)"
                     class="delete btn btn-danger btn-icon waves-effect waves-circle waves-float waves-effect waves-circle waves-float"
                     data-id="{{ $d->id }} data-toggle="tooltip" title="Delete Applicants" data-placement="top"><i
                     class="zmdi zmdi-delete zmdi-hc-fw"></i></a></td>
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
                    {!! $contacts->render() !!}
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


