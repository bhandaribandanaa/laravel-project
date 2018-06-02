@extends('admin.layout.app')
@section('title', 'Add CompanyDocument')
@section('header_css')
    {!! Html::style('backend/plugins/kartik-v-bootstrap-fileinput/css/fileinput.min.css') !!}
@stop
@section('main')
    <div class="container">
    <ol class="breadcrumb" style="margin-bottom: 5px;">
        <li><a href="{{ route('admin.dashboard') }}">Home</a></li>
        <li><a href="{{ route('admin.companydocument.index') }}">Company Document</a></li>
        <li class="active">Add Image</li>
    </ol>

    <div class="card">
        <div class="card-header">
            <h2>Add Image on {{ $album->name }}
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
            <form action="{{ route('admin.companydocument.photo.add',$album->id) }}" method="post" class="row" role="form"
                  enctype="multipart/form-data" id="contentForm">
                <div class="col-sm-12">
                    <div class="form-group">
                        <label>Images</label>
                        <input id="file-3" type="file" name="images[]" multiple=true>
                    </div>
                </div>
                <div class="clearfix"></div>
                {!! csrf_field() !!}
                <div class="col-sm-4">
                    <button type="submit" class="btn btn-primary btn-sm m-t-5">Add Images</button>
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
    </script>

@stop