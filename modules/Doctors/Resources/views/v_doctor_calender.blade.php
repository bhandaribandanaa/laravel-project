@extends('layout.frontend.app')
@section('title', 'Select Appointment Date')
@section('header_css')
    <link media="all" type="text/css" rel="stylesheet" href="{{ asset('fullCalender/fullcalendar.min.css') }}" />
    <link type="text/css" rel="stylesheet" href="{{ asset('fullCalender/fullcalendar.print.css') }}" media="print" />
    <style>
        #calendar {
            max-width: 900px;
            margin: 0 auto;
        }
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
                        <div class="page_link"><a href="{{ route('home') }}">Home</a><i class="fa fa-long-arrow-right"></i><span>Appointment with Dr. {{ $doctor->full_name }}</span></div>
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

                <div id='calendar'></div>

            </div>
        </div>
    </section>

@section('footer_js')
    <script src="{{ asset('backend/plugins/moment/min/moment.min.js') }}"></script>
    <script src="{{ asset('fullCalender/fullcalendar.min.js') }}"></script>
    <script>

        $(document).ready(function() {

            var events = "{{ $schedule }}";
            var url = "{{ url('doctors/getAppointment') }}";
            var slug = "{{ $doctor->slug }}";

            var string = events.replace(/&quot;/g, '"');

            var obj = JSON.parse(string);

            var date = moment().format("YYYY-MM-DD");
            $('#calendar').fullCalendar({
                header: {
                    left: 'prev,next today',
                    center: 'title'
                },
                defaultDate: '2017-05-01',
                navLinks: false, // can click day/week names to navigate views
                editable: false,
                eventLimit: false, // allow "more" link when too many events
                events: obj,
                eventClick: function(event, jsEvent, view) {
                    // Get the case number in the row
                    // pos X clicked on the row / total width of the row * 100 (to percent) / (percent of 7 days by week)
                    var caseNumber = Math.floor((Math.abs(jsEvent.offsetX + jsEvent.currentTarget.offsetLeft) / $(this).parent().parent().width() * 100) / (100 / 7));
                    // Get the table
                    var table = $(this).parent().parent().parent().parent().children();
                    $(table).each(function(){
                        // Get the thead
                        if($(this).is('thead')){
                            var tds = $(this).children().children();
                            var dateClicked = $(tds[caseNumber]).attr("data-date");
                            window.open(url+'/'+slug+'/'+dateClicked);
                        }
                    });
                }
            });

        });

    </script>
@stop


@stop