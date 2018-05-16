@extends('layout.frontend.app')
@section('title', 'Edit Profile')
@section('header_js')
@stop
@section('main')

    <div class="container">
        <div class="row">

            <div class="col s12">


                <div class="blockquote z-depth-1">
                    @if (count($errors) > 0)
                        <div class="alert alert-error">
                            <ul style="margin-top: 0px;">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <?php $error = Session::get('error'); ?>

                    @if($error)
                        <div class="alert alert-error" style="padding-bottom: 30px;">
                            {{ $error }}
                        </div>
                    @endif

                    <?php $success = Session::get('success'); ?>
                    @if($success)
                        <div class="alert alert-success reg_success">
                            {!! $success !!}
                        </div>
                    @endif
                    {!! Form::open(array('method' => 'post','class'=>'','files' => true)) !!}
                    <div class="sub_title">Personal Information</div>

                    <div class="row mem_info">
                        <div class="col l4  m4  s12"> First Name</div>
                        <div class="col l8  m8  s12">
                            <div class="input-field">
                                <input id="" type="text" name="first_name" value="{{ $userInfo->first_name }}"
                                       class="validate" required>
                                <label for="">First Name</label>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="col l4  m4  s12"> Last Name</div>
                        <div class="col l8  m8  s12">
                            <div class="input-field">
                                <input id="" type="text" name="last_name" value="{{ $userInfo->last_name }}"
                                       class="validate" required>
                                <label for="">Last Name</label>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="col l4  m4  s12"> Address</div>
                        <div class="col l8  m8  s12">
                            <div class="input-field">
                                <input id="" type="text" class="validate" name="address"
                                       value="{{ $userInfo->address }}" required>
                                <label for=""> Address</label>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="col l4  m4  s12"> Email</div>
                        <div class="col l8  m8  s12">
                            <div class="input-field">
                                <input id="" type="text" class="validate" readonly value="{{ $userInfo->email }}">
                                <label for="">Email</label>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="col l4  m4  s12"> Phone</div>
                        <div class="col l8  m8  s12">
                            <div class="input-field">
                                <input id="" type="text" class="validate" name="phone_no"
                                       value="{{ $userInfo->phone_no }}" >
                                <label for="">Phone</label>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="col l4  m4  s12"> Mobile</div>
                        <div class="col l8  m8  s12">
                            <div class="input-field">
                                <input id="" type="text" class="validate" name="mobile_no"
                                       value="{{ $userInfo->mobile_no }}" >
                                <label for="">Mobile</label>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="col l4  m4  s12"> Membership No.</div>
                        <div class="col l8  m8  s12">
                            <div class="input-field">
                                <input id="" type="text" class="validate" name="membership_no"
                                       value="{{ $userInfo->membership_no }}" required>
                                <label for="">Membership No.</label>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="col l4  m4  s12"> NMC No.</div>
                        <div class="col l8  m8  s12">
                            <div class="input-field">
                                <input id="" type="text" class="validate" name="nmc_no" value="{{ $userInfo->nmc_no }}"
                                       required>
                                <label for=""> NMC No.</label>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="col l4  m4  s12">About</div>
                        <div class="col l8  m8  s12">
                            <div class="input-field">

                                <textarea id="" name="about"
                                          class="materialize-textarea">{{ $userInfo->about }}</textarea>
                                <label for="">About</label>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="col l4  m4  s12">Profile Picture</div>
                        <div class="col l8  m8  s12">
                            @if($userInfo->member_photo && file_exists('uploads/member/'. $userInfo->member_photo))
                                <img class="responsive-img circle"
                                     src="{{URL::asset('uploads/member/'. $userInfo->member_photo) }}"
                                     style="max-height: 150px; height: 150px; width: 150px; max-width: 150px;">
                            @endif
                            <div class="file-field input-field">
                                <div class="btn">
                                    <span>Profile Picture</span>
                                    <input type="file" name="member_photo">
                                </div>
                                <div class="file-path-wrapper" style="padding-left: 100px;">
                                    <input class="file-path validate" type="text" name="image_name">
                                </div>
                            </div>
                        </div>
                    </div> <!--row end-->

                </div> <!--blockquote end-->
                <div class="blockquote z-depth-1">
                    <div class="sub_title">Other Information</div>

                    <div class="row mem_info">
                        <div class="col l4  m4  s12"> Organization</div>
                        <div class="col l8  m8  s12">
                            <div class="input-field">
                                <input id="" type="text" name="organization" value="{{ $userInfo->organization }}"
                                       class="validate" required>
                                <label for="">Organization</label>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="col l4  m4  s12"> Designation</div>
                        <div class="col l8  m8  s12">
                            <div class="input-field">
                                <input id="" type="text" name="designation" value="{{ $userInfo->designation }}"
                                       class="validate" required>
                                <label for="">Designation</label>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="col l4  m4  s12">Special Interest</div>
                        <div class="col l8  m8  s12">
                            <div class="input-field">
                                <input id="" type="text" name="interests" value="{{ $userInfo->interests }}"
                                       class="validate" >
                                <label for="">Special Interest</label>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="col l4  m4  s12">Facebook</div>
                        <div class="col l8  m8  s12">
                            <div class="input-field">
                                <input id="" type="text" name="facebook_url" value="{{ $userInfo->facebook_url }}"
                                       class="validate">
                                <label for="">Facebook URL</label>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="col l4  m4  s12">Linkedin</div>
                        <div class="col l8  m8  s12">
                            <div class="input-field">
                                <input id="" type="text" name="linkedin_url" class="validate"
                                       value="{{ $userInfo->linkedin_url }}">
                                <label for="">Linkedin URL</label>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="col l4  m4  s12">Twitter</div>
                        <div class="col l8  m8  s12">
                            <div class="input-field">
                                <input id="" type="text" name="twitter_url" value="{{ $userInfo->twitter_url }}"
                                       class="validate" >
                                <label for="">Twitter URL</label>
                            </div>
                        </div>
                        <div class="clearfix"></div>


                    </div> <!--row end-->
                    <br>
                    <button class="btn btn-flat waves-effect waves-light shopping-cart-button " type="submit"
                            name="action">Save
                    </button>
                    {{--<button class="btn btn-flat waves-effect waves-light shopping-cart-button " type="submit"--}}
                    {{--name="action">Cancel--}}
                    {{--</button>--}}

                </div> <!--blockquote end-->
                {!! csrf_field() !!}

                {!! Form::close() !!}
            </div>
            <!-- col 8 end-->
        </div>
    </div>

@stop