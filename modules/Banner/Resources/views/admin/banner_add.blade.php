@extends('admin.layout.app')
@section('title', 'Add Gallery')
@section('header_css')
    {!! Html::style('backend/plugins/chosen_v1.4.2/chosen.min.css') !!}
    {!! Html::style('backend/css/formValidation.min.css') !!}
    {!! Html::style('backend/plugins/summernote/dist/summernote.css') !!}
@stop
@section('footer_js')
    {!! Html::script('backend/js/formValidation.min.js') !!}
    {!! Html::script('backend/js/form_bootstrap.min.js') !!}
    {!! Html::script('backend/plugins/fileinput/fileinput.min.js') !!}
    {!! Html::script('backend/plugins/chosen_v1.4.2/chosen.jquery.min.js') !!}
    {!! Html::script('backend/plugins/summernote/dist/summernote.min.js') !!}
    <script>
        $(function(){
            $(".heading").summernote();
        });
    </script>

    <script>
        $(document).ready(function () {
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
                            title: {
                                validators: {
                                    notEmpty: {
                                        message: 'The Title is required'
                                    }
                                }
                            },
                            subtitle: {
                                validators: {
                                    notEmpty: {
                                        message: 'The Sub-title is required'
                                    }
                                }
                            },
                            heading: {
                                validators: {
                                    notEmpty: {
                                        message: 'The Heading is required'
                                    }
                                }
                            }
                            banner: {
                                validators: {
                                    notEmpty: {
                                        message: 'The Banner is required'
                                    }
                                }
                            },
                            url: {
                                validators: {
                                    uri: {
                                        message: 'The url is not valid'
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
        <li><a href="{{ route('admin.banner.index') }}">Banner</a></li>
        <li class="active">Add new Banner</li>
    </ol>

    <div class="card">
        <div class="card-header">
            <h2>Add new Banner
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
            <form action="{{ route('admin.banner.add') }}" method="post" class="row" role="form"
                  enctype="multipart/form-data" id="contentForm">

                <div class="col-sm-12">
                    <div class="form-group fg-line">
                        <label class="" for="exampleInputEmail2">Title *</label>
                        <input type="text" class="form-control input-sm" name="title" id=""
                               placeholder="Title" value="{{ old('title') }}">
                    </div>
                </div>

                <div class="col-sm-12">
                    <div class="form-group fg-line">
                        <label class="" for="exampleInputEmail2">Sub Title *</label>
                        <input type="text" class="form-control input-sm" name="subtitle" id=""
                               placeholder="Title" value="{{ old('subtitle') }}">
                    </div>
                </div>

                <div class="col-sm-12">
                    <div class="form-group fg-line">
                        <label class="" for="">Heading*</label>
                        <textarea class="form-control heading" name="heading" rows="5"
                        >{{ old('heading') }}</textarea>
                        </textarea>
                    </div>
                </div>


                <div class="col-sm-12">
                    <div class="form-group fg-line">
                        <label class="" for="exampleInputEmail2">Sub Heading*</label>
                        <input type="text" class="form-control input-sm" name="subheading" id=""
                               placeholder="Sub-heading" value="{{ old('subheading') }}">
                    </div>
                </div>


                <div class="col-sm-12">
                    <div class="form-group fg-line">
                        <label class="" for="exampleInputEmail2">Url</label>
                        <input type="text" class="form-control input-sm" name="url" id=""
                               placeholder="url" value="{{ old('url') }}">
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
                    <br>
                    Note <span style="color: red">*</span> : Image size must be : 1600 x 640px
                </div>

                <div class="col-sm-6">
                    <div class="form-group fg-line">
                        <label class="" for="">Button Label</label>
                        <br/>
                        <input type="text" class="form-control input-sm" name="button_label" id=""
                               placeholder="Button Label" value="{{ old('button_label') }}">
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="form-group fg-line">
                        <label class="" for="">Publish</label>
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
                    <button type="submit" class="btn btn-primary btn-sm m-t-5">Add Banner</button>
                </div>
            </form>
        </div>
    </div>
    </div>
@stop
