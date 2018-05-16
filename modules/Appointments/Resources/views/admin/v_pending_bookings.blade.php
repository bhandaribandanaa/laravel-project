@extends('admin.layout.app')
@section('title', 'Appointments')
@section('header_css')
    <style>

        div.text-container {
            margin: 0 auto;
            width: 75%;
        }

        .text-content{
            line-height: 1em;
        }

        .short-text {
            overflow: hidden;
            height: 2em;
        }

        .full-text{
            height: auto;
        }

        h1 {
            font-size: 24px;
        }

        .show-more {
            padding: 10px 0;
            text-align: center;
        }

    </style>
@stop
@section('main')

    <div class="container">
        <div class="block-header">
            <h2>Appointments</h2>
        </div>

        <div class="card">

            <ul class="nav nav-pills nav-justified">
                <li><a href="{{ route('admin.appointments.packages') }}">Confirmed</a></li>
                <li class="active"><a href="{{ route('admin.appointments.pending') }}">Requests</a></li>
            </ul>


            <div class="table-responsive">

                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>S N</th>
                        <th>Packages</th>
                        <th>Doctor</th>
                        <th>Date</th>
                        <th>Shift</th>
                        <th>Patient Name</th>
                        <th>Address</th>
                        <th>Mobile No.</th>
                        <th>Email Address</th>
                        <th>Message</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    {{--*/$i=1/*--}}
                    @forelse($unconf_app as $app)

                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{ $app->package }}</td>
                            <td>{{ $app->doctor }}</td>
                            <td>{{ $app->date }}</td>
                            <td>{{ $app->shift }}</td>
                            <td>{{ $app->f_name }}</td>
                            <td>{{ $app->address }}</td>
                            <td>{{ $app->mobile }}</td>
                            <td>{{ $app->email }}</td>
                            <td>
                                <div class="text-container">
                                    <div class="text-content short-text">
                                        {!! $app->message !!}
                                    </div>
                                    <div class="show-more">
                                        <a href="#">Show more</a>
                                    </div>
                                </div>
                            </td>



                            <td>

                                @if($app->is_confirmed == 1)
                                    <a href="#" class="change-status btn btn-primary btn-icon waves-effect waves-circle waves-float waves-effect waves-circle waves-float" id="{!! $app->id !!}"  data-toggle="tooltip" title="Change Status"><i
                                                class="zmdi zmdi-check-circle zmdi-hc-fw"></i></a>
                                @else
                                    <a href="#" class="change-status btn btn-primary btn-icon waves-effect waves-circle waves-float waves-effect waves-circle waves-float" id="{!! $app->id !!}"  data-toggle="tooltip" title="Change Status"><i
                                                class="zmdi zmdi-lock zmdi-hc-fw"></i></a>
                                @endif

                            </td>
                        </tr>

                    @empty
                        <tr>
                            <td colspan="7"><h5 style="text-align: center;">No bookings added yet.</h5></td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
                {!! $unconf_app->render() !!}
            </div>
        </div>
    </div>
@stop
@section('footer_js')
    <script>
        $(".show-more a").each(function() {
            var $link = $(this);
            var $content = $link.parent().prev("div.text-content");

            console.log($link);

            var visibleHeight = $content[0].clientHeight;
            var actualHide = $content[0].scrollHeight - 1;

            console.log(actualHide);
            console.log(visibleHeight);

            if (actualHide > visibleHeight) {
                $link.show();
            } else {
                $link.hide();
            }
        });

        $(".show-more a").on("click", function() {
            var $link = $(this);
            var $content = $link.parent().prev("div.text-content");
            var linkText = $link.text();

            $content.toggleClass("short-text, full-text");

            $link.text(getShowLinkText(linkText));

            return false;
        });

        function getShowLinkText(currentText) {
            var newText = '';

            if (currentText.toUpperCase() === "SHOW MORE") {
                newText = "Show less";
            } else {
                newText = "Show more";
            }

            return newText;
        }


    </script>

    <script type="text/javascript">

        $(document).ready(function () {

            $('.change-status').click(function (event) {
                event.preventDefault();
                $object = this;
                $.ajax({
                    type: 'POST',
                    url: '{{ route("admin.appointments.change_statusPackage") }}',
                    data: {id: $object.id, _token: '{!! csrf_token() !!}'},
                    success: function (response) {
                        console.log(response);
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
        });

    </script>
@stop