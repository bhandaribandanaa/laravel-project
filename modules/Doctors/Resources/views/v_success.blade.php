@extends('layout.frontend.app')
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
                        <div class="page_link"><a href="{{ route('home') }}">Home</a><i class="fa fa-long-arrow-right"></i><span>Success</span></div>
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


@stop