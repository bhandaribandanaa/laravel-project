@extends('admin.layout.app')
@section('title', 'Edut Demands')
@section('header_css')
    {!! Html::style('backend/vendors/bower_components/bootstrap-select/dist/css/bootstrap-select.css') !!}
    {!! Html::style('backend/vendors/bower_components/summernote/dist/summernote.css') !!}
    {!! Html::style('backend/vendors/chosen_v1.4.2/chosen.min.css') !!}
    {!! Html::style('backend/css/formValidation.min.css') !!}
    <link media="all" type="text/css" rel="stylesheet" href="{{ asset('datepicker.min.css') }}">
@stop


@section('main')
    <div class="container">
    <ol class="breadcrumb" style="margin-bottom: 5px;">
        <li><a href="{{ route('admin.dashboard') }}">Home</a></li>
        <li><a href="{{ route('admin.demands.index') }}">Demand</a></li>
        <li class="active">Edit Demand</li>
    </ol>

    <div class="card">
        <div class="card-header">
            <h2>Edit Demands
                        <small></small>
                    </h2>
                </div>
                <div class="card-body card-padding">
                    <form action="{{ route('admin.demands.editSubmit') }}" method="post" class="row" role="form" id="profile" enctype="multipart/form-data">
                        <div class="col-sm-6">
                            <div class="form-group fg-line">
                                <label class="" for="exampleInputEmail2">Job Position</label>
                                <input type="text" class="form-control input-sm" name="job_position"
                                       id="exampleInputEmail2" value="{{ $demands->job_position }}"
                                       placeholder="Enter Name">
                            </div>
                            @if($errors->has('job_position'))
                                <div class="alert alert-danger fade in">
                                    <button type="button" class="close close-sm" data-dismiss="alert">
                                        <i class="fa fa-times"></i>
                                    </button>
                                    <strong>Warning!</strong> {{ $errors->first('job_position') }}.
                                </div>
                            @endif
                        </div>



                           <div class="col-sm-6">
                            <div class="form-group fg-line">
                                <label class="" for="exampleInputEmail2">Salary</label>
                                <input type="text" class="form-control input-sm" name="salary"
                                       id="exampleInputEmail2" value="{{ $demands->salary}}"
                                       placeholder="Enter Salary
                                       ">
                            </div>
                            @if($errors->has('salary'))
                                <div class="alert alert-danger fade in">
                                    <button type="button" class="close close-sm" data-dismiss="alert">
                                        <i class="fa fa-times"></i>
                                    </button>
                                    <strong>Warning!</strong> {{ $errors->first('salary') }}.
                                </div>
                            @endif
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group fg-line">
                                <label class="" for="exampleInputEmail2">Type</label>
                                <input type="text" class="form-control input-sm" name="type"
                                       id="exampleInputEmail2" value="{{ $demands->type}}"
                                       placeholder="Enter Type">
                            </div>
                            @if($errors->has('type'))
                                <div class="alert alert-danger fade in">
                                    <button type="button" class="close close-sm" data-dismiss="alert">
                                        <i class="fa fa-times"></i>
                                    </button>
                                    <strong>Warning!</strong> {{ $errors->first('type') }}.
                                </div>
                            @endif
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group fg-line">
                                <label class="" for="exampleInputEmail2">Request no.</label>
                                <input type="text" class="form-control input-sm" name="request_number"
                                       id="exampleInputEmail2" value="{{ $demands->request_number }}"
                                       placeholder="Enter Request number">
                            </div>
                            @if($errors->has('request_number'))
                                <div class="alert alert-danger fade in">
                                    <button type="button" class="close close-sm" data-dismiss="alert">
                                        <i class="fa fa-times"></i>
                                    </button>
                                    <strong>Warning!</strong> {{ $errors->first('request_number') }}.
                                </div>
                            @endif
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group fg-line">
                                <label class="" for="exampleInputEmail2">Fooding.</label>
                                <input type="text" class="form-control input-sm" name="fooding"
                                       id="exampleInputEmail2" value="{{$demands->fooding }}"
                                       placeholder="Enter Fooding">
                            </div>
                            @if($errors->has('fooding'))
                                <div class="alert alert-danger fade in">
                                    <button type="button" class="close close-sm" data-dismiss="alert">
                                        <i class="fa fa-times"></i>
                                    </button>
                                    <strong>Warning!</strong> {{ $errors->first('fooding') }}.
                                </div>
                            @endif
                        </div>



                        <div class="col-sm-6">
                            <div class="form-group fg-line">
                                <label class="" for="exampleInputEmail2">Accomodation</label>
                                <input type="text" class="form-control input-sm" name="accomodation"
                                       id="exampleInputEmail2" value="{{ $demands->accomodation }}"
                                       placeholder="Enter Accomodation">
                            </div>
                            @if($errors->has('accomodation'))
                                <div class="alert alert-danger fade in">
                                    <button type="button" class="close close-sm" data-dismiss="alert">
                                        <i class="fa fa-times"></i>
                                    </button>
                                    <strong>Warning!</strong> {{ $errors->first('accomodation') }}.
                                </div>
                            @endif
                        </div>

                        <div class="col-sm-12">
                            <div class="form-group fg-line">
                                <label class="" for="">Published Date*</label>
                                <input type="text" id="published_date" name="published_date">
                                </textarea>
                            </div>
                            @if($errors->has('created_at'))
                                <div class="alert alert-danger fade in">
                                    <button type="button" class="close close-sm" data-dismiss="alert">
                                        <i class="fa fa-times"></i>
                                    </button>
                                    <strong>Warning!</strong> {{ $errors->first('created_at') }}.
                                </div>
                            @endif
                        </div>



                        <div class="col-sm-12">
                            <div class="form-group fg-line">
                                <label class="" for="">Publish</label>
                                <br/>
                                <br/>
                                <label class="radio radio-inline m-r-20">
                                    <input type="radio" name="status" value="active" checked="checked">
                                    <i class="input-helper"></i>
                                    Yes
                                </label>
                                <label class="radio radio-inline m-r-20">
                                    <input type="radio" name="status" value="not_active">
                                    <i class="input-helper"></i>
                                    No
                                </label>
                            </div>
                        </div>
                        <input type="hidden" name="id" value="{{ $demands->id }}">

                        {!! csrf_field() !!}
                        <div class="col-sm-4">
                            <button type="submit" class="btn btn-primary btn-sm m-t-5">Add Demands</button>
                        </div>
                    </form>
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
    <script src="{{ asset('datepicker.min.js') }}"></script>
    <script>
        $(function(){
            $(".description").summernote();
            $("#published_date").datepicker({
                format: 'yyyy-mm-dd',
            });
        });
    </script>
@stop