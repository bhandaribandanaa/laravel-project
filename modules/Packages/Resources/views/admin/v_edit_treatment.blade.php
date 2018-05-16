@extends('admin.layout.app')
@section('title', 'Edit Treatment')
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
            <li><a href="{{ route('admin.packages.index') }}">Treatment</a></li>
            <li class="active">Add new treatment</li>
        </ol>

        <div class="card">
            <div class="card-header">
                <h2>Add new treatment
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
                <form action="{{ route('admin.packages.editTreatmentSubmit') }}" method="post" class="row" role="form"
                      enctype="multipart/form-data" id="contentForm">

                    <div class="col-sm-12">
                        <div class="form-group fg-line">
                            <label class="" for="exampleInputEmail2">Title *</label>
                            <input type="text" class="form-control input-sm" name="title" id="" value="{{ $treatment->title }}"
                                   placeholder="Enter Title">
                        </div>

                    </div>


                    <div class="col-sm-12">
                        <div class="form-group fg-line">
                            <label class="" for="">Link to Packages</label>
                            @if($selected)
                                @foreach($selected as $pack)
                                    <label><input type="checkbox" name=packages[] value="{{ $pack->package_id }}" checked> {{ $pack->title }}</label>
                                @endforeach
                                @if($not_selected != "Empty")
                                    @foreach($not_selected as $pack)
                                        <label><input type="checkbox" name=packages[] value="{{ $pack->id }}"> {{ $pack->title }}</label>
                                    @endforeach
                                @endif
                            @else
                                @foreach($all as $pack)
                                    <label><input type="checkbox" name=packages[] value="{{ $pack->id }}"> {{ $pack->title }}</label>
                                @endforeach
                            @endif

                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group fg-line">
                            <label class="" for="">Publish</label>
                            <br/>
                            <br/>
                            <label class="radio radio-inline m-r-20">
                                <input type="radio" name="status" value="1" @if($treatment->status == 1) checked="checked" @endif>
                                <i class="input-helper"></i>
                                Yes
                            </label>
                            <label class="radio radio-inline m-r-20">
                                <input type="radio" name="status" value="0" @if($treatment->status == 0) checked="checked" @endif>
                                <i class="input-helper"></i>
                                No
                            </label>
                        </div>
                    </div>

                    <div class="clearfix"></div>
                    <input type="hidden" name="id" value="{{ $treatment->id }}">
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
                        title: {
                            validators: {
                                notEmpty: {
                                    message: 'The title is required'
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