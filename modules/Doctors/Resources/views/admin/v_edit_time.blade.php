@extends('admin.layout.app')
@section('title', 'Edit Schedule')
@section('header_css')
    {!! Html::style('backend/vendors/bower_components/bootstrap-select/dist/css/bootstrap-select.css') !!}
    {!! Html::style('backend/vendors/bower_components/summernote/dist/summernote.css') !!}
    {!! Html::style('backend/vendors/chosen_v1.4.2/chosen.min.css') !!}
    {!! Html::style('backend/css/formValidation.min.css') !!}
    {!! Html::style('backend/daterangepicker/daterangepicker.css') !!}
    <link href="http://netdna.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css" rel="stylesheet">
@stop

@section('main')
    <div class="container">

        <ol class="breadcrumb" style="margin-bottom: 5px;">
            <li><a href="{{ route('admin.dashboard') }}">Home</a></li>
            <li><a href="{{ route('admin.doctors.index') }}">Doctors</a></li>
            <li class="active">Edit schedule</li>
        </ol>

        <div class="card">
            <div class="card-header">
                <h2>Edit schedule
                    <small></small>
                </h2>
            </div>

            <div class="card-body card-padding">
                @if (count($errors) > 0)
                    <div class="alert alert-danger alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                    aria-hidden="true">×</span></button>
                        <ul class="list-unstyled">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{ route('admin.doctors.editTimeSubmit') }}" method="post" class="row" role="form"
                      enctype="multipart/form-data" id="contentForm">

                    <div class="col-sm-12">
                        <div class="form-group fg-line">
                            <input type="text" name="date_range" id="test">
                            <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
                        </div>

                    </div>

                    {{--*/$days = explode(',',$time->days)/*--}}
                    <div class="col-sm-12">
                        <div class="form-group fg-line">
                            <label class="" for="exampleInputEmail2">Select Day*</label>
                            <label><input type="checkbox" name="day[]" value="Sunday" @if(in_array('Sunday',$days)) checked @endif> Sunday</label>
                            <label><input type="checkbox" name="day[]" value="Monday" @if(in_array('Monday',$days)) checked @endif> Monday</label>
                            <label><input type="checkbox" name="day[]" value="Tuesday" @if(in_array('Tuesday',$days)) checked @endif> Tuesday</label>
                            <label><input type="checkbox" name="day[]" value="Wednesday" @if(in_array('Wednesday',$days)) checked @endif> Wednesday</label>
                            <label><input type="checkbox" name="day[]" value="Thursday" @if(in_array('Thursday',$days)) checked @endif> Thursday</label>
                            <label><input type="checkbox" name="day[]" value="Friday" @if(in_array('Friday',$days)) checked @endif> Friday</label>
                            <label><input type="checkbox" name="day[]" value="Saturday" @if(in_array('Saturday',$days)) checked @endif> Saturday</label>
                        </div>
                    </div>

                    {{--*/$shift = explode(',',$time->shift)/*--}}

                    <div class="col-sm-12">
                        <div class="form-group fg-line">
                            <label class="" for="exampleInputEmail2">Select Shift*</label>
                            <label><input type="checkbox" name="shift[]" value="Morning" @if(in_array('Morning',$shift)) checked @endif> Morning</label>
                            <label><input type="checkbox" name="shift[]" value="Day" @if(in_array('Day',$shift)) checked @endif> Day</label>
                            <label><input type="checkbox" name="shift[]" value="Evening" @if(in_array('Evening',$shift)) checked @endif> Evening</label>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group fg-line">
                            <label class="" for="">Publish</label>
                            <br/>
                            <br/>
                            <label class="radio radio-inline m-r-20">
                                <input type="radio" name="status" value="1" @if($time->status ==1)checked="checked"@endif>
                                <i class="input-helper"></i>
                                Yes
                            </label>
                            <label class="radio radio-inline m-r-20">
                                <input type="radio" name="status" value="0" @if($time->status ==0)checked="checked"@endif>
                                <i class="input-helper"></i>
                                No
                            </label>
                        </div>
                    </div>

                    <div class="clearfix"></div>
                    <input type="hidden" name="time_id" value="{{ $time->id }}">
                    <input type="hidden" name="doctor_id" value="{{ $time->doctor_id }}">
                    {!! csrf_field() !!}
                    <div class="col-sm-4">
                        <button type="submit" class="btn btn-primary btn-sm m-t-5">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@stop

@section('footer_js')
    {!! Html::script('backend/daterangepicker/daterangepicker.js') !!}
    {!! Html::script('backend/js/formValidation.min.js') !!}
    {!! Html::script('backend/js/form_bootstrap.min.js') !!}
    {!! Html::script('backend/vendors/bower_components/bootstrap-select/dist/js/bootstrap-select.js') !!}
    {!! Html::script('backend/vendors/bower_components/summernote/dist/summernote.min.js') !!}
    {!! Html::script('backend/vendors/fileinput/fileinput.min.js') !!}
    {!! Html::script('backend/vendors/chosen_v1.4.2/chosen.jquery.min.js') !!}


    <script type="text/javascript">
        $(function(){

            var start = "{{ $time->start_date }}";
            var end = "{{ $time->end_date }}";

            $('#test').daterangepicker({
                locale: {
                    format: 'YYYY-MM-DD'
                },
                startDate: start,
                endDate: end
            });
        });
    </script>
@stop