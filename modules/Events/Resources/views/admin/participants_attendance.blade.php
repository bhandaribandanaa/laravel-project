@extends('admin.layout.app')
@section('title', $event->name.'&#39;s Participant Attendance')
@section('header_css')
@endsection
@section('main')
    <div class="container">
        <div class="block-header">
            <h2>{{ $event->name.'&#39;s Participants Attendance' }}</h2>
        </div>

        <div class="card">

            <div class="table-responsive">

                {!! $attendance !!}

            </div>
        </div>
    </div>
@endsection