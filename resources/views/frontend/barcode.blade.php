@extends('layout.frontend.app')
@section('title', 'Barcode Home')
@section('main')
    <div class="container">
        <div class="row">
            <div class="title">Barcode</div>
            <div class="col l4 col m12 col s12">
                <div class="col l12 l12">
                    <div class="card blue-grey darken-1">
                        <div class="card-content white-text">
                            <span class="card-title">Attendance </span>
                            <p>Participant's Attendance </p>
                        </div>
                        <div class="card-action">
                            <a href="{{ route('barcode.attendance') }}" target="_blank">Click Here</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col l4 col m12 col s12">
                <div class="col l12 l12">
                    <div class="card blue-grey darken-1">
                        <div class="card-content white-text">
                            <span class="card-title">Lunch </span>
                            <p>Participant's Lunch </p>
                        </div>
                        <div class="card-action">
                            <a href="{{ route('barcode.lunch') }}" target="_blank">Click Here</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col l4 col m12 col s12">
                <div class="col l12 l12">
                    <div class="card blue-grey darken-1">
                        <div class="card-content white-text">
                            <span class="card-title">Dinner </span>
                            <p>Participant's Dinner </p>
                        </div>
                        <div class="card-action">
                            <a href="{{ route('barcode.dinner') }}" target="_blank">Click Here</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col l4 col m12 col s12">
                <div class="col l12 l12">
                    <div class="card blue-grey darken-1">
                        <div class="card-content white-text">
                            <span class="card-title">Barcode Test </span>
                            <p>Barcode Test </p>
                        </div>
                        <div class="card-action">
                            <a href="{{ route('barcode.check') }}" target="_blank">Click Here</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop