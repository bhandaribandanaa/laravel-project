@extends('admin.layout.app')
@section('title', 'Add Manual Booking')
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
            <li><a href="{{ route('admin.appointments.index') }}">Packages</a></li>
            <li class="active">Add Manual Booking</li>
        </ol>

        <div class="card">
            <div class="card-header">
                <h2>Enter Patient Info
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
                <form action="{{ route('admin.appointments.manualBookingSubmit') }}" method="post" class="row" role="form"
                      enctype="multipart/form-data" id="contentForm">

                    <div class="col-sm-12">
                        <div class="form-group fg-line">
                            <label class="" for="exampleInputEmail2">Full Name *</label>
                            <input type="text" class="form-control input-sm" name="full_name" id="" value="{{ old('full_name') }}"
                                   placeholder="Enter Full Name" required>
                        </div>

                    </div>
                    <div class="col-sm-12">
                        <div class="form-group fg-line">
                            <label class="" for="">Package*</label>
                            <select name="package_id" id="package" class="selectpicker" data-live-search="true" required>
                                <option value="">Choose a package</option>
                                @foreach($packages as $pack)
                                    <option value="{{ $pack->id }}"> {{ $pack->title }} </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div id="doctors"></div>

                    <div class="col-sm-12">
                        <div class="form-group fg-line">
                            <label class="" for="exampleInputEmail2">Address</label>
                            <input type="text" class="form-control input-sm" name="address" id="" value="{{ old('address') }}"
                                   placeholder="Enter Address">
                        </div>

                    </div>

                    <div class="col-sm-12">
                        <div class="form-group fg-line">
                            <label class="" for="exampleInputEmail2">Mobile</label>
                            <input type="text" class="form-control input-sm" name="mobile" id="" value="{{ old('mobile') }}"
                                   placeholder="Enter Contact">
                        </div>

                    </div>

                    <div class="col-sm-12">
                        <div class="form-group fg-line">
                            <label class="" for="exampleInputEmail2">Email</label>
                            <input type="text" class="form-control input-sm" name="email" id="" value="{{ old('email') }}"
                                   placeholder="Enter Email">
                        </div>

                    </div>

                    <div class="col-sm-12">
                        <div class="form-group fg-line">
                            <label class="" for="exampleInputEmail2">Message</label>
                            <p><textarea name="message" placeholder="Message" rows="5" cols="100"></textarea></p>
                        </div>

                    </div>

                    <div class="col-sm-6">
                        <div class="form-group fg-line">
                            <label class="" for="">Booking as</label>
                            <br/>
                            <br/>
                            <label class="radio radio-inline m-r-20">
                                <input type="radio" name="status" value="successful">
                                <i class="input-helper"></i>
                                Successful
                            </label>
                            <label class="radio radio-inline m-r-20">
                                <input type="radio" name="status" value="confirm" checked="checked">
                                <i class="input-helper"></i>
                                Confirm
                            </label>
                            <label class="radio radio-inline m-r-20">
                                <input type="radio" name="status" value="pending">
                                <i class="input-helper"></i>
                                Pending
                            </label>
                        </div>
                    </div>

                    <div class="clearfix"></div>
                    {!! csrf_field() !!}
                    <div class="col-sm-4">
                        <button type="submit" class="btn btn-primary btn-sm m-t-5">Add Booking</button>
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
            $("#package").selectpicker("val","");
            $("#description").summernote();

            $("#package").change(function(){
                var package = $(this).val();
                var url = "{{ url('admin/appointments/getDoctors') }}/"+package;
                $.ajax({
                    type: "GET",
                    url: url,
                    datatype: "json",
                    success: function(data){

                        var obj = jQuery.parseJSON(data);

                            if(obj.status == "success") {
                                var append = "<div class='col-sm-12'>" +
                                    "<div class='form-group fg-line'>" +
                                    "<label class='' for=''>Doctors *</label>" +
                                    "<select name='doctor_id' id='' required>" +
                                    "<option value=''>Choose a doctor</option>";

                                $.each(obj.value, function(key, value){
                                    append += "<option value='"+ value.id +"'>"+ value.full_name +"</option>";
                                });

                                append += "</select></div></div>";
                            }else{
                                var append = "<div class='col-sm-12'>No Doctors available.</div>";
                            }

                        $("#doctors").html(append);


                    }
                });

            });
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
                        heading: {
                            validators: {
                                notEmpty: {
                                    message: 'The heading is required'
                                }
                            }
                        },
                        "display_in[]": {
                            validators: {
                                notEmpty: {
                                    message: 'The display in is required'
                                }
                            }
                        },
                        full_name: {
                            validators: {
                                notEmpty: {
                                    message: 'Patient name is required.'
                                }
                            }
                        },

                        package_id: {
                            validators: {
                                notEmpty: {
                                    message: 'Please select a package.'
                                }
                            }
                        },
                        content: {
                            validators: {
                                callback: {
                                    message: 'The content is required and cannot be empty',
                                    callback: function (value, validator, $field) {
                                        var code = $('[name="content"]').code();
                                        // <p><br></p> is code generated by Summernote for empty content
                                        return (code !== '' && code !== '<p><br></p>');
                                    }
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