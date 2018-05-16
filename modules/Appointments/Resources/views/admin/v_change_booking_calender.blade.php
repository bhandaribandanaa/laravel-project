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
        div.zabuto_calendar .table
		{ border:1px solid #f0f0f0 !important;}
    </style>

    {!! Html::style('backend/sweetAlert/sweetalert.css') !!}
    {!! Html::style('backend/sweetAlert/swal-forms.css') !!}
    {!! Html::style('backend/css/dataTables.material.min.css') !!}
    {!! Html::style('backend/css/material.min.css') !!}
    {!! Html::style('backend/plugins/bootstrap-select/dist/css/bootstrap-select.css') !!}
    {!! Html::style('datepicker.min.css') !!}
    <link media="all" type="text/css" rel="stylesheet" href="{{ asset('zabuto_calender/zabuto_calendar.css') }}" />
@stop

@section('main')
    <div class="container">
        <div class="block-header">
            <h2>Change Booking</h2>
        </div>



        <div class="card">
            <div class="card-header"></div>
            <div class="card-body card-padding">
                <form action="{{ route('admin.appointments.updatePackageSubmit') }}" method="post">
                    <div id='my-calendar'></div>
                    <div id="shifts"></div>
                    <input type="hidden" name="date" id="date">
                    <input type="hidden" name="app_id" value="{{ $app_id }}">
                    {!! csrf_field() !!}
                </form>
            </div>
        </div>
    </div>
@stop
@section('footer_js')
    {!! Html::script('backend/sweetAlert/sweetalert.min.js') !!}
    {!! Html::script('backend/plugins/bootstrap-select/dist/js/bootstrap-select.js') !!}
    {!! Html::script('datepicker.min.js') !!}

    {!! Html::script('backend/js/jquery.dataTables.min.js') !!}
    {!! Html::script('backend/js/dataTables.material.min.js') !!}
    <script src="{{ asset('backend/plugins/moment/min/moment.min.js') }}"></script>
    <script src="{{ asset('fullCalender/fullcalendar.min.js') }}"></script>
    <script src="{{ asset('zabuto_calender/zabuto_calendar.js') }}"></script>
    <script type="application/javascript">
        $(document).ready(function () {
            var events = "{{ $result }}";
            var slug = "{{ $doctor->slug }}";
            var string = events.replace(/&quot;/g, '"');
            var obj = JSON.parse(string);
            console.log(obj);
            $("#my-calendar").zabuto_calendar({
                data: obj,
                action: function() {
                    if($(this).attr('class') == 'dow-clickable event') {
                        id = this.id;
                        var date = id.split("_").pop(-1);

                        var url = "{{ url('admin/appointments/get-schedule') }}/"+slug+"/"+date;


                        $.ajax({
                            type: "GET",
                            url: url,
                            datatype: "json",
                            success: function(data){

                                var obj = jQuery.parseJSON(data);
                                var append = "<div class='col-sm-4'>"+
                                    "<div class='form-group fg-line'>"+
                                    "<br/><label class='c-black f-500 ' for=''>Shift *</label>"+
                                    "<select class='form-control' name='shift' id=''>"+
                                    "<option value=''>Choose a shift</option>";

                                var arr = obj.value.split(",");
                                for(var i = 0; i < arr.length; i++){
                                    append+= "<option value='"+ arr[i] +"'>"+ arr[i] +"</option>"
                                }



                                append += "</select></div></div><div class='clearfix'></div>";
                                append += "<div class='col-sm-4'>"+
                                    "<button type='submit' class='btn btn-primary btn-sm m-t-5'>Update Appointment</button>"+
                                    "</div><div class='clearfix'></div>";

                                $("#date").val(date);
                                $("#shifts").html(append);


                            }
                        });
                    }else{
                        return false;
                    }

                }
            });


        });
    </script>


    <script type="text/javascript">

        $(document).ready(function () {

            $('.change-confirm').click(function (event) {
                event.preventDefault();
                $object = this;
                $.ajax({
                    type: 'POST',
                    url: '{{ route("admin.appointments.change_confirm") }}',
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


@stop