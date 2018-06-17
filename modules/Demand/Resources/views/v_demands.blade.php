                    <section class="wprt-section">
                        <div class="container">
                        <div class="wprt-spacer" data-desktop="70" data-mobi="60" data-smobi="60"></div>
                        <h2>Latest Demand</h2>
                                    <div class="wprt-lines style-1 custom-3">
                                        <div class="line-1"></div>
                                        <div class="line-2"></div>
                                    </div>
                                    <div class="wprt-spacer" data-desktop="40" data-mobi="40" data-smobi="40"></div>
<!-- <table class="table table-bordered table-striped"> -->
         <!--  <thead>
            <tr>
                 <th width="6%">S.N</th>
                 <th width="6%">Job id</th>
                 <th width="18%">Job Positon</th>
                 <th>Salary</th>
                 <th>Type</th>
                 <th width="6%">Req No.</th>
                 <th>Fooding</th>
                <th>Accommodation</th>
                <th>Date</th>
                <th>Action</th>
            </tr>
          </thead>
          <tbody>
            {{--*/$i=1/*--}}
          @forelse($demands as $d)
                         <tr>
                            <td>{{$i++ }}</td>
                            <td>{{ $d->id }}</td>
                            <td>{{ $d->job_position }}</td>
                            <td>{{ $d->salary }}</td>
                            <td>{{ $d->type }}</td>
                            <td>{{ $d->request_number }}</td>
                            <td>{{ $d->fooding }}</td>
                            <td>{{ $d->accomodation}}</td>
                            <td>{{ $d->published_date}}</td>
                            <td><a href="{{ route('applicants.add',$d->id) }}" target="_blank">Apply Online</a>
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

        
               
               
      

<!-- 
         <script>
         $(function() {
               $('#table').DataTable({
               processing: true,
               serverSide: true,
               ajax: '{{ url('index') }}',
               columns: [
                        { data: 'id', name: 'id' },
                        { data: 'job_position', name: 'job_position' },
                        { data: 'salary', name: 'salary' },
                        { data: 'type', name: 'type' },
                        { data: 'request_number', name: 'request_number' },
                        { data: 'fooding', name: 'fooding' },
                        { data: 'accomodation', name: 'accomodation' },
                        { data: 'published_date', name: 'published_date' }
                     ]
            });
         });
         </script>

   <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">  
        <link  href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script> -->




                 <!--    </tbody>

                    <script>
$(document).ready(function() {
  $('#table').DataTable({
"bStateSave": true
});
} );
</script>
                </table>
               
               <div align="center">
                   {!! $demands->render() !!}
               </div>
      -->

      <table id="demands" class="table table-bordered table-striped" >
          <thead>
            <tr>
                 <th width="6%">S.N</th>
                 <th width="18%">Job Positon</th>
                 <th>Salary</th>
                 <th>Type</th>
                 <th>Req.no</th>
                 <th>Fooding</th>
                 <th>Accomodation</th>
                 <th>published_date</th>
                 <th>action</th>
                 


            </tr>
          </thead>
                </table>





















