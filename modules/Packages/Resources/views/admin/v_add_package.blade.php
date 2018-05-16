    @extends('admin.layout.app')
@section('title', 'Add Package')
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
        <li><a href="{{ route('admin.packages.index') }}">Packages</a></li>
        <li class="active">Add new doctor</li>
    </ol>

    <div class="card">
        <div class="card-header">
            <h2>Add new package
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
            <form action="{{ route('admin.packages.addSubmit') }}" method="post" class="row" role="form"
                  enctype="multipart/form-data" id="contentForm">

                <div class="col-sm-12">
                    <div class="form-group fg-line">
                        <label class="" for="exampleInputEmail2">Title *</label>
                        <input type="text" class="form-control input-sm" name="title" id="" value="{{ old('title') }}"
                               placeholder="Enter Title">
                    </div>

                </div>
               

                <div class="col-sm-12">
                    <div class="form-group fg-line">
                        <label class="" for="">Description</label>
                        <textarea id="description" name="description" class="form-control" rows="3"
                                  placeholder="Meta description">{{ old('description') }}</textarea>
                    </div>
                </div>


                <div class="col-sm-12">
                    <div class="form-group fg-line">
                        <label class="" for="exampleInputEmail2">Price *</label>
                        <input type="text" class="form-control input-sm" name="price" id="" value="{{ old('price') }}"
                               placeholder="Enter Price">
                    </div>

                </div>

                <div class="col-sm-6">
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

                <div class="clearfix"></div>
                {!! csrf_field() !!}
                <div class="col-sm-4">
                    <button type="submit" class="btn btn-primary btn-sm m-t-5">Add Package</button>
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
    <script>
        $(function(){
            $("#description").summernote();
        });

        $(document).ready(function () {
            $('#contentForm')

                    .find('[name="display_in[]"]')
                    .selectpicker()
                    .change(function (e) {
                        // revalidate the color when it is changed
                        $('#contentForm').formValidation('revalidateField', 'display_in[]');
                    })
                    .end()


                    .formValidation({
                        framework: 'bootstrap',
                        excluded: [':disabled'],
                        icon: {
                            valid: 'glyphicon glyphicon-ok',
                            invalid: 'glyphicon glyphicon-remove',
                            validating: 'glyphicon glyphicon-refresh'
                        },
                        fields: {
                            title: {
                                validators: {
                                    notEmpty: {
                                        message: 'The title is required'
                                    }
                                }
                            }

                        }
                    })
                    .find('[name="content"]')
                    .summernote({
                        height: 400
                    })
                    .on('summernote.change', function (customEvent, contents, $editable) {
                        // Revalidate the content when its value is changed by Summernote
                        $('#contentForm').formValidation('revalidateField', 'content');
                    })

                    .on('err.form.fv', function (e) {
                    })
                    .end();

        });
    </script>
@stop