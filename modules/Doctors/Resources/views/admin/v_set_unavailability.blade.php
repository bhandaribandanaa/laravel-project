@extends('admin.layout.app')
@section('title', 'Set Unavailability Schedule')
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
            <li class="active">Set unavailability schedule</li>
        </ol>

        <div class="card">
            <div class="card-header">
                <h2>Set unavailability schedule
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
                <form action="{{ route('admin.doctors.unavailableSubmit') }}" method="post" class="row" role="form"
                      enctype="multipart/form-data" id="contentForm">

                    <div class="col-sm-12">
                        <div class="form-group fg-line">
                            <input type="text" name="date_range" id="test">
                            <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
                        </div>

                    </div>

                    <div class="clearfix"></div>
                    <input type="hidden" name="doctor_id" value="{{ $doctor_id }}">
                    {!! csrf_field() !!}
                    <div class="col-sm-4">
                        <button type="submit" class="btn btn-primary btn-sm m-t-5">Set unavailability schedule</button>
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
    <script>
        $(function(){
            $("#description").summernote();
        });

        $(document).ready(function () {
            $('#contentForm')

                .find('[name="display_in[]"]')
                .selectpicker()
                .change(function (e) {
                    // revalidate the color when it is changed
                    $('#contentForm').formValidation('revalidateField', 'display_in[]');
                })
                .end()


                .formValidation({
                    framework: 'bootstrap',
                    excluded: [':disabled'],
                    icon: {
                        valid: 'glyphicon glyphicon-ok',
                        invalid: 'glyphicon glyphicon-remove',
                        validating: 'glyphicon glyphicon-refresh'
                    },
                    fields: {
                        heading: {
                            validators: {
                                notEmpty: {
                                    message: 'The heading is required'
                                }
                            }
                        },
                        "display_in[]": {
                            validators: {
                                notEmpty: {
                                    message: 'The display in is required'
                                }
                            }
                        },
                        page_title: {
                            validators: {
                                notEmpty: {
                                    message: 'The title is required'
                                }
                            }
                        },

                        short_description: {
                            validators: {
                                notEmpty: {
                                    message: 'The short description is required'
                                }
                            }
                        },
                        content: {
                            validators: {
                                callback: {
                                    message: 'The content is required and cannot be empty',
                                    callback: function (value, validator, $field) {
                                        var code = $('[name="content"]').code();
                                        // <p><br></p> is code generated by Summernote for empty content
                                        return (code !== '' && code !== '<p><br></p>');
                                    }
                                }
                            }
                        }

                    }
                })
                .find('[name="content"]')
                .summernote({
                    height: 400
                })
                .on('summernote.change', function (customEvent, contents, $editable) {
                    // Revalidate the content when its value is changed by Summernote
                    $('#contentForm').formValidation('revalidateField', 'content');
                })

                .on('err.form.fv', function (e) {
                })
                .end();

        });
    </script>

    <script type="text/javascript">
        $(function(){

            var date = moment().format("YYYY-MM-DD");

            $('#test').daterangepicker({
                locale: {
                    format: 'YYYY-MM-DD'
                },
                startDate: date,
                endDate: date
            });
        });
    </script>
@stop