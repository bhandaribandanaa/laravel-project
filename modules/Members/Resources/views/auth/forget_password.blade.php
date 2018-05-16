@extends('layout.frontend.app')
@section('title', 'Forget Password')
@section('header_js')
@stop
@section('main')
    <div class="container">
        <div class="row">
            <div class="col l9 col m12 col s12">
                <div class="blockquote z-depth-1">
                    <div class="breadcrumb"><a href="{{ route('home') }}">Home</a> <i class="fa fa-angle-right"></i>
                       Forget Password
                    </div>
                    <div class="title">Forget Password</div>
                    <div class="row">


                        <div class="col m3 s12">&nbsp;</div>

                        <div class="col m6 s12">

                            @if (count($errors) > 0)
                                <div class="alert alert-error">
                                    <ul style="margin-top: 0px;">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <?php $pass_error = Session::get('pass_error'); ?>

                            @if($pass_error)
                                <div class="alert alert-error" style="padding-bottom: 30px;">
                                    {{ $pass_error }}
                                </div>
                            @endif

                            <?php $success = Session::get('success'); ?>
                            @if($success)
                                <div class="alert alert-success reg_success">
                                    {!! $success !!}
                                </div>
                            @endif

                            {!! Form::open(array('method' => 'post','class'=>'')) !!}

                            <div class="input-field">
                                <i class="mdi-action-perm-identity prefix"></i>
                                {!! Form::email('email', '', array('class'=>'validate', 'placeholder' => 'Email','required'=>'required' )) !!}
                                <label for="email">Email</label>
                            </div>

                            <div class="forgot-password right">
                                <a href="{{ route('member.login') }}">Back to Login</a>
                            </div>

                            <br>
                            <button style="margin-left:3rem"
                                    class="btn btn-flat waves-effect waves-light shopping-cart-button "
                                    type="submit" name="action">Submit
                            </button>
                            {!! csrf_field() !!}

                            {!! Form::close() !!}
                        </div>

                        <div class="col m3 s12">&nbsp;</div>


                    </div>
                    <!--row end-->
                </div>
            </div>
            <div class="col l3 col m12 col s12">
                <!-- Sidebar -->
                <div class="sidbar_wrap">

                    <div class="sidbar-box z-depth-1">
                        @include('frontend.facebook')
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop