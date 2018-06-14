@extends('admin.layout.app')
@section('title', 'Edit Settings')
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
                <h2>Edit Settings
                    <small></small>
                </h2>
            </div>
            <div class="card-body card-padding">
                <form action="{{ route('admin.settings.editSubmit') }}" method="post" class="row" role="form" id="profile" enctype="multipart/form-data">
                    <div class="col-sm-6">
                        <div class="form-group fg-line">
                            <label class="" for="exampleInputEmail2">Name</label>
                            <input type="text" class="form-control input-sm" name="name"
                                   id="exampleInputEmail2" value="{{ $settings->name }}"
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

                      <div class="col-sm-6">
                            <div class="form-group fg-line">
                                <label class="" for="exampleInputEmail2">Slug</label>
                                <input type="text" class="form-control input-sm" name="slug"
                                       id="exampleInputEmail2" value="{{ $settings->slug}}"
                                       placeholder="Enter slug
                                       ">
                            </div>
                            @if($errors->has('slug'))
                                <div class="alert alert-danger fade in">
                                    <button type="button" class="close close-sm" data-dismiss="alert">
                                        <i class="fa fa-times"></i>
                                    </button>
                                    <strong>Warning!</strong> {{ $errors->first('slug') }}.
                                </div>
                            @endif
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group fg-line">
                                <label class="" for="exampleInputEmail2">Value</label>
                                <input type="text" class="form-control input-sm" name="value"
                                       id="exampleInputEmail2" value="{{ $settings->value }}"
                                       placeholder="Enter Value">
                            </div>
                            @if($errors->has('value'))
                                <div class="alert alert-danger fade in">
                                    <button type="button" class="close close-sm" data-dismiss="alert">
                                        <i class="fa fa-times"></i>
                                    </button>
                                    <strong>Warning!</strong> {{ $errors->first('value') }}.
                                </div>
                            @endif
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group fg-line">
                                <label class="" for="exampleInputEmail2">Type</label>
                                <input type="text" class="form-control input-sm" name="type"
                                       id="exampleInputEmail2" value="{{ $settings->type }}"
                                       placeholder="Enter type
                                       ">
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


                            <div class="clearfix"></div>



                     <div class="form-group fg-line">
                        <label class="" for="">Publish</label>
                        <br/>
                        <br/>
                        <label class="radio radio-inline m-r-20">
                            <input type="radio" name="status" value="active"
                                   @if($settings->status=='active')checked="checked" @endif>
                            <i class="input-helper"></i>
                            Yes
                        </label>
                        <label class="radio radio-inline m-r-20">
                            <input type="radio" name="status" value="not_active"
                                   @if($settings->status=='not_active')checked="checked" @endif>
                            <i class="input-helper"></i>
                            No
                        </label>
                    </div>
                    <input type="hidden" name="id" value="{{ $settings->id }}">
                    {!! csrf_field() !!}
                        {!! csrf_field() !!}
                        <div class="col-sm-4">
                            <button type="submit" class="btn btn-primary btn-sm m-t-5">Edit Settings</button>
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
            var date = {!! $settings->published_date !!};
            $("#published_date").datepicker({
                format: 'yyyy-mm-dd',
            });

            $("#removeImage").click(function(){
                var id = $(this).data("id");
                var url = "{{ url('admin/settings/removeImage') }}/"+id;

                $.ajax({
                    type: "GET",
                    url: url,
                    datatype: "json",
                    success: function(data){
                        var obj = jQuery.parseJSON(data);
                        if(obj.status == 'success'){
                            swal({
                                title: "Success!",
                                text: "Image has been removed.",
                                imageUrl: "{{ asset('energyAdmin/img') }}/thumbs-up.png",
                                timer: 2000,
                                showConfirmButton: false
                            });

                            $("#newsImage").attr("src","");

                        }
                    }
                });
            });
        });
    </script>
@stop