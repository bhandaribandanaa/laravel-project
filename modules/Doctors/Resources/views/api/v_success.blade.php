@extends('layout.api.app')
@section('title', 'Doctor\'s Appointment')
@section('header_js')
@stop
@section('main')

    <!--Page header & Title-->
    <section id="page_header">
        <div class="page_title">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h2 class="title">Appointment Success</h2>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="padding">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <img class="sucessimg" src="{{ asset('images/sucess.png') }}" alt="" />
                    <div class="classwrapper"><div class="username">Dear {{ $detail['f_name'] }}, </div>your appointment with <span>{{ $doctor_name }}</span> has been scheduled on <span>{{ $detail['date'] }}.</span>
                    </div>
                </div>
                <div class="col-md-6 col-md-offset-3">
                    <table class="table table-bordered table-striped successtable">

                        <input type="hidden" id="sms_message" name="sms_message" value="Dear {{ $detail['f_name'] }}, your appointment with {{ $doctor_name }} has been scheduled on {{ $detail['date'] }}">.

                        <tr>

                            <td width="25%">Full Name</td>
                            <td width="75%">{{ $detail['f_name'] }}</td>
                        </tr>
                        <tr>

                            <td>Address</td>
                            <td>{{ $detail['address'] }}</td>
                        </tr>

                        <tr>

                            <td>Mobile</td>
                            <td>{{ $detail['mobile'] }}</td>
                        </tr>
                        <tr>

                            <td>Email Address</td>
                            <td>{{ $detail['email'] }}</td>
                        </tr>
                        <tr>

                            <td>Date</td>
                            <td>{{ Carbon\Carbon::parse($detail['date'])->toFormattedDateString() }}</td>
                        </tr>
                        <tr>

                            <td>Shift</td>
                            <td>{{ $detail['shift'] }}</td>
                        </tr>
                        <tr>

                            <td valign="top">Message</td>
                            <td>{{ $detail['message'] }}</td>
                        </tr>

                    </table>
                </div>


            </div>
        </div>
    </section>


@section('footer_js')
    <script>
        (function(d, s, id){
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) {return;}
            js = d.createElement(s); js.id = id;
            js.src = "//connect.facebook.com/en_US/messenger.Extensions.js";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, "script", "Messenger"));

        window.extAsyncInit = function () {
            // the Messenger Extensions JS SDK is done loading
            //close the webview
            MessengerExtensions.requestCloseBrowser(function success() {

            }, function error(err) {

            });

        };
    </script>

    <script>
        $(function(){
            var sender_id = "{{ $sender_id }}";
            var date = "{{ $detail['date'] }}";
            var shift = "{{ $detail['shift'] }}";
            var doctor_name = "{{ $doctor_name }}";
            var url = "https://norvic-chat-bot.herokuapp.com/appointment-success-callback?sender_id="+sender_id+"&date="+date+"&shift="+shift+"&doctor_name="+doctor_name;
            $.ajax({
                type: "GET",
                url:url,
                headers: {
                    "Accept" : "application/json"
                },
                dataType: "json",
                success: function(data){
                    var sms_url = "{{ url('api/doctors/sendSMS/9802112440/Amit') }}";
                    console.log(sms_url);
                    $.ajax({
                        type: "GET",
                        url: sms_url,
                        success: function(data1){

                        }

                    })
                }
            });


        });
    </script>
@endsection

@stop