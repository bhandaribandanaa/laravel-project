@extends('admin.layout.container')

@section('bodypart')

    <ol class="breadcrumb" style="margin-bottom: 5px;">
        <li><a href="{{ URL::route('admin.dashboard') }}">Home</a></li>
        <li class="active">Error</li>
    </ol>
    
    <div class="container">
        <div class="block-header">
            <h2>Error! <small>Access Denied </small></h2>
        </div>
        
        <div class="card">
            <div class="card-body card-padding">
                <p class="lead">An error has occurred while processing your request. This may occured because there was an attemt to manipulate this software. Users are prohibited from taking unauthorized actions to intentionally modify the system.</p>
            </div>
        </div>
                
    </div>

@stop