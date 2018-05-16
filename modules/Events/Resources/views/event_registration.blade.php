@extends('layout.frontend.app')
@section('title', $event->name)
@section('header_js')
@stop
@section('header_css')
@stop
@section('main')
    <div class="container">
        <div class="row">
            <div class="col l9 col m12 col s12">
                <div class="blockquote z-depth-1">
                    <div class="breadcrumb"><a href="{{ route('home') }}">Home</a> <i class="fa fa-angle-right"></i> <a
                                href="#">Events</a> <i class="fa fa-angle-right"></i> <a
                                href="{{ route('event.detail', array($event->id,$event->slug)) }}">{{ $event->name }}</a>
                        <i class="fa fa-angle-right"></i> Registration
                    </div>
                    <div class="title">Registration</div>
                    <div class="row">

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

                        <form name="registration" id="registration" method="post"
                              action="{{ route('event.registration',array($event->id,$event->slug)) }}">
                            <div class="col m4 s12">
                                <div class="input-field">
                                    <select name="salutation">
                                        
                                        <!-- <option value="Mr">Mr</option>
                                        <option value="Mrs">Mrs</option>
                                        <option value="Miss">Miss</option> -->
                                        <option value="Dr">Dr</option>
                                        <option value="Prof">Prof.</option>
                                    </select>

                                </div>
                            </div>

                            <div class="clearfix"></div>

                            <div class="col m4 s12">
                                <div class="input-field">
                                    <input id="fname" type="text" name="first_name"
                                           value="{{ Input::old('first_name') }}" class="validate" required>
                                    <label for="fname">First Name*</label>
                                </div>
                            </div>
                            <div class="col m4 s12">
                                <div class="input-field">
                                    <input id="mname" type="text" name="middle_name"
                                           value="{{ Input::old('middle_name') }}">
                                    <label for="mname">Middle Name</label>
                                </div>
                            </div>
                            <div class="col m4 s12">
                                <div class="input-field">
                                    <input id="lname" type="text" name="last_name" class="validate"
                                           value="{{ Input::old('last_name') }}" required>
                                    <label for="lname">Last Name*</label>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="col m4 s12">
                                <div class="input-field">
                                    <input id="address" type="text" name="address" class="validate"
                                           value="{{ Input::old('address') }}" required>
                                    <label for="address">Address*</label>
                                </div>
                            </div>
                            <div class="col m4 s12">
                                <div class="input-field">
                                    <input id="mobile" type="number" class="validate" name="mobile_no"
                                           value="{{ Input::old('mobile_no') }}" required>
                                    <label for="mobile">Mobile No.*</label>
                                </div>
                            </div>
                            <div class="col m4 s12">
                                <div class="input-field">
                                    <input id="email" type="email" name="email" class="validate"
                                           value="{{ Input::old('email') }}" required>
                                    <label for="email">Email*</label>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="col m4 s12">
                                <div class="input-field">
                                    <input id="organization" type="text" name="organization"
                                           value="{{ Input::old('organization') }}" class="validate" required>
                                    <label for="organization">Organization*</label>
                                </div>
                            </div>
                            <div class="col m4 s12">
                                <div class="input-field">
                                    <input id="designation" type="text" name="designation" class="validate"
                                           value="{{ Input::old('designation') }}" required>
                                    <label for="designation">Designation*</label>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <br>

                            <div class="col m12">
                                <table class="sortable bordered reg_tbl" border="0" id="data">
                                    <tbody>
                                    <tr>
                                        <td></td>
                                        <td><strong>Conference Registrations
                                                <!-- (11th
                                                & 12th
                                                March 2016) --></strong></td>
                                        <td><strong>Early Bird<br/> (Feb 14 - Apr 25)</strong></td>
                                        <td><strong>Normal & On-site<br/> (From April 26)</strong></td>
                                    </tr>
                                    <tr>
                                        <td><input name="member_type" type="radio" value="1" id="mem" checked/>
                                            <label for="mem"></label></td>
                                        <td>SIMON members and Residents*</td>
                                        <td>NPR. 5000</td>
                                        <td>NPR. 8000</td>
                                    </tr>
                                    <tr>
                                        <td><input name="member_type" type="radio" value="2" id="nonmen"/>
                                            <label for="nonmen"></label></td>
                                        <td>SIMON Non Members*</td>
                                        <td>NPR. 7000</td>
                                        <td>NPR. 9000</td>
                                    </tr>
                                    <tr>
                                        <td><input name="member_type" type="radio" value="19" id="saarc_countries"/>
                                            <label for="saarc_countries"></label></td>
                                        <td>SAARC Countries</td>
                                        <td>USD 100</td>
                                        <td>USD 120</td>
                                    </tr>
                                    <tr>
                                        <td><input name="member_type" type="radio" value="20" id="non_saarc_countries"/>
                                            <label for="non_saarc_countries"></label></td>
                                        <td>Non SAARC Countries</td>
                                        <td>USD 150</td>
                                        <td>USD 175</td>
                                    </tr>
                                    <!-- <tr>
                                        <td colspan="2">Do you have accompanying person?</td>
                                        <td colspan="2">

                                        
                                     
<div>
   <input type="radio" name="has_accompanying_person" value="0" id="no1" " checked="checked"> <label for="no1">No</label>
   <input type="radio" name="has_accompanying_person" value="1" id="yes1"><label for="yes1"> Yes</label>
</div>
    
                          
                                        
                                    </td>
                                    </tr>

                                    <tr>
                                        
                                        <td colspan="4" class="box" id="krish">
                                        <span id="question" class="redd box"><span>Accompanying Name : </span><input type="text" name="accompanying_name" class="form-control input-sm" id="accompanying_name" required></span>
                                        </td>


                                    </tr>
                                    <tr>

                                        

                                        <td colspan="2">Are you also registrating for workshop?</td>
                                        
                                        
                                                
                                        <td colspan="2">
                                        <input type="radio" name="has_workshop_registration" value="0" id="no2" checked="checked"> <label for="no2" >No</label>
                                        <input type="radio" name="has_workshop_registration" value="1" id="yes2"> <label for="yes2">Yes</label></td>
                                        <div class="yes box2" id="question2" class="form-control">
                                         <p> <table class="yes box2">
                                            <tr>
                                        <td><input name="workshop_type" type="radio" value="1" id="workshop1"/>
                                            <label for="workshop1"></label></td>
                                        <td >Emergency Neurological Life Support</td>
                                        <td >NPR. 5000</td>
                                        <td></td>
                                        <td></td>

                                    </tr>
                                            <tr>
                                        <td><input name="workshop_type" type="radio" value="2" id="workshop2"/>
                                            <label for="workshop2"></label></td>
                                        <td colspan="1">Royal College of Physicians of Edinburg Acute Medicine</td>
                                        <td colspan="1">NPR. 4000</td>
                                    </tr>
                                          </table></p>
                                        
                                         </div>
                                        
                                        

                                        
                                        
                                        
                                    </tr> -->
                                    

                                    </tbody>
                                </table><br/>
<div>
<p>Do you have accompanying person? </p>
    <div>
   <input type="radio" name="has_accompanying_person" value="0" id="no1" " checked="checked"> <label for="no1">No</label>
   <input type="radio" name="has_accompanying_person" value="1" id="yes1"><label for="yes1"> Yes</label>
</div>
<p colspan="4" class="box" id="krish">
    <span id="question" class="redd box"><span>Accompanying Name : </span><input type="text" name="accompanying_name" class="form-control input-sm" id="accompanying_name" ></span>
    </p>
    </div><br/>

    
       <p> Are you also registrating for workshop?</p>
    <div>
    <input type="radio" name="has_workshop_registration" value="0" id="no2" checked="checked"> <label for="no2" >No</label>
    <input type="radio" name="has_workshop_registration" value="1" id="yes2"> <label for="yes2">Yes</label>
    </div>
    <div class="yes box2" id="question2" class="form-control">
                                         <p> <table class="yes box2" id="null">
                                            <tr>
                                        <td><input name="workshop_type" type="radio" value="1" id="workshop1"/>
                                            <label for="workshop1"></label></td>
                                        <td >Emergency Neurological Life Support</td>
                                        <td >NPR. 5000</td>
                                        <td></td>
                                        <td></td>

                                    </tr>
                                            <tr>
                                        <td><input name="workshop_type" type="radio" value="2" id="workshop2"/>
                                            <label for="workshop2"></label></td>
                                        <td colspan="1">Royal College of Physicians of Edinburg Acute Medicine</td>
                                        <td>NPR. 4000</td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                          </table></p>
                                        
                                         </div>
</div>


                                <div style="font-size:14px; margin:10px 0; color:#ff1744">Note:<br/>
                                *Accompanying Person: NPR. 3000<br/>      
                                 Registration Fee doesn't include accommodation<br/><br/>
                                 Bonafide Certificate required for Resident Doctors 
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="clearfix"></div>
                            <br>
                            {!! csrf_field() !!}
                            {{--<input type="submit"  value="Register Now">--}}
                            <button type="submit" class="btn btn-flat waves-effect waves-light shopping-cart-button"
                                    name="action">Register Now
                            </button>
                        </form>
                    </div>
                    <!--row end-->
                
            </div>
            <div class="col l3 col m12 col s12">
                <!-- Sidebar -->
                <div class="sidbar_wrap">
                    <div class="sidbar-box z-depth-1">

                        <ul>
                            <?php
                            $curDate = strtotime(date("Y-m-j"));
                            $eventDate = strtotime($event->start_date);
                            ?>

                            {{--@if($curDate < $eventDate)--}}
                                {{--<li>--}}
                                    {{--<a href="{{ route('event.registration',array($event->id,$event->slug)) }}">Registration--}}
                                        {{--Here </a>--}}
                                {{--</li>--}}
                            {{--@endif--}}
                            @if(count($event->contents)>0)
                                @foreach($event->contents as $content)
                                    <li>
                                        <a href="{{ route('event.detail.content',array($event->id,$event->slug,$content->slug)) }}">{{ $content->title }}</a>
                                    </li>
                                @endforeach
                            @endif
                        </ul>

                    </div>
                    <div class="sidbar-box z-depth-1">
                        @include('frontend.facebook')
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

@stop

<style type="text/css">
.redd, .yes{ display:none;}
.sortable tr {
    cursor: pointer;
}
</style>
<script type="text/javascript" src="http://code.jquery.com/jquery.min.js"></script>

<script>
$(document).ready(function(){
   


    $("#no1").click(function(){
        $(".box").hide('animate');
                $("#accompanying_name").prop("required", false);
                document.getElementById('accompanying_name').value = '';

    });
    $("#yes1").click(function(){
        $(".box").show('animate');
        $("#accompanying_name").prop("required", true);

    });
    
    $("#no2").click(function(){
    $(this).find('input[type=radio]').prop('checked', false);
    document.getElementById('workshop1').checked = false;
    document.getElementById('workshop2').checked = false;
    $(".box2").hide('animate');


    });
    $("#yes2").click(function(){
        $(".box2").show('animate');
    });
});
</script>


<style>
   #krish {display: none;} 

</style>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

<script>

$(function() {
    $('tr, input:radio').click(function(event) { 
        $(this).find('input[type=radio]').prop('checked', true);
    var selected = $(this).hasClass("highlight");
    $("#data tr").removeClass("highlight");
    if(!selected)
            $(this).addClass("highlight");

    });
}); 

</script>

<style type="text/css">
    .highlight { background-color: #dbd4d4; }
</style>