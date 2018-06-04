@extends('layout.frontend.app')
@section('content')


<form method="post" action="//submit.form" onSubmit="return validateForm();">
<div style="width: 400px;">
</div>
<div style="padding-bottom: 18px;font-size : 18px;">Contact Information</div>
<div style="display: flex; padding-bottom: 18px;width : 450px;">
<div style=" margin-left : 0; margin-right : 1%; width : 49%;">First name<span style="color: red;"> *</span><br/>
<input type="text" id="first_name" name="first_name" style="width: 100%;" class="form-control"/>
</div>
<div style=" margin-left : 1%; margin-right : 0; width : 49%;">Last name<span style="color: red;"> *</span><br/>
<input type="text" id="last_name" name="last_name" style="width: 100%;" class="form-control"/>
</div>
</div><div style="padding-bottom: 18px;">Email<span style="color: red;"> *</span><br/>
<input type="text" id="email" name="email" style="width : 450px;" class="form-control"/>
</div>
<div style="padding-bottom: 18px;">Phone<span style="color: red;"> *</span><br/>
<input type="text" id="phone" name="phone" style="width : 450px;" class="form-control"/>
</div>
<div style="padding-bottom: 18px;">Address<span style="color: red;"> *</span><br/>
<input type="text" id="address" name="address" style="width : 450px;" class="form-control"/>
</div>
<div style="padding-bottom: 18px;font-size : 18px;">Position</div>
<div style="padding-bottom: 18px;">Position<span style="color: red;"> *</span><br/>
<input type="text" id="position" name="position" style="width : 450px;" class="form-control"/>
</div>
<div style="padding-bottom: 18px;">Job-id<span style="color: red;"> *</span><br/>
<input type="text" id="job_id" name="job_id" style="width : 450px;" class="form-control"/>
</div>
<div style="padding-bottom: 18px;">Resume upload<br/>
<input id="resume" name="resume" style="width : 450px;" type="file" class="form-control"/>
</div>





<div style="padding-bottom: 18px;">Comments<br/>
<textarea id="comment" false name="comment" style="width : 450px;" rows="6" class="form-control"></textarea>
</div>
<div style="padding-bottom: 18px;"><input name="skip_Submit" value="Submit" type="submit"/></div>
<div>
<div style="float:right"><a href="prakritiadhikari2@gmail.com" id="lnk100" title="prakritiadhikari2@gmail.com">prakritiadhikari2@gmail.com</a></div>

</div>
</form>

<script type="text/javascript">
function validateForm() {
if (isEmpty(document.getElementById('first_name').value.trim())) {
alert('First name is required!');
return false;
}
if (isEmpty(document.getElementById('last_name').value.trim())) {
alert('Last name is required!');
return false;
}
if (isEmpty(document.getElementById('email').value.trim())) {
alert('Email is required!');
return false;
}
if (!validateEmail(document.getElementById('email').value.trim())) {
alert('Email must be a valid email address!');
return false;
}
if (isEmpty(document.getElementById('phone').value.trim())) {
alert('Phone is required!');
return false;
}
if (isEmpty(document.getElementById('address').value.trim())) {
alert('Address is required!');
return false;
}

function isEmpty(str) { return (str.length === 0 || !str.trim()); }
function validateEmail(email) {
var re = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,15}(?:\.[a-z]{2})?)$/i;
return isEmpty(email) || re.test(email);
}
</script>
@endsection