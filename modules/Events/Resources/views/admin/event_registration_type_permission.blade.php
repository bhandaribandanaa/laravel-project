@extends('admin.layout.app')
@section('title', 'Access List')

@section('main')

    <div class="container">
        <ol class="breadcrumb" style="margin-bottom: 5px;">
            <li><a href="{{ URL::route('admin.dashboard') }}">Home</a></li>
            <li><a href="#">Registration Type</a></li>
            <li class="active">Permission List</li>
        </ol>
        <div class="block-header">
            <h2>{{ $eventRegistrationType->name }} Permission List</h2>
        </div>

        <div class="card">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th rowspan="2">Date</th>
                        <th colspan="4">Permission</th>
                    </tr>
                    <tr>
                        @foreach($registrationFacilities as $facility)
                            <th>{{ $facility->facility_name }}</th>
                        @endforeach
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                    <?php

                    $startTime = strtotime($eventInfo->start_date . '12:00');
                    $endTime = strtotime($eventInfo->end_date . '12:00');
                    // Loop between timestamps, 24 hours at a time
                    for ($i = $startTime; $i <= $endTime; $i = $i + 86400) {
                    ?>

                    <tr>
                        <td>{{ date( 'Y-m-d', $i ) }}</td>
                        @foreach($registrationFacilities as $facility)
                            <td>
                                <?php $hasFacility = \App\Classes\EventPermission::getEventPermissionAdminBy($eventInfo->id,$eventRegistrationType->id,$facility->id,date( 'Y-m-d', $i )); ?>
                                <label class="checkbox checkbox-inline m-r-20">
                                    <input type="checkbox" class="permission"
                                           id="{{ $facility->id }}_{{ date( 'Y-m-d', $i ) }}_{{ $facility->facility_name }}"
                                           @if($hasFacility) checked="checked" @endif value="">
                                    <i class="input-helper"></i>
                                </label>
                            </td>
                        @endforeach

                    </tr>


                    <?php } ?>
                </table>


            </div>
        </div>
    </div>

@stop
@section('footer_js')
    <script type="text/javascript">
        $(document).ready(function () {

            $('.permission').change(function (event) {
                $object = this;
                var newArr = this.id.split('_');
                debugger;
                $.ajax({
                    type: 'POST',
                    url: '{{ route('admin.event.registrationType.changePermission') }}',
                    data: {facility_id: newArr[0], date: newArr[1],permission_type: newArr[2], event_id: '{{ $eventInfo->id }}',registration_type_id: '{{ $eventRegistrationType->id }}', _token: '{!! csrf_token() !!}'},
                    success: function (response) {
                        swal({
                            title: "Success!",
                            text: response.message,
                            imageUrl: AdminAssetPath + "img/thumbs-up.png",
                            timer: 1000,
                            showConfirmButton: false
                        });
                        debugger;
                    },
                    error: function (e) {
                        debugger;
                    },
                });
            });
        });
    </script>
@stop