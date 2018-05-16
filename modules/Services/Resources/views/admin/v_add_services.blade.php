@extends('admin.layout.app')
@section('title', 'Add Service')
@section('header_css')
    {!! Html::style('backend/vendors/bower_components/bootstrap-select/dist/css/bootstrap-select.css') !!}
    {!! Html::style('backend/vendors/bower_components/summernote/dist/summernote.css') !!}
    {!! Html::style('backend/vendors/chosen_v1.4.2/chosen.min.css') !!}
    {!! Html::style('backend/css/formValidation.min.css') !!}
    {!! Html::style('css/medical-guide-icons.css') !!}
    <link media="all" type="text/css" rel="stylesheet" href="{{ asset('datepicker.min.css') }}">
    <style>
        .bigger{
            font-size: 35px;
            text-align: center;
        }
    </style>
@stop

@section('main')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h2>Add Service
                    <small></small>
                </h2>
            </div>
            <div class="card-body card-padding">
                <form action="{{ route('admin.services.addSubmit') }}" method="post" class="row" role="form" id="profile" enctype="multipart/form-data">
                    <div class="col-sm-6">
                        <div class="form-group fg-line">
                            <label class="" for="exampleInputEmail2">Title</label>
                            <input type="text" class="form-control input-sm" name="title"
                                   id="exampleInputEmail2" value="{{ old('title') }}"
                                   placeholder="Enter Title">
                        </div>
                        @if($errors->has('title'))
                            <div class="alert alert-danger fade in">
                                <button type="button" class="close close-sm" data-dismiss="alert">
                                    <i class="fa fa-times"></i>
                                </button>
                                <strong>Warning!</strong> {{ $errors->first('title') }}.
                            </div>
                        @endif
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group fg-line">
                            <label class="" for="exampleInputEmail2">Icon*</label>
                            <select name="icon">
                                <option value=""> Select an icon </option>
                                <option class="icon-heart9 bigger" value="icon-heart9"></option>
                                <option class="icon-lockedheart bigger" value="icon-lockedheart"></option>
                                <option class="icon-heart-beat bigger" value="icon-heart-beat"></option>
                                <option class="icon-doctor bigger" value="icon-doctor"></option>
                                <option class="icon-eye bigger" value="icon-eye"></option>
                                <option class="icon-ambulance bigger" value="icon-ambulance"></option>
                            </select>
                        </div>
                        @if($errors->has('icon'))
                            <div class="alert alert-danger fade in">
                                <button type="button" class="close close-sm" data-dismiss="alert">
                                    <i class="fa fa-times"></i>
                                </button>
                                <strong>Warning!</strong> {{ $errors->first('icon') }}.
                            </div>
                        @endif
                    </div>

                    <div class="clearfix"></div>


                    <div class="clearfix"></div>


                    <div class="clearfix"></div>
                    <div class="col-sm-6">
                        <div class="form-group fg-line">
                            <label class="" for="">News Image</label>
                            <br/>
                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                <div class="fileinput-preview thumbnail" data-trigger="fileinput">
                                    <img src="">
                                </div>
                                <div>
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
                        <button type="submit" class="btn btn-primary btn-sm m-t-5">Add Service</button>
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