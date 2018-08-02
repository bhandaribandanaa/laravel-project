@extends('admin.layout.app')
@section('title', 'Add Countries')
@section('header_css')
    {!! Html::style('backend/vendors/bower_components/bootstrap-select/dist/css/bootstrap-select.css') !!}
    {!! Html::style('backend/vendors/bower_components/summernote/dist/summernote.css') !!}
    {!! Html::style('backend/vendors/chosen_v1.4.2/chosen.min.css') !!}
    {!! Html::style('backend/css/formValidation.min.css') !!}
    <link media="all" type="text/css" rel="stylesheet" href="{{ asset('datepicker.min.css') }}">
@stop

@section('main')
        <div class="container">
            <div class="card">
                <div class="card-header">
                    <h2>Add Countries
                        <small></small>
                    </h2>
                </div>
                <div class="card-body card-padding">
                    <form action="{{ route('admin.countries.addSubmit') }}" method="post" class="row" role="form" id="profile" enctype="multipart/form-data">
                        <div class="col-sm-6">
                            <div class="form-group fg-line">
                                <label class="" for="exampleInputEmail2">Name</label>
                                <input type="text" class="form-control input-sm" name="name"
                                       id="exampleInputEmail2" value="{{ old('name') }}"
                                       placeholder="Enter Name">
                            </div>
                            @if($errors->has('name'))
                                <div class="alert alert-danger fade in">
                                    <button type="button" class="close close-sm" data-dismiss="alert">
                                        <i class="fa fa-times"></i>
                                    </button>
                                    <strong>Warning!</strong> {{ $errors->first('name') }}.
                                </div>
                            @endif
                        </div>

                     

                        <div class="clearfix"></div>
                        <div class="col-sm-6">
                            <div class="form-group fg-line">
                                <label class="" for="">Image</label>
                                <br/>
                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                    <div class="fileinput-preview thumbnail" data-trigger="fileinput">
                                        <img src="">
                                    </div>
                                    <div>
                                    <div style="padding:10px 0 10px 0;">Note <span style="color: red">*</span> : Image size must be : 600 x 450px<br></div>
                           <span class="btn btn-info btn-file">
                           <span class="fileinput-new">Select image</span>
                           
                           <span class="fileinput-exists">Change</span>
                           <input type="file" name="image">
                           </span>
                                        <a href="#" class="btn btn-danger fileinput-exists"
                                           data-dismiss="fileinput">Remove</a>
                                    </div>
                                </div>
                            </div>
                            @if($errors->has('image'))
                                <div class="alert alert-danger fade in">
                                    <button type="button" class="close close-sm" data-dismiss="alert">
                                        <i class="fa fa-times"></i>
                                    </button>
                                    <strong>Warning!</strong> {{ $errors->first('image') }}.
                                </div>
                            @endif

                        </div>

                        <div class="clearfix"></div>

                        <div class="col-sm-12">
                            <div class="form-group fg-line">
                                <label class="" for="">Description*</label>
                                <textarea class="form-control description" name="description" style="height: 600px;"></textarea>
                                </textarea>
                            </div>
                            @if($errors->has('description'))
                                <div class="alert alert-danger fade in">
                                    <button type="button" class="close close-sm" data-dismiss="alert">
                                        <i class="fa fa-times"></i>
                                    </button>
                                    <strong>Warning!</strong> {{ $errors->first('description') }}.
                                </div>
                            @endif
                        </div>


                        <div class="col-sm-12">
                            <div class="form-group fg-line">
                                <label class="" for="">Publish</label>
                                <br/>
                                <br/>
                                <label class="radio radio-inline m-r-20">
                                    <input type="radio" name="status" value="1" checked="checked">
                                    <i class="input-helper"></i>
                                    Yes
                                </label>
                                <label class="radio radio-inline m-r-20">
                                    <input type="radio" name="status" value="0">
                                    <i class="input-helper"></i>
                                    No
                                </label>
                            </div>
                        </div>

                        {!! csrf_field() !!}
                        <div class="col-sm-4">
                            <button type="submit" class="btn btn-primary btn-sm m-t-5">Add Countries</button>
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
    
@stop


















