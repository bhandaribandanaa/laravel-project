@extends('admin.layout.app')
@section('title', 'Add Testimonial')
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
            <li><a href="{{ route('admin.testimonials.index') }}">Testimonial</a></li>
            <li class="active">Edit Testimonial</li>
        </ol>

        <div class="card">
            <div class="card-header">
                <h2>Edit Testimonials
                    <small></small>
                </h2>
            </div>
            <div class="card-body card-padding">
                <form action="{{ route('admin.testimonials.editSubmit') }}" method="post" class="row" role="form" id="profile" enctype="multipart/form-data">
                    <div class="col-sm-6">
                        <div class="form-group fg-line">
                            <label class="" for="exampleInputEmail2">Name</label>
                            <input type="text" class="form-control input-sm" name="name"
                                   id="exampleInputEmail2" value="{{ $testimonials->name }}"
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
                            <label class="" for="exampleInputEmail2">Company Name</label>
                            <input type="text" class="form-control input-sm" name="company_name"
                                   id="exampleInputEmail2" value="{{ $testimonials->company_name }}"
                                   placeholder="Enter Company Name">
                        </div>
                        @if($errors->has('company_name'))
                            <div class="alert alert-danger fade in">
                                <button type="button" class="close close-sm" data-dismiss="alert">
                                    <i class="fa fa-times"></i>
                                </button>
                                <strong>Warning!</strong> {{ $errors->first('company_name') }}.
                            </div>
                        @endif
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group fg-line">
                            <label class="" for="exampleInputEmail2">Rating (1 to 5)</label>
                            <input type="text" class="form-control input-sm" name="rating"
                                   id="exampleInputEmail2" value="{{ $testimonials->rating }}"
                                   placeholder="Enter Rating (1 to 5)">
                        </div>
                        @if($errors->has('rating'))
                            <div class="alert alert-danger fade in">
                                <button type="button" class="close close-sm" data-dismiss="alert">
                                    <i class="fa fa-times"></i>
                                </button>
                                <strong>Warning!</strong> {{ $errors->first('rating') }}.
                            </div>
                        @endif
                    </div>

                    <div class="clearfix"></div>
                    <div class="col-sm-12">
                        <div class="form-group fg-line">
                            <label class="" for="">Testimonial Image</label>
                            <br/>
                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                <div class="fileinput-preview thumbnail" data-trigger="fileinput">
                                    <img id="testimonialImage" src="{{ asset('uploads/testimonials/'.$testimonials->image) }}">
                                </div><div style="padding:10px 0 10px 0;">Note <span style="color: red">*</span> : Image size must be : 600 x 450px<br></div>
                                <div>
                           <span class="btn btn-info btn-file">
                           <span id="selectImage" class="fileinput-new">Select image</span>
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
                        <br>

                    </div>

                    <div class="clearfix"></div>
                    <div class="col-sm-12">
                        <div class="form-group fg-line">
                            @if($testimonials->image)
                                <a id="removeImage" href="javascript:void(0)" class="btn btn-danger" data-id ="{{ $testimonials->id }}">Remove Original Image</a>
                            @endif
                        </div>
                    </div>

                    <div class="clearfix"></div>

                    <div class="col-sm-12">
                        <div class="form-group fg-line">
                            <label class="" for="">Description*</label>

                            <textarea class="form-control description" name="description" style="height: 600px;">{{ $testimonials->description }}</textarea>
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
                    <div class="clearfix"></div>



                    <div class="form-group fg-line">
                        <label class="" for="">Publish</label>
                        <br/>
                        <br/>
                        <label class="radio radio-inline m-r-20">
                            <input type="radio" name="status" value="active"
                                   @if($testimonials->status=='active')checked="checked" @endif>
                            <i class="input-helper"></i>
                            Yes
                        </label>
                        <label class="radio radio-inline m-r-20">
                            <input type="radio" name="status" value="not_active"
                                   @if($testimonials->status=='')checked="checked" @endif>
                            <i class="input-helper"></i>
                            No
                        </label>
                    </div>
                    <input type="hidden" name="id" value="{{ $testimonials->id }}">
                    {!! csrf_field() !!}
                    <div class="col-sm-4">
                        <button type="submit" class="btn btn-primary btn-sm m-t-5">Edit Testimonials</button>
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

            $("#removeImage").click(function(){
                var id = $(this).data("id");
                var url = "{{ url('admin/news/removeImage') }}/"+id;

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