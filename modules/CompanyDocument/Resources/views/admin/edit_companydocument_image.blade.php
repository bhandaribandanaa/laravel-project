@extends('admin.layout.app')
@section('title', 'Add Company Document')
@section('header_css')
    {!! Html::style('backend/plugins/kartik-v-bootstrap-fileinput/css/fileinput.min.css') !!}
@stop
@section('main')
    <div class="container">
    <ol class="breadcrumb" style="margin-bottom: 5px;">
        <li><a href="{{ route('admin.dashboard') }}">Home</a></li>
        <li><a href="{{ route('admin.companydocument.index') }}">Company Document</a></li>
        <li class="active">Edit Company Document Image</li>
    </ol>

    <div class="card">
        <div class="card-header">
            <h2>Album : {{ $album->name }}
                <small></small>
            </h2>
        </div>

        <div class="card-body card-padding">
            <?php $success = Session::get('success'); ?>
            @if($success)
                <div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                    {{ $success }}
                </div>
            @endif

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
            <div class="col-sm-12">

                @if(count($album->images) >0)
                    @foreach($album->images as $image)
                <div class="file-preview-frame" id="image_{{ $image->id }}" data-fileindex="1">
                    <img src="{{ asset('uploads/companydocument/'.$image->image ) }}"
                         class="file-preview-image" style="width:auto;height:160px;">

                    <div class="file-thumbnail-footer">
                        <button type="button" id="{{ $image->id }}"
                                class="kv-file-remove btn btn-xs btn-default delete_image"
                                title="Remove file"><i
                                    class="glyphicon glyphicon-trash text-danger"></i>
                        </button>

                    </div>
                </div>
                    @endforeach
                @endif
            </div>
            <form action="{{ route('admin.companydocument.photo.add',$album->id) }}" method="post" class="row" role="form"
                  enctype="multipart/form-data" id="contentForm">
                <div class="col-sm-12">
                    <div style="padding:20px 0 10px 0;">Note <span style="color: red">*</span> : Image size must be : 800 x 600px<br></div>
                    <div class="form-group">
                        <label>Add More Images</label>
                        <input id="file-3" type="file" name="images[]" multiple=true>
                        
                        
                        
                    </div>
                </div>
                <div class="clearfix"></div>
                {!! csrf_field() !!}
                <div class="col-sm-4">
                    <button type="submit" class="btn btn-primary btn-sm m-t-5">Update Images</button>
                </div>
            </form>
        </div>
    </div>
</div>
@stop
@section('footer_js')
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    {!! Html::script('backend/plugins/kartik-v-bootstrap-fileinput/js/plugins/canvas-to-blob.min.js') !!}
    {!! Html::script('backend/plugins/kartik-v-bootstrap-fileinput/js/fileinput.min.js') !!}
    <script>
        $('#file-fr').fileinput({
            language: 'fr',
            uploadUrl: '#',
            allowedFileExtensions: ['jpg', 'png', 'gif'],
        });
        $('#file-es').fileinput({
            language: 'es',
            uploadUrl: '#',
            allowedFileExtensions: ['jpg', 'png', 'gif'],
        });
        $("#file-0").fileinput({
            'allowedFileExtensions': ['jpg', 'png', 'gif'],
        });
        $("#file-1").fileinput({
//            uploadUrl: '#', // you must set a valid URL here else you will get an error
            allowedFileExtensions: ['jpg', 'png', 'gif'],
            overwriteInitial: false,
            maxFileSize: 1000,
            maxFilesNum: 10,
            //allowedFileTypes: ['image', 'video', 'flash'],
            slugCallback: function (filename) {
                return filename.replace('(', '_').replace(']', '_');
            }
        });
        /*
         $(".file").on('fileselect', function(event, n, l) {
         alert('File Selected. Name: ' + l + ', Num: ' + n);
         });
         */
        $("#file-3").fileinput({
            showUpload: false,
            showCaption: false,
            showRemove: true,
            browseClass: "btn btn-primary btn-lg",
            fileType: "any",
            allowedFileExtensions: ['jpg', 'png', 'gif'],
            previewFileIcon: "<i class='glyphicon glyphicon-king'></i>",
            maxFileSize: 1000,
            maxFilesNum: 10,
        });
        $("#file-4").fileinput({
            uploadExtraData: {kvId: '10'}
        });
        $(".btn-warning").on('click', function () {
            if ($('#file-4').attr('disabled')) {
                $('#file-4').fileinput('enable');
            } else {
                $('#file-4').fileinput('disable');
            }
        });
        $(".btn-info").on('click', function () {
            $('#file-4').fileinput('refresh', {previewClass: 'bg-info'});
        });
        /*
         $('#file-4').on('fileselectnone', function() {
         alert('Huh! You selected no files.');
         });
         $('#file-4').on('filebrowse', function() {
         alert('File browse clicked for #file-4');
         });
         */
        $(document).ready(function () {
            $("#test-upload").fileinput({
                'showPreview': false,
                'allowedFileExtensions': ['jpg', 'png', 'gif'],
                'elErrorContainer': '#errorBlock'
            });
            /*
             $("#test-upload").on('fileloaded', function(event, file, previewId, index) {
             alert('i = ' + index + ', id = ' + previewId + ', file = ' + file.name);
             });
             */
        });



        $(document).ready(function () {

            $('.delete_image').click(function (event) {
                event.preventDefault();
                $object = this;
                swal({
                    title: "Are you sure?",
                    text: "You will do you want to delete this Image ?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Yes, delete it!",
                    closeOnConfirm: false
                }, function () {
                    debugger;
                    $.ajax({
                        type: 'POST',
                        url: '{{ route('admin.companydocument.photo.delete') }}',
                        data: {id: $object.id, _token: '{!! csrf_token() !!}'},
                        success: function (response) {
                            debugger;
                            if (response.status == true) {
                                swal("Deleted!", response.message, "success");
                                document.getElementById('image_' + $object.id).parentElement.removeChild(document.getElementById('image_' + $object.id));
                            }
                            else {
                                swal("Error !", response.message, "error");
                            }

                        },
                        error: function (e) {
                            swal("Error !", response.message, "error");
                        },
                    });
                });
            });
        });


    </script>

@stop