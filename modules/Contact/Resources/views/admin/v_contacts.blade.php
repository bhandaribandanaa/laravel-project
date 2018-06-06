

@extends('admin.layout.app')
@section('title', 'Message')
@section('main')

    <div class="container">
        <div class="block-header">
            <h2>Applicants</h2>
        </div>
        <div class="card">
            <div class="card-header">
               Message
            </div>



<table class="table table-bordered table-striped">
          <thead>
            <tr>
                 <th>S.N</th>
                 <th>name</th>
                 <th>email</th>
                 <th>phone</th>
                 <th>subject</th>
                <th>message</th>
                <th>Created_at</th>
                
            </tr>
          </thead>
          <tbody>
            {{--*/$i=1/*--}}
          @forelse($contacts as $d)
                         <tr>
                            <td>{{$i++ }}</td>
                            <td>{{ $d->name }}</td>
                            <td>{{ $d->email }}</td>
                            <td>{{ $d->phone }}</td>
                            <td>{{ $d->subject}}</td>
                            <td>{{ $d->message}}</td>
                            <td>{{ $d->created_at}}</td>
                           
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
         

