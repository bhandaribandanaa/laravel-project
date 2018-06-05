@extends('layout.frontend.app')
@section('content')
<!-- Slider -->
<div id="featured-title" class="clearfix featured-title-left">
    <div id="featured-title-inner" class="container clearfix">
        <div class="featured-title-inner-wrap">
            <div class="featured-title-heading-wrap">
                <h1 class="featured-title-heading">Apply Online </h1>
            </div>
            <div id="breadcrumbs">
                <div class="breadcrumbs-inner">
                    <div class="breadcrumb-trail">
                        <a href="{{URL::to('/')}}" title="Construction" rel="home" class="trail-begin">Home</a>
                        <span class="sep">/</span>
                        <span class="trail-end">Apply Online</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
                                
                                         <div class="card-body card-padding">
                    <form action="{{ route('applicants.addSubmit') }}" method="post" class="row" role="form" id="profile" enctype="multipart/form-data">
                        <div class="col-sm-6">
                            <div class="form-group fg-line">
                                <label class="" for="exampleInputEmail2">Name</label>
                                <input type="text" class="form-control input-sm" name="name"
                                       id="exampleInputEmail2" value="{{ old('name') }}"
                                       placeholder="Enter Name">
                            </div>
                            @if($errors->has('name'))
                                <div class="alert alert-danger fade in">
                                    <button type="button" class="close close-sm" data-dismiss="alert">
                                        <i class="fa fa-times"></i>
                                    </button>
                                    <strong>Warning!</strong> {{ $errors->first('name') }}.
                                </div>
                            @endif
                        </div>



                           <div class="col-sm-6">
                            <div class="form-group fg-line">
                                <label class="" for="exampleInputEmail2">address</label>
                                <input type="text" class="form-control input-sm" name="address"
                                       id="exampleInputEmail2" value="{{ old('address') }}"
                                       placeholder="Enter Address
                                       ">
                            </div>
                            @if($errors->has('address'))
                                <div class="alert alert-danger fade in">
                                    <button type="button" class="close close-sm" data-dismiss="alert">
                                        <i class="fa fa-times"></i>
                                    </button>
                                    <strong>Warning!</strong> {{ $errors->first('address') }}.
                                </div>
                            @endif
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group fg-line">
                                <label class="" for="exampleInputEmail2">email</label>
                                <input type="text" class="form-control input-sm" name="email"
                                       id="exampleInputEmail2" value="{{ old('email') }}"
                                       placeholder="Enter Email">
                            </div>
                            @if($errors->has('email'))
                                <div class="alert alert-danger fade in">
                                    <button type="button" class="close close-sm" data-dismiss="alert">
                                        <i class="fa fa-times"></i>
                                    </button>
                                    <strong>Warning!</strong> {{ $errors->first('email') }}.
                                </div>
                            @endif
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group fg-line">
                                <label class="" for="exampleInputEmail2">Phone no.</label>
                                <input type="text" class="form-control input-sm" name="phone"
                                       id="exampleInputEmail2" value="{{ old('phone') }}"
                                       placeholder="Enter phone number">
                            </div>
                            @if($errors->has('phone'))
                                <div class="alert alert-danger fade in">
                                    <button type="button" class="close close-sm" data-dismiss="alert">
                                        <i class="fa fa-times"></i>
                                    </button>
                                    <strong>Warning!</strong> {{ $errors->first('phone') }}.
                                </div>
                            @endif
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group fg-line">
                                <label class="" for="exampleInputEmail2">Cv</label>
                                <input type="file" class="form-control input-sm" name="cv"
                                       id="exampleInputEmail2" value="{{ old('cv') }}"
                                      >
                            </div>
                            
                        </div>



                        <div class="col-sm-6">
                            <div class="form-group fg-line">
                                <label class="" for="exampleInputEmail2">job_id</label>
                                <input type="text" class="form-control input-sm" name="id"
                                       id="exampleInputEmail2" value="{{ old('id') }}"
                                       placeholder="id">
                            </div>
                           
                        </div>

                          <div class="col-sm-12">
                            <div class="form-group fg-line">
                                <label class="" for="">job_position</label>
                                <input type="text" id="job_position" name="job_position">
                                </textarea>
                            </div>
                            
                        </div>


                        {!! csrf_field() !!}
                        <div class="col-sm-4">
                            <button type="submit" class="btn btn-primary btn-sm m-t-5">Sumbit</button>
                        </div>
                    </form>
                </div>
                                       
                    
         
@endsection

        