@extends('admin.layout.app')
@section('title', 'Edit Category')
@section('header_css')
    {!! Html::style('backend/plugins/bootstrap-select/dist/css/bootstrap-select.css') !!}
    {!! Html::style('backend/plugins/chosen_v1.4.2/chosen.min.css') !!}
    {!! Html::style('backend/css/formValidation.min.css') !!}
@stop
@section('footer_js')
    {!! Html::script('backend/js/formValidation.min.js') !!}
    {!! Html::script('backend/js/form_bootstrap.min.js') !!}
    {!! Html::script('backend/plugins/bootstrap-select/dist/js/bootstrap-select.js') !!}
    {!! Html::script('backend/plugins/fileinput/fileinput.min.js') !!}
    {!! Html::script('backend/plugins/chosen_v1.4.2/chosen.jquery.min.js') !!}

    <script>
        $(document).ready(function () {
            $('#fileForm').formValidation({
                framework: 'bootstrap',
                icon: {
                    valid: 'glyphicon glyphicon-ok',
                    invalid: 'glyphicon glyphicon-remove',
                    validating: 'glyphicon glyphicon-refresh'
                },
                fields: {
                    name: {
                        validators: {
                            notEmpty: {
                                message: 'The  Name is required'
                            }
                        }
                    },
                }
            })
        });
    </script>

@stop
@section('main')
    <div class="container">
    <ol class="breadcrumb" style="margin-bottom: 5px;">
        <li><a href="{{ route('admin.dashboard') }}">Home</a></li>
        <li><a href="{{ route('admin.download.category.index') }}">Download Category</a></li>
        <li class="active">Edit Category</li>
    </ol>

    <div class="card">
        <div class="card-header">
            <h2>Edit Category
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


            <form action="{{ route('admin.downloads.category.edit',$category->id) }}" method="post" class="row"
                  role="form"
                  enctype="multipart/form-data" id="fileForm">

                <div class="col-sm-12">
                    <div class="form-group fg-line">
                        <label class="" for="exampleInputEmail2">Name *</label>
                        <input type="text" class="form-control input-sm" name="name" id=""
                               placeholder="Enter File Name" value="{{ $category->name }}">
                    </div>
                </div>


                <div class="col-sm-12">
                    <div class="form-group fg-line">
                        <label class="" for="">Description</label>
                        <textarea name="description" class="form-control" rows="3"
                                  placeholder="Description">{{ $category->description }}</textarea>
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="form-group fg-line">
                        <label class="" for="">Publish</label>
                        <br/>
                        <label class="radio radio-inline m-r-20">
                            <input type="radio" name="is_active" value="1"
                                   @if($category->is_active == '1') checked="checked" @endif>
                            <i class="input-helper"></i>
                            Yes
                        </label>
                        <label class="radio radio-inline m-r-20">
                            <input type="radio" name="is_active" value="0"
                                   @if($category->is_active == '0') checked="checked" @endif>
                            <i class="input-helper"></i>
                            No
                        </label>
                    </div>
                </div>

                <div class="clearfix"></div>
                {!! csrf_field() !!}
                <div class="col-sm-4">
                    <button type="submit" class="btn btn-primary btn-sm m-t-5">Update Category</button>
                </div>
            </form>
        </div>
    </div>
    </div>
@stop