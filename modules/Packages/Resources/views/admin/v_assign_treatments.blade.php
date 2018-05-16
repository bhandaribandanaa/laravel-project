@extends('admin.layout.app')
@section('title', 'Assign Treatment')
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
            <li class="active">Assign treatment</li>
        </ol>

        <div class="card">
            <div class="card-header">
                <h2>Assign treatment
                    <small></small>
                </h2>
            </div>

            <div class="card-body card-padding">
                <div class="table-responsive">

                        <div class="table-responsive">

                            <table class="table table-striped">
                                <tr>
                                    <th>S N </th>
                                    <th>Treatment</th>
                                    @forelse($packages as $pack)
                                        <th><span>{{ $pack->title }}</span></th>
                                    @empty
                                        No packages found.
                                    @endforelse
                                </tr>
                                <tbody>
                                <tr>

                                {{--*/$j=1/*--}}
                                {{--*/$k=1/*--}}
                                @forelse($treatments as $treat)
                                    @if($j > 1)
                                        <tr>
                                            @endif
                                            <td>{{ $j++ }}</td>
                                            <td>{{ $treat->title }}</td>
                                            @for($i=0; $i<count($packages); $i++)


                                                {{--*/$response = Helpers::getTreatmentTick($treat->id, $packages[$i]['id'])/*--}}

                                                @if($response == 'yes')
                                                    <td>
                                                        <label style="margin-right: 20px;">
                                                            <input class="setRecord" type="checkbox" value="{{ $treat->id.'_'. $packages[$i]['id'] }}" checked>
                                                        </label>

                                                    </td>
                                                @else
                                                    <td>
                                                        <label style="margin-right: 20px;">
                                                            <input class="setRecord" type="checkbox" value="{{ $treat->id.'_'. $packages[$i]['id'] }}">
                                                        </label>

                                                    </td>
                                                @endif
                                            @endfor

                                        </tr>

                                        {{--*/$k++/*--}}

                                        @empty
                                            <td> No treatments found</td>
                                        @endforelse

                                </tbody>
                            </table>
                        </div>




                </div>
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
           $(".setRecord").click(function(){
               var val = $(this).val();
               var url = "{{ url('admin/packages/setTreatment') }}/"+val;
               $.ajax({
                  type: "GET",
                   url: url,
                   datatype: "json",
                   success: function(data){
                      console.log(data);

                   },
                   error: function(e){
                       swal("Error", "Something went wrong.", "error");
                   }
               });
           });
        });
    </script>

@stop