@extends('admin.layout.app')
@section('title', 'Assign Doctors')
@section('header_css')
    {!! Html::style('backend/css/dataTables.material.min.css') !!}
    {!! Html::style('backend/css/material.min.css') !!}
@stop
@section('main')
    <div class="loading_modal" style="display: none">
        <div class="loading">
            <!-- <img alt="" src="{{ asset('backend/img/loading.gif') }}"/> -->
        </div>
    </div>
    {{--admin.member.add--}}
    <div class="container">
        <div class="block-header">
            <h2>Assign Doctors</h2>
        </div>

        <div class="card">
            
            <?php $success = Session::get('success'); ?>
            @if($success)
                <div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                aria-hidden="true">×</span></button>
                    {{ $success }}
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-striped datatable">
                    <thead>
                    <tr>
                        <th>S N</th>
                        <th>Full Name</th>
                        <!--<th>Specialization</th>-->
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(count($doctors)>0)
                        @foreach($doctors as $index=>$doctor)
                            <tr>
                                <td>{{ ++$index }}</td>
                                <td>{{ $doctor->full_name }}</td>
                                <!--<td>{{ $doctor->professional_title }}</td>-->
                                <td>
                                        @if($doctor->is_assigned == 'yes')
                                            <a id="{{ $doctor->id }}" href="javascript:void(0)"
                                               class="assign_doctors btn btn-success btn-icon waves-effect waves-circle waves-float waves-effect waves-circle waves-float"
                                               data-id="{{ $doctor->id }}" data-option="remove" data-package="{{ $package_id }}" data-toggle="tooltip" title="Remove Doctor"><i class="zmdi zmdi-check-circle zmdi-hc-fw"></i></a>
                                        @else
                                            <a id="{{ $doctor->id }}" href="javascript:void(0)"
                                               class="assign_doctors btn btn-primary btn-icon waves-effect waves-circle waves-float waves-effect waves-circle waves-float"
                                              data-id="{{ $doctor->id }}" data-option="add" data-package="{{ $package_id }}" data-toggle="tooltip" title="Assign Doctor"><i class="zmdi zmdi-lock zmdi-hc-fw"></i></a>
                                        @endif
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="7"><h5 style="text-align: center;">No Doctors found.</h5></td>
                        </tr>
                    @endif
                    </tbody>
                </table>
                
            </div>
        </div>
    </div>
@stop
@section('footer_js')
 {!! Html::script('backend/js/jquery.dataTables.min.js') !!}
    {!! Html::script('backend/js/dataTables.material.min.js') !!}
    <script type="text/javascript" language="javascript" class="init">
        $(document).ready(function () {
            $('.datatable').dataTable();
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function () {

            $('.datatable').on('click', '.assign_doctors', function (event) {
                event.preventDefault();
                var package_id = $(this).data("package");
                var doctor_id = $(this).data("id");
                var option = $(this).data("option");

                var url = "{{ url('admin/packages/assign_doctors') }}/"+package_id+"/"+doctor_id+"/"+option;


                $.ajax({
                    type: "GET",
                    url: url,
                    datatype: "json",
                    success: function(data){
                        var obj = jQuery.parseJSON(data);
                        if(obj.status == "success"){
                            swal("Success!", obj.value, "success")
                            if(option == 'add'){
                                $("#"+doctor_id).html('<i class="zmdi zmdi-check-circle zmdi-hc-fw"></i>');
                                $("#"+doctor_id).removeClass("btn-primary");
                                $("#"+doctor_id).addClass("btn-success");
                                $("#"+doctor_id).data("option","remove");
                            }else{
                                $("#"+doctor_id).html('<i class="zmdi zmdi-lock zmdi-hc-fw"></i>');
                                $("#"+doctor_id).removeClass("btn-success");
                                $("#"+doctor_id).addClass("btn-primary");
                                $("#"+doctor_id).data("option","add");
                            }
                        }
                    },
                    error: function (e) {
                        swal("Error !", 'Something went wrong', "error");
                    }
                });

            });
    

        });
    </script>
@stop