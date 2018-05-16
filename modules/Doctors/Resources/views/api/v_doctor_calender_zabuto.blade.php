@extends('layout.api.app')
@section('title', 'Select Appointment Date')
@section('header_css')
    <link media="all" type="text/css" rel="stylesheet" href="{{ asset('fullCalender/fullcalendar.min.css') }}" />
    <link type="text/css" rel="stylesheet" href="{{ asset('fullCalender/fullcalendar.print.css') }}" media="print" />
    <link media="all" type="text/css" rel="stylesheet" href="{{ asset('zabuto_calender/zabuto_calendar.css') }}" />
    <style>
        #calendar {
            max-width: 900px;
            margin: 0 auto;
        }
        .index{
            margin-bottom: 15px;
            background: #efefef;
            border: 1px solid #dedede;
            font-size: 12px;
            padding: 3px 10px 8px 10px;
        }
        .color-red{ padding: 8px;
            background: #fff0c3;
            display: inline-block;
            margin-right: 5px;
            position: relative;
            top: 3px;}
        .color-blue{
            position: relative;
            top: 3px;
            margin-top:3px;
            padding:8px;
            background: #ff9b08;
            display:inline-block;
            margin-right: 5px;
            border-radius:50px;}
        .no-color{ padding: 8px;
            background: #fff;
            display: inline-block;
            margin-right: 5px;
            position: relative;
            top: 3px;}
        .clearfix{ clear: both;}
        .leftmarg{ margin-left: 15px;}


    </style>
@stop
@section('main')

    <!--Page header & Title-->
    <section id="page_header">
        <div class="page_title">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h2 class="title">Appointment with Dr. {{ $doctor->full_name }}</h2>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="padding">
        <div class="container">
            <div class="row">
                @if(Session::get('error'))
                    <div class="alert alert-danger alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <strong>Warning!</strong> {{ Session::get('error') }}
                    </div>
                @endif
                <div id="message"></div>

                <div class="pull-right index">
                    <span class="color-blue leftmarg"></span> Available &nbsp;&nbsp;
                    <span class="no-color"></span> No date &nbsp;&nbsp;
                    <div class="clearfix"></div>
                </div>

                <div id='my-calendar'></div>

            </div>
        </div>
    </section>

@section('footer_js')
    <script src="{{ asset('backend/plugins/moment/min/moment.min.js') }}"></script>
    <script src="{{ asset('fullCalender/fullcalendar.min.js') }}"></script>
    <script src="{{ asset('zabuto_calender/zabuto_calendar.js') }}"></script>
    <script type="application/javascript">
        $(document).ready(function () {
            var events = "{{ $result }}";
            var url = "{{ url('api/doctors/getAppointment') }}";
            var slug = "{{ $doctor->slug }}";
            var sender_id = "{{ $sender_id }}";
            var string = events.replace(/&quot;/g, '"');
            var obj = JSON.parse(string);
            console.log(obj);
            $("#my-calendar").zabuto_calendar({
                data: obj,
                action: function() {
                    if($(this).attr('class') == 'dow-clickable event') {
                        id = this.id;
                        var date = id.split("_").pop(-1);
                        window.open(url + '/' + slug + '/' + date + '/' + sender_id, "_self");
                    }else{
                        return false;
                    }

                }
            });


        });
    </script>

@stop


@stop