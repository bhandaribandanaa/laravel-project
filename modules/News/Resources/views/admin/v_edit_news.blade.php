@extends('admin.layout.app')
@section('title', 'Add Doctor')
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
                <h2>Add News
                    <small></small>
                </h2>
            </div>
            <div class="card-body card-padding">
                <form action="{{ route('admin.news.editSubmit') }}" method="post" class="row" role="form" id="profile" enctype="multipart/form-data">
                    <div class="col-sm-6">
                        <div class="form-group fg-line">
                            <label class="" for="exampleInputEmail2">Title</label>
                            <input type="text" class="form-control input-sm" name="title"
                                   id="exampleInputEmail2" value="{{ $news->title }}"
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
                            <label class="" for="exampleInputEmail2">Category</label>
                            <select name="category">
                                <option value=""> Select a category </option>
                                @foreach ($category as $cat)
                                    <option value="{{ $cat->id }}" @if($cat->id == $news->category_id) selected @endif> {{ $cat->category }} </option>
                                @endforeach
                            </select>
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



                    <div class="clearfix"></div>
                    <div class="col-sm-12">
                        <div class="form-group fg-line">
                            <label class="" for="">News Image</label>
                            <br/>
                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                <div class="fileinput-preview thumbnail" data-trigger="fileinput">
                                    <img id="newsImage" src="{{ asset('uploads/news/'.$news->image) }}">
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

                    <div class="col-sm-12">
                        <div class="form-group fg-line">
                            @if($news->image)
                                <a id="removeImage" href="javascript:void(0)" class="btn btn-danger" data-id ="{{ $news->id }}">Remove Original Image</a>
                            @endif
                        </div>
                    </div>



                    <div class="clearfix"></div>
                   
                     <div class="col-sm-12">
                        <div class="form-group fg-line">
                            <label class="" for="">Description*</label>
                            <textarea class="form-control description" name="description" style="height: 600px;">{!! $news->description !!}</textarea>
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

                    <div class="col-sm-12">
                        <div class="form-group fg-line">
                            <label class="" for="">Published Date*</label>
                            <input type="text" id="published_date" name="published_date" value="{{ $news->published_date }}">
                        </div>
                        @if($errors->has('published_date'))
                            <div class="alert alert-danger fade in">
                                <button type="button" class="close close-sm" data-dismiss="alert">
                                    <i class="fa fa-times"></i>
                                </button>
                                <strong>Warning!</strong> {{ $errors->first('published_date') }}.
                            </div>
                        @endif
                    </div>



                     <div class="form-group fg-line">
                        <label class="" for="">Publish</label>
                        <br/>
                        <br/>
                        <label class="radio radio-inline m-r-20">
                            <input type="radio" name="status" value="active"
                                   @if($news->status=='active')checked="checked" @endif>
                            <i class="input-helper"></i>
                            Yes
                        </label>
                        <label class="radio radio-inline m-r-20">
                            <input type="radio" name="status" value="not_active"
                                   @if($news->status=='not_active')checked="checked" @endif>
                            <i class="input-helper"></i>
                            No
                        </label>
                    </div>
                    <input type="hidden" name="id" value="{{ $news->id }}">
                    {!! csrf_field() !!}
                    <div class="col-sm-4">
                        <button type="submit" class="btn btn-primary btn-sm m-t-5">Edit News</button>
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
            var date = {!! $news->published_date !!};
            $("#published_date").datepicker({
                format: 'yyyy-mm-dd',
            });

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