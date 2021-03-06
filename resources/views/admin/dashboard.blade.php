@extends('admin.layout.app')

@section('title', 'Dashboard')

@section('main')

    <style>
        .count{
            font-size: 100px;
            text-align: center;
        }
		.bottombtn{   display: block;
    text-align: center;
    padding: 7px 10px 0px 10px;
    border-top: 1px solid #F0F0F0;
    line-height: 100%;
    font-size: 12px;
    margin-top: 20px;
    color: #828282;
    margin: 5px -15px 0 -15px;}
    </style>

    <div class="container">
        <div class="block-header">
            <h2>Dashboard</h2>

            <ul class="actions">
                <li>
                    <a href="">
                        <i class="zmdi zmdi-trending-up"></i>
                    </a>
                </li>
                <li>
                    <a href="">
                        <i class="zmdi zmdi-check-all"></i>
                    </a>
                </li>
                <li class="dropdown">
                    <a href="" data-toggle="dropdown">
                        <i class="zmdi zmdi-more-vert"></i>
                    </a>

                    <ul class="dropdown-menu dropdown-menu-right">
                        <li>
                            <a href="">Refresh</a>
                        </li>
                        <li>
                            <a href="">Manage Widgets</a>
                        </li>
                        <li>
                            <a href="">Widgets Settings</a>
                        </li>
                    </ul>
                </li>
            </ul>

        </div>



        <div class="col-sm-3">
            <div class="card card2">
                <div class="card-header bgm-red">
                    <h2>Applicants</h2>
                </div>

                <div class="card-body card-padding count">

                    {{ $count }}

                   
                    <div>
                        <a href="{{ route('admin.applicants.index') }}" class="bottombtn">View Details</a>
                    </div>
                    <div class="clearfix"></div>
                </div>

            </div>
        </div>

        

        <div class="col-sm-3">
            <div class="card card2">
                <div class="card-header bgm-green">
                    <h2>Contact Message</h2>
                </div>

                <div class="card-body card-padding count">

                    {{ $counts }}
                  
                    <div>
                        <a href="{{ route('admin.contacts.index') }}" class="bottombtn">View Details</a>
                    </div>
                </div>
            </div>
        </div>

       
    </div>
@stop