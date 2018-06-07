

@extends('admin.layout.app')
@section('title', 'Applicants')
@section('main')

    <div class="container">
        <div class="block-header">
            <h2>Applicants</h2>
        </div>
        <div class="card">
            <div class="card-header">
                Applicants
            </div>


<table class="table table-bordered table-striped">
          <thead>
            <tr>
                 <th>S.N</th>
                 <th>Job Position</th>
                 <th>Job_position</th>
                 <th>name</th>
                 <th>address</th>
                 <th>phone</th>
                 <th>email</th>
                
                <th>Date</th>
                
            </tr>
          </thead>
          <tbody>
            {{--*/$i=1/*--}}
          @forelse($applicants as $d)
                         <tr>
                            <td>{{$i++ }}</td>
                            <td>{{ $d->demand->job_position ?? "" }}</td>
                            <td>{{$d->job_position}}
                            <td>{{ $d->name }}</td>
                            <td>{{ $d->address }}</td>
                            <td>{{ $d->phone }}</td>
                            <td>{{ $d->email }}</td>
                           
                            <td>{{ $d->published_date}}</td>
                           
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
                </table>
               <div align="center">
                   {!! $applicants->render() !!}
               </div>
         

