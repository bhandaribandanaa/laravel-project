 <section class="wprt-section offer">
                       <div class="container">
                           <div class="row">
                               <div class="col-md-12">
                                   <div class="wprt-spacer" data-desktop="70" data-mobi="60" data-smobi="60"></div>
                                   <h2>Latest Demand</h2>
                                   
                            <div class="wprt-lines style-1 custom-3">
                                <div class="line-1"></div>
                                <div class="line-2"></div>
                            </div>
                            <div class="wprt-spacer" data-desktop="40" data-mobi="40" data-smobi="40"></div>
                            <table class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th width="6%">S.N</th>
                                    <th width="25%">Job Positon</th>
                                    <th>Salary</th>
                                    <th>Type</th>
                                    <th width="9%">Req No.</th>
                                    <th>Fooding</th>
                                    <th>Accommodation</th>
                                    <th>Date</th>
                                </tr>
                                </thead>
                               
                    @forelse($demands as $d)
                      {{--*/$i=1/*--}}
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{ $d->job_position }}</td>
                            <td>{{ $d->salary }}</td>
                            <td>{{ $d->type }}</td>
                            <td>{{ $d->request_number }}</td>
                            <td>{{ $d->fooding }}</td>
                            <td>{{ $d->accomodation}}</td>
                            <td>{{ $d->date}}</td>

                            <td>{{ Carbon\Carbon::parse($d->created_at)->toFormattedDateString() }}</td>
                            <td>
                                <a href="{{ route('admin.demands.edit',[$d->id]) }}" title="Edit demands"
                                   data-toggle="tooltip"
                                   class="btn btn-success btn-icon waves-effect waves-circle waves-float waves-effect waves-circle waves-float"><i
                                            class="zmdi zmdi-edit zmdi-hc-fw"></i></a>

                                @if($d->status == 1)
                                    <a href="{{ route('admin.demands.changeStatus',[$d->id,'not_active']) }}"
                                       class="btn btn-primary btn-icon waves-effect waves-circle waves-float waves-effect waves-circle waves-float"
                                       data-toggle="tooltip" title="Change Status"><i
                                                class="zmdi zmdi-check-circle zmdi-hc-fw"></i></a>
                                @else
                                    <a href="{{ route('admin.demands.changeStatus',[$d->id,'active']) }}"
                                       class="btn btn-primary btn-icon waves-effect waves-circle waves-float waves-effect waves-circle waves-float"
                                        data-toggle="tooltip" title="Change Status"><i
                                                class="zmdi zmdi-lock zmdi-hc-fw"></i></a>
                                @endif

                                <a href="javascript:void(0)"
                                   class="delete btn btn-danger btn-icon waves-effect waves-circle waves-float waves-effect waves-circle waves-float"
                                   data-id="{{ $d->id }} data-toggle="tooltip" title="Delete demands" data-placement="top"><i
                                            class="zmdi zmdi-delete zmdi-hc-fw"></i></a>



                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                        </tr>
                    @endforelse
                    </tbody>
                     </table>

                            {{--Latest Demand End--}}