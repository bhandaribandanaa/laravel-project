@extends('admin.layout.app')
@section('title', 'Add Content')
@section('header_css')
    {!! Html::style('backend/vendors/bower_components/bootstrap-select/dist/css/bootstrap-select.css') !!}
    {!! Html::style('backend/vendors/bower_components/summernote/dist/summernote.css') !!}
    {!! Html::style('backend/vendors/chosen_v1.4.2/chosen.min.css') !!}
    {!! Html::style('backend/css/formValidation.min.css') !!}
@stop

@section('main')
    <div class="container">
    <ol class="breadcrumb" style="margin-bottom: 5px;">
        <li><a href="{{ route('admin.dashboard') }}">Home</a></li>
        <li><a href="{{ route('admin.content.index') }}">Content</a></li>
        <li class="active">Edit Content</li>
    </ol>

    <div class="card">
        <div class="card-header">
            <h2>Edit Content
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
            <form action="{{ route('admin.content.edit',$content->id) }}" method="post" class="row" role="form"
                  enctype="multipart/form-data" id="contentForm">

                <div class="col-sm-12">
                    <div class="form-group fg-line">
                        <label class="" for="exampleInputEmail2">Heading *</label>
                        <input type="text" class="form-control input-sm" name="heading" id=""
                               value="{{ $content->heading }}"
                               placeholder="Enter Heading">
                    </div>

                </div>
                <div class="col-sm-12">
                    <div class="form-group fg-line">
                        <label class="" for="">Title *</label>
                        <input type="text" class="form-control input-sm" name="page_title" id=""
                               value="{{ $content->page_title }}"
                               placeholder="Enter Title">
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="form-group fg-line">
                        <label class="" for="">Meta Tags</label>
                        <input type="text" class="form-control input-sm" name="meta_tags" id=""
                               value="{{ $content->meta_tags }}"
                               placeholder="Enter Title">
                    </div>
                </div>

                <div class="col-sm-12">
                    <div class="form-group fg-line">
                        <label class="" for="">Meta description</label>
                        <textarea name="meta_description" class="form-control" rows="3"
                                  placeholder="Meta description">{{ $content->meta_description }}</textarea>
                    </div>
                </div>

                <div class="col-sm-6">
                    <p class="f-500 m-b-15 c-black">Parent Content</p>
                    {!! $parents_select !!}
                </div>
                <div class="col-sm-6">
                    <p class="f-500 c-black m-b-15">Display In</p>
                    {!! Form::select('display_in[]', $menu_location, explode(', ', $content->display_in), array('class'=>'selectpicker',"multiple"=>"true")) !!}
                </div>

                <div class="col-sm-12">
                    <br/>

                    <div class="form-group fg-line">
                        <label class="" for="">Short description*</label>
                        <textarea name="short_description" class="form-control" rows="5"
                                  placeholder="Meta description">{{ $content->short_description }}</textarea>
                    </div>
                </div>

                <div class="col-sm-12">
                    <div class="form-group fg-line">
                        <label class="" for="">Content*</label>
                        <textarea class="form-control" name="content"
                                  style="height: 300px;">{!! $content->description !!}</textarea>
                    </div>
                </div>

                <div class="col-sm-12">
                    <div class="form-group fg-line">
                        <label class="" for="">Banner</label>
                        <br/>

                        <div class="fileinput fileinput-new" data-provides="fileinput">
                            <div class="fileinput-preview thumbnail" data-trigger="fileinput">

                                @if($content->photo && file_exists('uploads/media/'. $content->photo->file_name))
                                    <img src="{{URL::asset('uploads/media/'. $content->photo->file_name) }}">
                                @endif
                            </div>
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
                        <label class="" for="">Display Order</label>
                        <input type="text" class="form-control col-xs-3 input-sm" name="display_order" id=""
                               value="{{ $content->order_postition }}"
                               placeholder="Display Order">
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
    {!! Html::script('backend/vendors/bower_components/bootstrap-select/dist/js/bootstrap-select.js') !!}
    {!! Html::script('backend/vendors/bower_components/summernote/dist/summernote.min.js') !!}
    {!! Html::script('backend/vendors/fileinput/fileinput.min.js') !!}
    {!! Html::script('backend/vendors/chosen_v1.4.2/chosen.jquery.min.js') !!}
    <script>
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
@stop