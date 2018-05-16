@extends('admin.layout.app')
@section('title', 'Edit Choose')
@section('main')
    <div class="container">
    <ol class="breadcrumb" style="margin-bottom: 5px;">
        <li><a href="{{ route('admin.dashboard') }}">Home</a></li>
        <li><a href="{{ route('admin.choose.index') }}">Choose</a></li>
        <li class="active">Add new Gallery</li>
    </ol>

    <div class="card">
        <div class="card-header">
            <h2>Edit Choose Title
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
            <form action="{{ route('admin.choose.editSubmit') }}" method="post" class="row" role="form"
                  enctype="multipart/form-data" id="contentForm">

                <div class="col-sm-12">
                    <div class="form-group fg-line">
                        <label class="" for="exampleInputEmail2">Title *</label>
                        <input type="text" class="form-control input-sm" name="title" id=""
                               placeholder="Enter Gallery Name" value="{{ $choose->title }}">
                    </div>
                </div>

                <div class="col-sm-12">
                    <div class="form-group fg-line">
                        <label class="" for="exampleInputEmail2">Subtitle *</label>
                        <input type="text" class="form-control input-sm" name="subtitle" id=""
                               placeholder="Enter Gallery Name" value="{{ $choose->subtitle }}">
                    </div>
                </div>
                


                <div class="col-sm-6">
                    <div class="form-group fg-line">
                        <label class="" for="">Publish</label>
                        <br/>
                        <br/>
                        <label class="radio radio-inline m-r-20">
                            <input type="radio" name="is_active" value="1" @if($choose->is_active == 1) checked="checked" @endif>
                            <i class="input-helper"></i>
                            Yes
                        </label>
                        <label class="radio radio-inline m-r-20">
                            <input type="radio" name="is_active" value="0" @if($choose->is_active == 0) checked="checked" @endif>
                            <i class="input-helper"></i>
                            No
                        </label>
                    </div>
                </div>

                <div class="clearfix"></div>
                
                <input type="hidden" name="id" value="{{ $choose->id }}">
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
@stop