@extends('admin.layout.app')



<table class="table table-bordered table-striped">
          <thead>
            <tr>
                 <th>S.N</th>
                 <th>Job_id</th>
                 <th>Job Positon</th>
                 <th>name</th>
                 <th>address</th>
                 <th>phone</th>
                 <th>email</th>
                <th>cv</th>
                <th>Date</th>
                
            </tr>
          </thead>
          <tbody>
            {{--*/$i=1/*--}}
          @forelse($applicants as $d)
                         <tr>
                            <td>{{$i++ }}</td>
                            <td>{{ $d->id }}</td>
                            <td>{{ $d->job_position }}</td>
                            <td>{{ $d->name }}</td>
                            <td>{{ $d->address }}</td>
                            <td>{{ $d->phone }}</td>
                            <td>{{ $d->email }}</td>
                            <td>{{ $d->cv}}</td>
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
         


    <script type="text/javascript">

        $(document).ready(function () {

            $('.change-status').click(function (event) {
                event.preventDefault();
                $object = this;
                $.ajax({
                    type: 'POST',
                    url: '{{ route("admin.appointments.change_status") }}',
                    data: {id: $object.id, _token: '{!! csrf_token() !!}'},
                    success: function (response) {
                        if (response.is_confirmed == 1) {
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

            $('.change-success').click(function (event) {
                event.preventDefault();
                $object = this;
                $.ajax({
                    type: 'POST',
                    url: '{{ route("admin.appointments.change_success") }}',
                    data: {id: $object.id, _token: '{!! csrf_token() !!}'},
                    success: function (response) {
                        if (response.is_success == 1) {
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
                    },
                });
            });
        });

    </script>


    <script type="text/javascript" language="javascript" class="init">
        $(document).ready(function () {
            $("#datepicker").datepicker({
                format: 'yyyy-mm-dd'
            });

            $('.datatable').DataTable({
                columnDefs: [
                    {
                        targets: [0, 1, 2],
                        className: 'mdl-data-table__cell--non-numeric'
                    }
                ]
            });

            $("#data-table-basic").bootgrid({
                css: {
                    icon: 'zmdi icon',
                    iconColumns: 'zmdi-view-module',
                    iconDown: 'zmdi-expand-more',
                    iconRefresh: 'zmdi-refresh',
                    iconUp: 'zmdi-expand-less'
                },

            });
        });
    </script>

