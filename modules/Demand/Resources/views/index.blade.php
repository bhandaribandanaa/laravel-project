                    <section class="wprt-section">
                        <div class="container">
                        <div class="wprt-spacer" data-desktop="70" data-mobi="60" data-smobi="60"></div>
                        <h2>Latest Demand</h2>
                                    <div class="wprt-lines style-1 custom-3">
                                        <div class="line-1"></div>
                                        <div class="line-2"></div>
                                    </div>
                                    <div class="wprt-spacer" data-desktop="40" data-mobi="40" data-smobi="40"></div>
<table class="table table-bordered table-striped">
          <thead>
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
                    </tbody>
                </table>
                </table>
    <script>
  $(document).ready(function() {
    $('#table').DataTable();
} );
 </script>



<script src="//code.jquery.com/jquery-1.12.3.js"></script>
<script src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
<script
    src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
<link rel="stylesheet"
    href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<link rel="stylesheet"
    href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css">
         





















