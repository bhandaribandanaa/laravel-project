@extends('admin.layout.app')
@section('title', 'Edit Event')
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
        <li class="active">Edit Event Content</li>
    </ol>

    <div class="card">
        <div class="card-header">
            <h2>Edit Event Content
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
            <form action="{{ route('admin.event.content.edit',array($event->id,$content->id)) }}" method="post"
                  class="row" role="form"
                  enctype="multipart/form-data" id="contentForm">

                <div class="col-sm-12">
                    <div class="form-group fg-line">
                        <label class="" for="exampleInputEmail2">Title *</label>
                        <input type="text" class="form-control input-sm" name="title" id=""
                               placeholder="Enter Event Name" value="{{ $content->title }}">
                    </div>
                </div>


                <div class="col-sm-12">
                    <div class="form-group fg-line">
                        <label class="" for="">Description*</label>
                        <textarea class="form-control" name="description"
                                  style="height: 300px;">{{ $content->description }}</textarea>
                        </textarea>
                    </div>
                </div>


                <div class="col-sm-6">
                    <div class="form-group fg-line">
                        <label class="" for="">Publish</label>
                        <br/>
                        <br/>
                        <label class="radio radio-inline m-r-20">
                            <input type="radio" name="is_active" value="1"
                                   @if($content->is_active=='1')checked="checked" @endif>
                            <i class="input-helper"></i>
                            Yes
                        </label>
                        <label class="radio radio-inline m-r-20">
                            <input type="radio" name="is_active" value="0"
                                   @if($content->is_active=='0')checked="checked" @endif>
                            <i class="input-helper"></i>
                            No
                        </label>
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="form-group fg-line">
                        <label class="" for="">Display Order</label>
                        <br/>
                        <input type="text" class="form-control input-sm" name="display_order" id=""
                               placeholder="Enter display order" value="{{ $content->display_order }}">
                    </div>
                </div>

                <div class="clearfix"></div>
                {!! csrf_field() !!}
                <div class="col-sm-4">
                    <button type="submit" class="btn btn-primary btn-sm m-t-5">Update Content</button>
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

//                            start_date: {
//                                validators: {
//                                    notEmpty: {
//                                        message: 'The start date is required'
//                                    },
//
//                                }
//                            },
//                            start_time: {
//                                validators: {
//                                    notEmpty: {
//                                        message: 'The start time is required'
//                                    }
//                                }
//                            },
//                            end_date: {
//                                validators: {
//                                    notEmpty: {
//                                        message: 'The end date is required'
//                                    },
//                                }
//                            },
//                            end_time: {
//                                validators: {
//                                    notEmpty: {
//                                        message: 'The end time is required'
//                                    }
//                                }
//                            },

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