@extends('layout.frontend.app')
@section('content')
    <!--slideshow end-->
<!-- Slider -->
<div id="featured-title" class="clearfix featured-title-left">
    <div id="featured-title-inner" class="container clearfix">
        <div class="featured-title-inner-wrap">
            <div class="featured-title-heading-wrap">
                <h1 class="featured-title-heading">{{ $countries->name }} Demand</h1>
            </div>
            <div id="breadcrumbs">
                <div class="breadcrumbs-inner">
                    <div class="breadcrumb-trail">
                        <a href="{{URL::to('/')}}" title="Construction" rel="home" class="trail-begin">Home</a>
                        <span class="sep">/</span>
                        <span class="trail-end">{{ $countries->name }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


        <div class="container">
                        
                        <h2>Latest Demand</h2>
                                    <div class="wprt-lines style-1 custom-3">
                                        <div class="line-1"></div>
                                        <div class="line-2"></div>
                                    </div>
                                    <div class="wprt-spacer" data-desktop="40" data-mobi="40" data-smobi="40"></div>
    
<table id="demands" class="table table-bordered table-striped" >
          <thead>
            <tr>
                 <th width="6%">S.N</th>
                
                 <th width="15%">Job Positon</th>
                 <th>Salary</th>
                 <th>Type</th>
                 <th width="8%">Req No.</th>
                 <th>Fooding</th>
                <th width="15%">Accommodation</th>
                <th>Date</th>
                <th>Action</th>
            </tr>
          </thead>
          <tbody>
             @if(count($demands)>0)
            {{--*/$i=1/*--}}
          @forelse($demands as $d)
                         <tr>
                            <td>{{$i++ }}</td>
                           
                            <td>{{ $d->job_position }}</td>
                            <td>{{ $d->salary }}</td>
                            <td>{{ $d->type }}</td>
                            <td>{{ $d->request_number }}</td>
                            <td>{{ $d->fooding }}</td>
                            <td>{{ $d->accomodation}}</td>
                            <td>{{ $d->published_date}}</td>
                            <td><a href="{{ route('applicants.add',$d->id) }}" target="_blank">Apply Online</a>
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
           {!! $demands->appends(Input::except('page'))->render() !!}
@else
    <p>There are no Demand yet!</p>
@endif

</tbody>

</table>
<script>
$(document).ready( function () {
    $('#demands').DataTable({
    "lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
    "bFilter" : false,               
     "bLengthChange": false

} );
} );
</script>

</div>

@endsection