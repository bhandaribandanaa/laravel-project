@extends('admin.layout.app')
@section('title', 'Add Video Download')
@section('header_css')
    {!! Html::style('backend/plugins/bootstrap-select/dist/css/bootstrap-select.css') !!}
    {!! Html::style('backend/plugins/chosen_v1.4.2/chosen.min.css') !!}
    {!! Html::style('backend/css/formValidation.min.css') !!}
    <style>
        .help-block {
            color: red !important;
        }
    </style>
@stop
@section('footer_js')
    {!! Html::script('backend/js/formValidation.min.js') !!}
    {!! Html::script('backend/js/form_bootstrap.min.js') !!}
    {!! Html::script('backend/plugins/bootstrap-select/dist/js/bootstrap-select.js') !!}
    {!! Html::script('backend/plugins/fileinput/fileinput.min.js') !!}
    {!! Html::script('backend/plugins/chosen_v1.4.2/chosen.jquery.min.js') !!}

    <script>
        $(document).ready(function () {
            $('#contentForm')
                    .find('[name="categories[]"]')
                    .selectpicker()
                    .change(function (e) {
                        // revalidate the color when it is changed
                        $('#contentForm').formValidation('revalidateField', 'categories[]');
                    })
                    .end()

                    .find('[name="access_type"]')
                    .selectpicker()
                    .change(function (e) {
                        // revalidate the color when it is changed
                        $('#contentForm').formValidation('revalidateField', 'access_type');
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
                            name: {
                                validators: {
                                    notEmpty: {
                                        message: 'The name is required'
                                    }
                                }
                            },
                            "categories[]": {
                                validators: {
                                    notEmpty: {
                                        message: 'The category in is required'
                                    }
                                }
                            },
                            "access_type": {
                                validators: {
                                    notEmpty: {
                                        message: 'The access type in is required'
                                    }
                                }
                            },
                            video_url: {
                                validators: {
                                    notEmpty: {
                                        message: 'The  video url is required'
                                    }
                                }
                            },

                        }
                    })

                    .on('err.form.fv', function (e) {
                    })
                    .end();


        });
    </script>

@stop
@section('main')
    <div class="container">
    <ol class="breadcrumb" style="margin-bottom: 5px;">
        <li><a href="{{ route('admin.dashboard') }}">Home</a></li>
        <li><a href="{{ route('admin.download.video.index') }}">Video Download</a></li>
        <li class="active">Add Download</li>
    </ol>

    <div class="card">
        <div class="card-header">
            <h2>Add Download
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


            <form action="{{ route('admin.download.video.add') }}" method="post" class="row" role="form"
                  enctype="multipart/form-data" id="contentForm">

                <div class="col-sm-12">
                    <div class="form-group fg-line">
                        <label class="" for="exampleInputEmail2">Name *</label>
                        <input type="text" class="form-control input-sm" name="name" id=""
                               placeholder="Enter File Name" value="{{ old('name') }}">
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="form-group fg-line">
                        <label class="" for="exampleInputEmail2">Event</label>
                        {!! Form::select('event_id', $event_select, '', array('class'=>'selectpicker form-control input-sm','placeholder'=>'Select Event')) !!}
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="form-group fg-line">
                        <label class="" for="exampleInputEmail2">Access Type</label>
                        {!! Form::select('access_type', array( '1' => 'Public','0' => 'Members Only'), '', ['class'=>'selectpicker form-control input-sm','placeholder'=>'Access Type']) !!}
                    </div>
                </div>

                <div class="col-sm-12">
                    <div class="form-group fg-line">
                        <label class="" for="">Video URL</label>
                        <input type="url" name="video_url" class="form-control input-sm">
                    </div>
                </div>

                <div class="clearfix"></div>
                <div class="col-sm-6">
                    <p class="f-500 c-black m-b-15">Category</p>
                    {!! Form::select('categories[]', $category_select, '', array('class'=>'selectpicker',"multiple"=>"true")) !!}
                </div>
                <div class="col-sm-6">
                    <div class="form-group fg-line">
                        <label class="" for="">Publish</label>
                        <br/>
                        <label class="radio radio-inline m-r-20">
                            <input type="radio" name="is_active" value="1" checked>
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
                <div class="col-sm-12">
                    <div class="form-group fg-line">
                        <label class="" for="">Description</label>
                        <textarea name="description" class="form-control" rows="4"
                                  placeholder="Description">{{ Input::old('description') }}</textarea>
                    </div>
                </div>
                <div class="clearfix"></div>
                {!! csrf_field() !!}
                <div class="col-sm-4">
                    <button type="submit" class="btn btn-primary btn-sm m-t-5">Add Download</button>
                </div>
            </form>
        </div>
    </div>
    </div>
@stop
@section('footer_js')
@stop