@extends('admin.layout.app')
@section('title', 'Add Event')
@section('header_css')
    {!! Html::style('backend/plugins/bootstrap-select/dist/css/bootstrap-select.css') !!}
    {!! Html::style('backend/plugins/summernote/dist/summernote.css') !!}
    {!! Html::style('backend/plugins/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css') !!}
    {!! Html::style('backend/plugins/chosen_v1.4.2/chosen.min.css') !!}
    {!! Html::style('backend/css/formValidation.min.css') !!}
@stop

@section('main')
    <div class="container">
    <ol class="breadcrumb" style="margin-bottom: 5px;">
        <li><a href="{{ route('admin.dashboard') }}">Home</a></li>
        <li><a href="{{ route('admin.event.index') }}">Events</a></li>
        <li class="active">Add new Event</li>
    </ol>

    <div class="card">
        <div class="card-header">
            <h2>Add new Event
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
            <form action="{{ route('admin.event.add') }}" method="post" class="row" role="form"
                  enctype="multipart/form-data" id="contentForm">

                <div class="col-sm-12">
                    <div class="form-group fg-line">
                        <label class="" for="exampleInputEmail2">Event Name *</label>
                        <input type="text" class="form-control input-sm" name="name" id=""
                               placeholder="Enter Event Name" value="{{ old('name') }}">
                    </div>
                </div>

                <div class="col-sm-12">
                    <div class="form-group fg-line">
                        <label class="" for="exampleInputEmail2">Type *</label>
                        {!! Form::select('event_type_id', $event_type, '', array('class'=>'selectpicker form-control input-sm')) !!}
                    </div>
                </div>


                <div class="col-sm-12">
                    <div class="form-group fg-line">
                        <label class="" for="">Slogan *</label>
                        <input type="text" class="form-control input-sm" name="slogan" id=""
                               placeholder="Enter slogan" value="{{ old('slogan') }}">
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="form-group fg-line">
                        <label class="" for="">Location *</label>
                        <input type="text" class="form-control input-sm" name="location" id=""
                               placeholder="Enter Location" value="{{ old('location') }}">
                    </div>
                </div>

                <div class="col-sm-12">
                    <div class="form-group fg-line">
                        <label class="" for="">Longitude</label>
                        <input type="text" class="form-control input-sm" name="longitude" id=""
                               placeholder="Enter longitude" value="{{ old('longitude') }}">
                    </div>
                </div>

                <div class="col-sm-12">

                    <div class="form-group fg-line">
                        <label class="" for="">Latitude</label>
                        <input type="text" class="form-control input-sm" name="latitude" id=""
                               placeholder="Enter latitude" value="{{ old('latitude') }}">
                    </div>
                </div>

                <div class="col-sm-3">

                    <label class="" for="">Start Date *</label>

                    <div class="input-group form-group">
                        <span class="input-group-addon"><i class="zmdi zmdi-calendar"></i></span>

                        <div class="dtp-container fg-line" id="startDatePicker">
                            <input type='text' class="form-control date-picker" placeholder="Start Date"
                                   name="start_date" value="{{ old('start_date') }}" id="datetimepicker6">
                        </div>
                    </div>

                </div>
                <div class="col-sm-3">
                    <label class="" for="">Start Time *</label>

                    <div class="input-group form-group">
                        <span class="input-group-addon"><i class="zmdi zmdi-time"></i></span>

                        <div class="dtp-container fg-line">
                            <input type='text' class="form-control time-picker" placeholder="Start Time"
                                   name="start_time" value="{{ old('start_time') }}">
                        </div>
                    </div>

                </div>
                <div class="col-sm-3">

                    <label class="" for="">End Date *</label>

                    <div class="input-group form-group">
                        <span class="input-group-addon"><i class="zmdi zmdi-calendar"></i></span>

                        <div class="dtp-container fg-line" id="endDatePicker">
                            <input type='text' class="form-control date-picker" placeholder="End Date" name="end_date"
                                   value="{{ old('end_date') }}" id="datetimepicker7">
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <label class="" for="">End Time *</label>

                    <div class="input-group form-group">
                        <span class="input-group-addon"><i class="zmdi zmdi-time"></i></span>

                        <div class="dtp-container fg-line">
                            <input type='text' class="form-control time-picker" placeholder="End Time"
                                   name="end_time" value="{{ old('end_time') }}">
                        </div>
                    </div>
                </div>


                <div class="col-sm-3">
                    <label class="" for="">Book Online ?</label>

                    <div class="input-group form-group">
                        <label class="radio radio-inline m-r-20">
                            <input type="radio" name="book_online" value="1" checked>
                            <i class="input-helper"></i>
                            Yes
                        </label>
                        <label class="radio radio-inline m-r-20">
                            <input type="radio" name="book_online" value="0">
                            <i class="input-helper"></i>
                            No
                        </label>
                    </div>
                </div>
                <div class="col-sm-4">

                    <label class="" for="">Online Registration Open At:</label>

                    <div class="input-group form-group">
                        <span class="input-group-addon"><i class="zmdi zmdi-calendar"></i></span>

                        <div class="dtp-container fg-line" id="">
                            <input type='text' class="form-control date-picker" placeholder="Registration Start"
                                   name="registration_start_date" value="{{ old('registration_start_date') }}" id="datetimepicker_start">
                        </div>
                    </div>

                </div>
                <div class="col-sm-4">

                    <label class="" for="">Online Registration Close At:</label>

                    <div class="input-group form-group">
                        <span class="input-group-addon"><i class="zmdi zmdi-calendar"></i></span>

                        <div class="dtp-container fg-line" id="">
                            <input type='text' class="form-control date-picker" placeholder="Registration Close" name="registration_end_date"
                                   value="{{ old('registration_end_date') }}" id="datetimepicker_end">
                        </div>
                    </div>
                </div>


                <div class="col-sm-12">
                    <div class="form-group fg-line">
                        <label class="" for="">No of Participants</label>
                        <input type="text" class="form-control input-sm" name="no_of_participants" id=""
                               placeholder="No of Participants" value="{{ old('no_of_participants') }}">
                    </div>
                </div>

                <div class="col-sm-12">
                    <div class="form-group fg-line">
                        <label class="" for="">Description*</label>
                        <textarea class="form-control" name="description"
                                  style="height: 300px;">{{ old('description') }}</textarea>
                        </textarea>
                    </div>
                </div>

                <div class="col-sm-12">
                    <div class="form-group fg-line">
                        <label class="" for="">Banner</label>
                        <br/>

                        <div class="fileinput fileinput-new" data-provides="fileinput">
                            <div class="fileinput-preview thumbnail" data-trigger="fileinput"></div>
                            <div>
                                    <span class="btn btn-info btn-file">
                                        <span class="fileinput-new">Select image</span>
                                        <span class="fileinput-exists">Change</span>
                                        <input type="file" name="banner">
                                    </span>
                                <a href="#" class="btn btn-danger fileinput-exists" data-dismiss="fileinput">Remove</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="form-group fg-line">
                        <label class="" for="">Publish</label>
                        <br/>
                        <br/>
                        <label class="radio radio-inline m-r-20">
                            <input type="radio" name="is_active" value="1" checked="checked">
                            <i class="input-helper"></i>
                            Yes
                        </label>
                        <label class="radio radio-inline m-r-20">
                            <input type="radio" name="is_active" value="0">
                            <i class="input-helper"></i>
                            No
                        </label>
                    </div>
                </div>

                <div class="clearfix"></div>
                {!! csrf_field() !!}
                <div class="col-sm-4">
                    <button type="submit" class="btn btn-primary btn-sm m-t-5">Add Event</button>
                </div>
            </form>
        </div>
    </div>
        </div>
@stop

@section('footer_js')
    {!! Html::script('backend/js/formValidation.min.js') !!}
    {!! Html::script('backend/js/form_bootstrap.min.js') !!}
    {!! Html::script('backend/plugins/bootstrap-select/dist/js/bootstrap-select.js') !!}
    {!! Html::script('backend/plugins/summernote/dist/summernote.min.js') !!}
    {!! Html::script('backend/plugins/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js') !!}
    {!! Html::script('backend/plugins/fileinput/fileinput.min.js') !!}
    {!! Html::script('backend/plugins/chosen_v1.4.2/chosen.jquery.min.js') !!}

    <script>
        $(document).ready(function () {


            $('#datetimepicker6').datetimepicker();
            $('#datetimepicker7').datetimepicker({
                useCurrent: false //Important! See issue #1075
            });
            $("#datetimepicker6").on("dp.change", function (e) {
                $('#datetimepicker7').data("DateTimePicker").minDate(e.date);
            });
            $("#datetimepicker7").on("dp.change", function (e) {
                $('#datetimepicker6').data("DateTimePicker").maxDate(e.date);
            });



            $('#datetimepicker_start').datetimepicker();
            $('#datetimepicker_end').datetimepicker({
                useCurrent: false //Important! See issue #1075
            });
            $("#datetimepicker_start").on("dp.change", function (e) {
                $('#datetimepicker_end').data("DateTimePicker").minDate(e.date);
            });
            $("#datetimepicker_end").on("dp.change", function (e) {
                $('#datetimepicker_start').data("DateTimePicker").maxDate(e.date);
            });

            $('#contentForm')
                    .formValidation({
                        framework: 'bootstrap',
                        excluded: [':disabled'],
                        icon: {
                            valid: 'glyphicon glyphicon-ok',
                            invalid: 'glyphicon glyphicon-remove',
                            validating: 'glyphicon glyphicon-refresh'
                        },
                        fields: {
                            name: {
                                validators: {
                                    notEmpty: {
                                        message: 'The Event Name is required'
                                    }
                                }
                            },
                            "slogan": {
                                validators: {
                                    notEmpty: {
                                        message: 'The Slogan in is required'
                                    }
                                }
                            },
                            location: {
                                validators: {
                                    notEmpty: {
                                        message: 'The location is required'
                                    }
                                }
                            },


                            description: {
                                validators: {
                                    callback: {
                                        message: 'The content is required and cannot be empty',
                                        callback: function (value, validator, $field) {
                                            var code = $('[name="description"]').code();
                                            // <p><br></p> is code generated by Summernote for empty content
                                            return (code !== '' && code !== '<p><br></p>');
                                        }
                                    }
                                }
                            }

                        }
                    })
                    .find('[name="description"]')
                    .summernote({
                        height: 400
                    })
                    .on('summernote.change', function (customEvent, contents, $editable) {
                        // Revalidate the content when its value is changed by Summernote
                        $('#contentForm').formValidation('revalidateField', 'description');
                    })

                    .on('err.form.fv', function (e) {
//                        if (data.field === 'start_date' && !data.fv.isValidField('end_date')) {
//                            // We need to revalidate the end date
//                            data.fv.revalidateField('end_date');
//                        }
//
//                        if (data.field === 'end_date' && !data.fv.isValidField('start_date')) {
//                            // We need to revalidate the start date
//                            data.fv.revalidateField('start_date');
//                        }
//                    }).on('success.field.fv', function (e, data) {
//                        if (data.field === 'start_date' && !data.fv.isValidField('end_date')) {
//                            // We need to revalidate the end date
//                            data.fv.revalidateField('end_date');
//                        }
//
//                        if (data.field === 'end_date' && !data.fv.isValidField('start_date')) {
//                            // We need to revalidate the start date
//                            data.fv.revalidateField('start_date');
//                        }
                    })
                    .end();

        });
    </script>
@stop