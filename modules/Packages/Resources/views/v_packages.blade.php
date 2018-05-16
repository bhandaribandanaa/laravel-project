@extends('layout.frontend.app')
@section('title', 'Select Package')

@section('main')

    <!--Page header & Title-->
    <section id="page_header" class="page_header_small">
        <div class="page_title">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h2 class="title">Choose Package</h2>
                        <div class="page_link"><a href="#">Home</a><i class="fa fa-long-arrow-right"></i><span>Packages</span></div>
                    </div>
                </div>
            </div>
        </div>
    </section>



    <section class="padding">
        <div class="container">
            <div class="row">
              <div class="table-responsive respadding">



                    <table class="table table-bordered customtable">
                        <thead>
                            <tr>
                                <th>SN.</th>
                                <th>Treatment</th>
                                @forelse($packages as $pack)
                                    <th><span>{{ $pack->title }}</span></th>
                                @empty
                                    No packages found.
                                @endforelse
                            </tr>
                        </thead>

                        <tbody>
                            <tr>

                                {{--*/$j=1/*--}}

                                @forelse($treatments as $treat)
                                    @if($j > 1)
                                        <tr>
                                    @endif
                                    <td>{{ $j++ }}</td>
                                    <td>{{ $treat->title }}</td>
                                    @for($i=0; $i<count($packages); $i++)


                                        {{--*/$response = Helpers::getTreatmentTick($treat->id, $packages[$i]['id'])/*--}}

                                        @if($response == 'yes')
                                            <td style="text-align: center;">
                                                <label style="margin-right: 20px;color:green; font-size: 18px;">
                                                    <i class="fa fa-check"></i>
                                                </label>

                                            </td>
                                        @else
                                            <td style="text-align: center;">
                                                <label style="margin-right: 20px;">
                                                    -
                                                </label>

                                            </td>
                                        @endif
                                    @endfor

                                </tr>


                            @empty
                                <td> No treatments found</td>
                            @endforelse

                            <tr>
                                <td></td>
                                <td>Price in NRs **</td>
                                @for($p=0;$p<count($packages);$p++)
                                    <td style="text-align: center">Rs. {{ $packages[$p]['price'] }}</td>
                                @endfor
                            </tr>

                            <tr>
                                <td></td>
                                <td></td>
                                @for($p=0;$p<count($packages);$p++)
                                    <td style="text-align: center"><a href="{{ route('packages.view',[$packages[$p]['slug']]) }}" class="btn btn-primary">Book Now</a></td>
                                @endfor
                            </tr>


                        </tbody>
                    </table>
                    @for($p=0;$p<count($packages);$p++)
                        <p>
                            <br>
                                <span style="font-weight: bold;">{{ $packages[$p]['title'] }} : </span>
                                <span>{!! $packages[$p]['description'] !!}</span>
                        </p>
                    @endfor


              </div>
            </div>
        </div>
    </section>



@stop