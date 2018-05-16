<?php namespace Modules\Appointments\Http\Controllers\Admin;

use App\PackagesDoctors;
use Illuminate\Support\Facades\App;
use Pingpong\Modules\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use Input;
use Session;
use App\CustomLibrary\General;
use Carbon\Carbon;
use DB;
use Redirect;

use App\Appointments;
use App\Doctors;
use App\Packages;
use App\PackageBookings;
use App\Timetable;



class AdminAppointmentsController extends Controller {

    public function index()
    {
        $data['doctor_selected'] = (Input::get('doctor') != '')? Input::get('doctor'): '';
        $data['date_selected'] = (Input::get('date') != '')? Input::get('date'): '';
        $data['conf_app'] = Appointments::where('is_confirmed',1)->where('is_success',0);

            if($data['doctor_selected'] != "")
                $data['conf_app']->where('doctor_id',$data['doctor_selected']);
            if($data['date_selected'] != "")
                $data['conf_app']->where('date',$data['date_selected']);

            $data['conf_app'] = $data['conf_app']->orderBy('id','desc')->paginate(10);
        foreach($data['conf_app'] as $con){
            $con->doctor = Doctors::where('id',$con->doctor_id)->pluck('full_name');
        }
        return view('appointments::admin.v_appointments_new',$data);
    }

    public function pending()
    {
        $data['doctor_selected'] = (Input::get('doctor') != '')? Input::get('doctor'): '';
        $data['date_selected'] = (Input::get('date') != '')? Input::get('date'): '';
        $data['unconf_app'] = Appointments::where('is_confirmed',0)->where('is_success',0);

        if($data['doctor_selected'] != "")
            $data['unconf_app']->where('doctor_id',$data['doctor_selected']);
        if($data['date_selected'] != "")
            $data['unconf_app']->where('date',$data['date_selected']);

        $data['unconf_app'] = $data['unconf_app']->orderBy('id','desc')->paginate(10);

        foreach($data['unconf_app'] as $con){
            $con->doctor = Doctors::where('id',$con->doctor_id)->pluck('full_name');
        }
        return view('appointments::admin.v_pending_appointments_new',$data);
    }

    public function successful(){
        $data['doctor_selected'] = (Input::get('doctor') != '')? Input::get('doctor'): '';
        $data['date_selected'] = (Input::get('date') != '')? Input::get('date'): '';
        $data['conf_app'] = Appointments::where('is_confirmed',0)->where('is_success',1);

        if($data['doctor_selected'] != "")
            $data['conf_app']->where('doctor_id',$data['doctor_selected']);
        if($data['date_selected'] != "")
            $data['conf_app']->where('date',$data['date_selected']);

        $data['conf_app'] = $data['conf_app']->orderBy('id','desc')->paginate(10);
        foreach($data['conf_app'] as $con){
            $con->doctor = Doctors::where('id',$con->doctor_id)->pluck('full_name');
        }
        return view('appointments::admin.v_appointments_success_new',$data);
    }

    public function successfulPackages(){
        $data['doctor_selected'] = (Input::get('doctor') != '')? Input::get('doctor'): '';
        $data['date_selected'] = (Input::get('date') != '')? Input::get('date'): '';
        $data['conf_app'] = PackageBookings::where('is_confirmed',0)->where('is_success',1);

        if($data['doctor_selected'] != "")
            $data['conf_app']->where('doctor_id',$data['doctor_selected']);
        if($data['date_selected'] != "")
            $data['conf_app']->where('date',$data['date_selected']);

        $data['conf_app'] = $data['conf_app']->orderBy('id','desc')->paginate(10);
        foreach($data['conf_app'] as $con){
            $con->doctor = Doctors::where('id',$con->doctor_id)->pluck('full_name');
            $con->package = Packages::where('id',$con->package_id)->pluck('title');
        }
        return view('appointments::admin.v_bookings_success_new',$data);
    }

        public function changeStatus()
    {
        $rules = ['id' => 'required'];
        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'message' => $validator->errors()->all()]);
        }

        try {
            $objectContent = Appointments::findOrFail(Input::get('id'));
            if ($objectContent->is_confirmed == 1) {
                $objectContent->is_confirmed = 0;
                $objectContent->is_success = 0;
                $message = 'Appointment shifted to pending mode.';
            } else {
                $objectContent->is_confirmed = 1;
                $objectContent->is_success = 0;
                $message = 'Appointment shifted to confirm mode.';
            }
            $objectContent->save();

            return response()->json(['status' => true, 'message' => $message, 'is_confirmed' => $objectContent->is_confirmed]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['status' => false, 'message' => Input::get('id')]);
        }
    }

    public function changeSuccess()
    {
        $rules = ['id' => 'required'];
        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'message' => $validator->errors()->all()]);
        }

        try {
            $objectContent = Appointments::findOrFail(Input::get('id'));
            if ($objectContent->is_success == 1) {
                $objectContent->is_success = 1;
                $objectContent->is_confirmed = 0;
                $message = 'Appointment shifted to success mode.';
            } else {
                $objectContent->is_success = 1;
                $objectContent->is_confirmed = 0;
                $message = 'Appointment shifted to success mode.';
            }
            $objectContent->save();

            return response()->json(['status' => true, 'message' => $message, 'is_success' => $objectContent->is_success]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['status' => false, 'message' => Input::get('id')]);
        }
    }

    public function changeSuccessPackage()
    {
        $rules = ['id' => 'required'];
        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'message' => $validator->errors()->all()]);
        }

        try {
            $objectContent = PackageBookings::findOrFail(Input::get('id'));
            if ($objectContent->is_success == 1) {
                $objectContent->is_success = 1;
                $objectContent->is_confirmed = 0;
                $message = 'Booking shifted to success mode.';
            } else {
                $objectContent->is_success = 1;
                $objectContent->is_confirmed = 0;
                $message = 'Booking shifted to success mode.';
            }
            $objectContent->save();

            return response()->json(['status' => true, 'message' => $message, 'is_success' => $objectContent->is_success]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['status' => false, 'message' => Input::get('id')]);
        }
    }

    public function changeConfirm()
    {
        $rules = ['id' => 'required'];
        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'message' => $validator->errors()->all()]);
        }

        try {
            $objectContent = Appointments::findOrFail(Input::get('id'));
            if ($objectContent->is_success == 1) {
                $objectContent->is_success = 0;
                $objectContent->is_confirmed = 1;
                $message = 'Appointment shifted to confirm mode.';
            } else {
                $objectContent->is_success = 0;
                $message = 'Appointment shifted to success mode.';
            }
            $objectContent->save();

            return response()->json(['status' => true, 'message' => $message, 'is_confirmed' => $objectContent->is_confirmed]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['status' => false, 'message' => Input::get('id')]);
        }
    }

    public function changeConfirmPackage()
    {
        $rules = ['id' => 'required'];
        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'message' => $validator->errors()->all()]);
        }

        try {
            $objectContent = PackageBookings::findOrFail(Input::get('id'));
            if ($objectContent->is_success == 1) {
                $objectContent->is_success = 0;
                $objectContent->is_confirmed = 1;
                $message = 'Booking shifted to confirm mode.';
            } else {
                $objectContent->is_success = 0;
                $message = 'Booking shifted to success mode.';
            }
            $objectContent->save();

            return response()->json(['status' => true, 'message' => $message, 'is_confirmed' => $objectContent->is_confirmed]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['status' => false, 'message' => Input::get('id')]);
        }
    }

    public function packages()
    {
        $data['doctor_selected'] = (Input::get('doctor') != '')? Input::get('doctor'): '';
        $data['date_selected'] = (Input::get('date') != '')? Input::get('date'): '';
        $data['conf_app'] = PackageBookings::where('is_confirmed',1);

            if($data['doctor_selected'] != "")
                $data['conf_app']->where('doctor_id',$data['doctor_selected']);
            if($data['date_selected'] != "")
                $data['conf_app']->where('date',$data['date_selected']);

            $data['conf_app'] = $data['conf_app']->orderBy('id','desc')->paginate(10);
        foreach($data['conf_app'] as $con){
            $con->doctor = Doctors::where('id',$con->doctor_id)->pluck('full_name');
            $con->package = Packages::where('id',$con->package_id)->pluck('title');
        }
        return view('appointments::admin.v_packages_bookings_new',$data);
    }

    public function pendingPackages()
    {
        $data['doctor_selected'] = (Input::get('doctor') != '')? Input::get('doctor'): '';
        $data['date_selected'] = (Input::get('date') != '')? Input::get('date'): '';
        $data['unconf_app'] = PackageBookings::where('is_confirmed',0);

        if($data['doctor_selected'] != "")
            $data['unconf_app']->where('doctor_id',$data['doctor_selected']);
        if($data['date_selected'] != "")
            $data['unconf_app']->where('date',$data['date_selected']);

        $data['unconf_app']=$data['unconf_app']->orderBy('id','desc')->paginate(10);
        foreach($data['unconf_app'] as $con){
            $con->doctor = Doctors::where('id',$con->doctor_id)->pluck('full_name');
            $con->package = Packages::where('id',$con->package_id)->pluck('title');
        }

        return view('appointments::admin.v_pending_bookings_new',$data);
    }

    public function changeStatusPackage()
    {
        $rules = ['id' => 'required'];
        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'message' => $validator->errors()->all()]);
        }

        try {
            $objectContent = PackageBookings::findOrFail(Input::get('id'));
            if ($objectContent->is_confirmed == 1) {
                $objectContent->is_confirmed = 0;
                $message = 'Booking shifted to pending mode.';
            } else {
                $objectContent->is_confirmed = 1;
                $message = 'Booking shifted to confirm mode.';
            }
            $objectContent->save();

            return response()->json(['status' => true, 'message' => $message, 'is_confirmed' => $objectContent->is_confirmed]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['status' => false, 'message' => Input::get('id')]);
        }
    }

    public function manualAppointment(){
        $data['doctors'] = Doctors::where('status',1)->get();
        return view('appointments::admin.v_manual_appointment',$data);
    }


    public function changeSchedule($app_id, $doc_id){
        $data['app_id'] = $app_id;
        $data['doctor'] = Doctors::where('id', $doc_id)->first();
        $data['schedule'] = Timetable::where('doctor_id',$data['doctor']->id)->select('start_date as start','end_date as end','days')->get()->toArray();
        $today = date('Y-m-d');
        if(count($data['schedule'])>0) {
            $unavailable = explode(' - ', $data['doctor']->unavailability_time);


            for ($i = 0; $i < count($data['schedule']); $i++) {
                $sched[] = self::dateRange($data['schedule'][$i]['start'], $data['schedule'][$i]['end']);
                $days[] = $data['schedule'][$i]['days'];
            }

            $count=0;
            for ($f = 0; $f < count($sched); $f++){
                $days[$f] = explode(',',$days[$f]);

                for($k = 0; $k < count($sched[$f]); $k++) {
                    $date = date("Y-m-d", strtotime($sched[$f][$k]));

                    $times = strtotime($date);
                    $day = self::return_full_day(date('D', $times));

                    if ($date < $today){
                        if($unavailable[0]!=0){
                            if(self::check_in_range($unavailable[0], $unavailable[1], $date)){
                                $final_date[$count]['date'] = $date;
                                $final_date[$count]['badge'] = false;
                            }
                        }
                        $final_date[$count]['date'] = $date;
                        $final_date[$count]['badge'] = false;

                    }else{
                        if(in_array($day,$days[$f])){
                            if($unavailable[0]!=0){
                                if(self::check_in_range($unavailable[0], $unavailable[1], $date)){

                                }else{
                                    $final_date[$count]['date'] = $date;
                                    $final_date[$count]['badge'] = true;
                                    $count++;
                                }
                            }else{
                                $final_date[$count]['date'] = $date;
                                $final_date[$count]['badge'] = true;
                                $count++;
                            }
                        }
                    }

                }

            }


            $data['result'] = json_encode($final_date);

            return view('appointments::admin.v_change_appointment_calender', $data);
        }else{
            Session::flash('no_schedule','Dr. '.$data['doctor']->full_name.'\'s schedule has not been updated in the system. Please contact clinic for information.');
            return Redirect::back();
        }
    }

    public function changeSchedulePackage($app_id, $doc_id){
        $data['app_id'] = $app_id;
        $data['doctor'] = Doctors::where('id', $doc_id)->first();
        $data['schedule'] = Timetable::where('doctor_id',$data['doctor']->id)->select('start_date as start','end_date as end','days')->get()->toArray();
        $today = date('Y-m-d');
        if(count($data['schedule'])>0) {
            $unavailable = explode(' - ', $data['doctor']->unavailability_time);


            for ($i = 0; $i < count($data['schedule']); $i++) {
                $sched[] = self::dateRange($data['schedule'][$i]['start'], $data['schedule'][$i]['end']);
                $days[] = $data['schedule'][$i]['days'];
            }

            $count=0;
            for ($f = 0; $f < count($sched); $f++){
                $days[$f] = explode(',',$days[$f]);

                for($k = 0; $k < count($sched[$f]); $k++) {
                    $date = date("Y-m-d", strtotime($sched[$f][$k]));

                    $times = strtotime($date);
                    $day = self::return_full_day(date('D', $times));

                    if ($date < $today){
                        if($unavailable[0]!=0){
                            if(self::check_in_range($unavailable[0], $unavailable[1], $date)){
                                $final_date[$count]['date'] = $date;
                                $final_date[$count]['badge'] = false;
                            }
                        }
                        $final_date[$count]['date'] = $date;
                        $final_date[$count]['badge'] = false;

                    }else{
                        if(in_array($day,$days[$f])){
                            if($unavailable[0]!=0){
                                if(self::check_in_range($unavailable[0], $unavailable[1], $date)){

                                }else{
                                    $final_date[$count]['date'] = $date;
                                    $final_date[$count]['badge'] = true;
                                    $count++;
                                }
                            }else{
                                $final_date[$count]['date'] = $date;
                                $final_date[$count]['badge'] = true;
                                $count++;
                            }
                        }
                    }

                }

            }


            $data['result'] = json_encode($final_date);

            return view('appointments::admin.v_change_booking_calender', $data);
        }else{
            Session::flash('no_schedule','Dr. '.$data['doctor']->full_name.'\'s schedule has not been updated in the system. Please contact clinic for information.');
            return Redirect::back();
        }
    }

    public function getSchedule($slug, $date){

        $times = strtotime($date);
        $day = self::return_full_day(date('D', $times));
        $data['doctor'] = Doctors::where('slug',$slug)->select('id','full_name','unavailability_time','specialization_id')->first();
        $sch = Timetable::where('doctor_id',$data['doctor']->id)->get();

        foreach($sch as $s){
            if(self::check_in_range($s->start_date, $s->end_date, $date)){
                if(in_array($day, explode(',',$s->days)))
                    $data['shift'][] = $s->shift;
            }
        }

        print_r(json_encode(['status'=> 'success', 'value' => implode(',',$data['shift'])]));



    }

    public function updateSubmit(Request $request){
        $this->validate($request, ['date' => 'required',
                                    'shift' => 'required']);

        $old = Appointments::find(Input::get('app_id'));
        $old->date = Input::get('date');
        $old->shift = Input::get('shift');
        $old->save();
        Session::flash('update_success', 'Schedule has been updated.');
        return redirect('admin/appointments/pending');
    }

    public function updatePackageSubmit(Request $request){
        $this->validate($request, ['date' => 'required',
            'shift' => 'required']);

        $old = PackageBookings::find(Input::get('app_id'));
        $old->date = Input::get('date');
        $old->shift = Input::get('shift');
        $old->save();
        Session::flash('update_success', 'Schedule has been updated.');
        return redirect('admin/appointments/packages/pending');
    }

    function return_full_day($day){
        if($day=='Sun')
            return 'Sunday';
        if($day=='Mon')
            return 'Monday';
        if($day=='Tue')
            return 'Tuesday';
        if($day=='Wed')
            return 'Wednesday';
        if($day=='Thu')
            return 'Thursday';
        if($day=='Fri')
            return 'Friday';
        if($day=='Sat')
            return 'Saturday';
    }

    function dateRange( $first, $last, $step = '+1 day', $format = 'Y/m/d' ) {

        $dates = array();
        $current = strtotime( $first );
        $last = strtotime( $last );

        while( $current <= $last ) {

            $dates[] = date( $format, $current );
            $current = strtotime( $step, $current );
        }

        return $dates;
    }

    public function array_flatten($array) {
        if (!is_array($array)) {
            return FALSE;
        }
        $result = array();
        foreach ($array as $key => $value) {
            if (is_array($value)) {
                $result = array_merge($result, array_flatten($value));
            }
            else {
                $result[$key] = $value;
            }
        }
        return $result;
    }

    public function check_in_range($start_date, $end_date, $date_from_user)
    {
        // Convert to timestamp
        $start_ts = strtotime($start_date);
        $end_ts = strtotime($end_date);
        $user_ts = strtotime($date_from_user);

        // Check that user date is between start & end
        return (($user_ts >= $start_ts) && ($user_ts <= $end_ts));
    }

    public function manualAppointmentSubmit(Request $request){
        $this->validate($request, ['full_name' => 'required']);
        $data['patient_info'] = json_encode(Input::all());

        $data['doctor'] = Doctors::where('id', Input::get('doctor_id'))->first();
        $data['schedule'] = Timetable::where('doctor_id',$data['doctor']->id)->select('start_date as start','end_date as end','days')->get()->toArray();
        $today = date('Y-m-d');
        if(count($data['schedule'])>0) {
            $unavailable = explode(' - ', $data['doctor']->unavailability_time);


            for ($i = 0; $i < count($data['schedule']); $i++) {
                $sched[] = self::dateRange($data['schedule'][$i]['start'], $data['schedule'][$i]['end']);
                $days[] = $data['schedule'][$i]['days'];
            }

            $count=0;
            for ($f = 0; $f < count($sched); $f++){
                $days[$f] = explode(',',$days[$f]);

                for($k = 0; $k < count($sched[$f]); $k++) {
                    $date = date("Y-m-d", strtotime($sched[$f][$k]));

                    $times = strtotime($date);
                    $day = self::return_full_day(date('D', $times));

                    if ($date < $today){
                        if($unavailable[0]!=0){
                            if(self::check_in_range($unavailable[0], $unavailable[1], $date)){
                                $final_date[$count]['date'] = $date;
                                $final_date[$count]['badge'] = false;
                            }
                        }
                        $final_date[$count]['date'] = $date;
                        $final_date[$count]['badge'] = false;

                    }else{
                        if(in_array($day,$days[$f])){
                            if($unavailable[0]!=0){
                                if(self::check_in_range($unavailable[0], $unavailable[1], $date)){

                                }else{
                                    $final_date[$count]['date'] = $date;
                                    $final_date[$count]['badge'] = true;
                                    $count++;
                                }
                            }else{
                                $final_date[$count]['date'] = $date;
                                $final_date[$count]['badge'] = true;
                                $count++;
                            }
                        }
                    }

                }

            }


            $data['result'] = json_encode($final_date);

            return view('appointments::admin.v_select_manual_date', $data);
        }else{
            Session::flash('no_schedule','Dr. '.$data['doctor']->full_name.'\'s schedule has not been updated in the system. Please contact clinic for information.');
            return Redirect::back();
        }


    }

    public function manualAppointmentFinal(Request $request){
        ini_set('memory_limit', '512M');
        ini_set('max_execution_time', 3000);

        $this->validate($request, ['shift' => 'required',
                                    'date' => 'required']);

        $patient = json_decode(Input::get('patient_info'));
        $doctor = Doctors::where('id', $patient->doctor_id)->pluck('full_name');

        $app = new Appointments;
        $app->doctor_id = $patient->doctor_id;
        $app->date = Input::get('date');
        $app->shift = Input::get('shift');
        $app->f_name = $patient->full_name;
        $app->address = $patient->address;
        $app->mobile = $patient->mobile;
        $app->email = $patient->email;
        $app->message = $patient->message;

        if($patient->status == 'pending'){
            $app->is_confirmed = 0;
            $app->is_success = 0;
        }elseif($patient->status == 'confirm'){
            $app->is_confirmed = 1;
            $app->is_success = 0;
        }else{
            $app->is_confirmed = 0;
            $app->is_success = 1;
        }

        $app->save();
        if($patient->email != "") {
            $content = '<!DOCTYPE html>
                          <html lang="en">
                          <head>
                          <meta charset="utf-8">
                          <meta name="viewport" content="width=device-width, initial-scale=1.0">
                          <meta name="description" content="">
                          <meta name="author" content="">
                          <link href="" type="images/png" rel="icon" />
                          <title>Nirvana Welness Clinic </title>
    
                          </head>
                          <body >
                          <table border="0" style="width:650px; background:#f2f2f2; color:#333; margin:auto; font-family:Arial, Helvetica, sans-serif; font-size:13px; line-height:1.6">
                          <tr><td style=" text-align:center;  padding-top:15px ;"><a target="_blank"><img src="' . asset('images/logo.png') . '" style="width:300px;"></a></td></tr>
    
    
                            <tr>
                              <td style="padding:15px; ">
                              
                              <table border="0" style="background:#fff; padding:20px; width:100%">
                          <tr>
                            <td >Dear <strong>Admin</strong><br>, Booking from <strong>' . $patient->full_name . '</strong> for Dr. <strong>' . $doctor . '</strong> <br><br> 
    
                          </td>
                          </tr>
    
                          <tr>
    
                          <table border="0" cellpadding="5" cellspacing="1" style=" padding:0px 20px 20px 20px; width:100%; background:#fff; ">
    
                          <tr>
    
                          <td width="25%">Full Name</td>
                          <td width="75%">' . $patient->full_name . '</td>
                          </tr>
                          <tr>
    
                          <td>Address</td>
                          <td>' . $patient->address . '</td>
                          </tr>
                          <tr>
                          <tr>
    
                          <td>Mobile</td>
                          <td>' . $patient->mobile . '</td>
                          </tr>
                          <tr>
    
                          <td>Email Address</td>
                          <td>' . $patient->email . '</td>
                          </tr>
                          <tr>
                          <tr>
    
                          <td>Date</td>
                          <td>' . Carbon::parse(Input::get('date'))->toFormattedDateString() . '</td>
                          </tr>
                          <tr>
                          <tr>
    
                          <td>Shift</td>
                          <td>' . Input::get('shift') . '</td>
                          </tr>
                          <tr>
    
                          <td valign="top">Message</td>
                          <td>' . $patient->message . '</td>
                          </tr>
    
                          <tr>
                          <td ></td>
    
                          </table>
                          </tr>
                            <tr>
                            
                            </tr>
                          </table> <!--content table end-->
    
                              </td>
                            </tr>
                          </table>
    
                          </body>
                          </html>';

            $email_data['to'] = 'info@nirvanawellnessclinic.com';

            $email_data['body'] = $content;

            General::sendMailFunction('emails.main', $email_data, 'Inquiry from ' . $patient->full_name);


            $client_content = '<!DOCTYPE html>
                          <html lang="en">
                          <head>
                          <meta charset="utf-8">
                          <meta name="viewport" content="width=device-width, initial-scale=1.0">
                          <meta name="description" content="">
                          <meta name="author" content="">
                          <link href="" type="images/png" rel="icon" />
                          <title>Nirvana Welness Clinic </title>
    
                          </head>
                          <body >
                          <table border="0" style="width:650px; background:#f2f2f2; color:#333; margin:auto; font-family:Arial, Helvetica, sans-serif; font-size:13px; line-height:1.6">
                          <tr><td style=" text-align:center;  padding-top:15px ;"><a target="_blank"><img src="' . asset('images/logo.png') . '" style="width:300px;"></a></td></tr>
    
    
                            <tr>
                              <td style="padding:15px; ">
                              
                              <table border="0" style="background:#fff; padding:20px; width:100%">
                          <tr>
                            <td >Dear <strong>' . $patient->full_name . ', <br> Your booking for <strong>Dr. ' . $doctor . '</strong> was successful. <br><br> 
    
                          </td>
                          </tr>
    
                          <tr>
    
                          <table border="0" cellpadding="5" cellspacing="1" style=" padding:0px 20px 20px 20px; width:100%; background:#fff; ">
    
                          <tr>
    
                          <td width="25%">Full Name</td>
                          <td width="75%">' . $patient->full_name . '</td>
                          </tr>
                          <tr>
    
                          <td>Address</td>
                          <td>' . $patient->address . '</td>
                          </tr>
                          <tr>
                          <tr>
    
                          <td>Mobile</td>
                          <td>' . $patient->mobile . '</td>
                          </tr>
                          <tr>
    
                          <td>Email Address</td>
                          <td>' . $patient->email . '</td>
                          </tr>
                          <tr>
                          <tr>
    
                          <td>Date</td>
                          <td>' . Carbon::parse(Input::get('date'))->toFormattedDateString() . '</td>
                          </tr>
                          <tr>
                          <tr>
    
                          <td>Shift</td>
                          <td>' . Input::get('shift') . '</td>
                          </tr>
                          <tr>
    
                          <td valign="top">Message</td>
                          <td>' . $patient->message . '</td>
                          </tr>
    
                          <tr>
                          <td ></td>
    
                          </table>
                          </tr>
                            <tr>
                            
                            </tr>
                          </table> <!--content table end-->
    
                              </td>
                            </tr>
                          </table>
    
                          </body>
                          </html>';

            $client_email_data['to'] = $patient->email;

            $client_email_data['body'] = $client_content;

            General::sendMailFunction('emails.main', $client_email_data, 'Response from Nirvana Wellness Clinic.');
        }

        if($patient->status == 'confirm')
            return redirect('admin/appointments');
        elseif($patient->Status == 'pending')
            return redirect('admin/appointments/pending');
        else
            return redirect('admin/appointments/successful');


    }

    public function manualBooking(){
        $data['packages'] = Packages::where('status',1)->get();
        return view('appointments::admin.v_manual_booking',$data);
    }

    public function getDoctors($package_id){
        $doctors = DB::table('packages_doctors as PD')
                                ->join('doctors as D','PD.doctor_id','=','D.id')
                                ->where('PD.package_id',$package_id)
                                ->select('D.id','D.full_name')
                                ->get();
        if(count($doctors) > 0)
            print_r(json_encode(['status' => 'success', 'value' => $doctors]));
        else
            print_r(json_encode(['status' => 'success', 'value' => 'Empty']));
    }

    public function manualBookingSubmit(Request $request){
        $this->validate($request, ['full_name' => 'required']);
        $data['patient_info'] = json_encode(Input::all());

        $data['doctor'] = Doctors::where('id', Input::get('doctor_id'))->first();
        $data['schedule'] = Timetable::where('doctor_id',$data['doctor']->id)->select('start_date as start','end_date as end','days')->get()->toArray();
        $today = date('Y-m-d');
        if(count($data['schedule'])>0) {
            $unavailable = explode(' - ', $data['doctor']->unavailability_time);


            for ($i = 0; $i < count($data['schedule']); $i++) {
                $sched[] = self::dateRange($data['schedule'][$i]['start'], $data['schedule'][$i]['end']);
                $days[] = $data['schedule'][$i]['days'];
            }

            $count=0;
            for ($f = 0; $f < count($sched); $f++){
                $days[$f] = explode(',',$days[$f]);

                for($k = 0; $k < count($sched[$f]); $k++) {
                    $date = date("Y-m-d", strtotime($sched[$f][$k]));

                    $times = strtotime($date);
                    $day = self::return_full_day(date('D', $times));

                    if ($date < $today){
                        if($unavailable[0]!=0){
                            if(self::check_in_range($unavailable[0], $unavailable[1], $date)){
                                $final_date[$count]['date'] = $date;
                                $final_date[$count]['badge'] = false;
                            }
                        }
                        $final_date[$count]['date'] = $date;
                        $final_date[$count]['badge'] = false;

                    }else{
                        if(in_array($day,$days[$f])){
                            if($unavailable[0]!=0){
                                if(self::check_in_range($unavailable[0], $unavailable[1], $date)){

                                }else{
                                    $final_date[$count]['date'] = $date;
                                    $final_date[$count]['badge'] = true;
                                    $count++;
                                }
                            }else{
                                $final_date[$count]['date'] = $date;
                                $final_date[$count]['badge'] = true;
                                $count++;
                            }
                        }
                    }

                }

            }


            $data['result'] = json_encode($final_date);

            return view('appointments::admin.v_select_manual_date_package', $data);
        }else{
            Session::flash('no_schedule','Dr. '.$data['doctor']->full_name.'\'s schedule has not been updated in the system. Please contact clinic for information.');
            return Redirect::back();
        }


    }

    public function manualBookingFinal(Request $request){
        ini_set('memory_limit', '512M');
        ini_set('max_execution_time', 3000);

        $this->validate($request, ['shift' => 'required',
            'date' => 'required']);

        $patient = json_decode(Input::get('patient_info'));
        $doctor = Doctors::where('id', $patient->doctor_id)->pluck('full_name');

        $app = new PackageBookings;
        $app->doctor_id = $patient->doctor_id;
        $app->package_id = $patient->package_id;
        $app->date = Input::get('date');
        $app->shift = Input::get('shift');
        $app->f_name = $patient->full_name;
        $app->address = $patient->address;
        $app->mobile = $patient->mobile;
        $app->email = $patient->email;
        $app->message = $patient->message;

        if($patient->status == 'pending'){
            $app->is_confirmed = 0;
            $app->is_success = 0;
        }elseif($patient->status == 'confirm'){
            $app->is_confirmed = 1;
            $app->is_success = 0;
        }else{
            $app->is_confirmed = 0;
            $app->is_success = 1;
        }

        $app->save();
        if($patient->email != "") {
            $content = '<!DOCTYPE html>
                          <html lang="en">
                          <head>
                          <meta charset="utf-8">
                          <meta name="viewport" content="width=device-width, initial-scale=1.0">
                          <meta name="description" content="">
                          <meta name="author" content="">
                          <link href="" type="images/png" rel="icon" />
                          <title>Nirvana Welness Clinic </title>
    
                          </head>
                          <body >
                          <table border="0" style="width:650px; background:#f2f2f2; color:#333; margin:auto; font-family:Arial, Helvetica, sans-serif; font-size:13px; line-height:1.6">
                          <tr><td style=" text-align:center;  padding-top:15px ;"><a target="_blank"><img src="' . asset('images/logo.png') . '" style="width:300px;"></a></td></tr>
    
    
                            <tr>
                              <td style="padding:15px; ">
                              
                              <table border="0" style="background:#fff; padding:20px; width:100%">
                          <tr>
                            <td >Dear <strong>Admin</strong><br>, Booking from <strong>' . $patient->full_name . '</strong> for Dr. <strong>' . $doctor . '</strong> <br><br> 
    
                          </td>
                          </tr>
    
                          <tr>
    
                          <table border="0" cellpadding="5" cellspacing="1" style=" padding:0px 20px 20px 20px; width:100%; background:#fff; ">
    
                          <tr>
    
                          <td width="25%">Full Name</td>
                          <td width="75%">' . $patient->full_name . '</td>
                          </tr>
                          <tr>
    
                          <td>Address</td>
                          <td>' . $patient->address . '</td>
                          </tr>
                          <tr>
                          <tr>
    
                          <td>Mobile</td>
                          <td>' . $patient->mobile . '</td>
                          </tr>
                          <tr>
    
                          <td>Email Address</td>
                          <td>' . $patient->email . '</td>
                          </tr>
                          <tr>
                          <tr>
    
                          <td>Date</td>
                          <td>' . Carbon::parse(Input::get('date'))->toFormattedDateString() . '</td>
                          </tr>
                          <tr>
                          <tr>
    
                          <td>Shift</td>
                          <td>' . Input::get('shift') . '</td>
                          </tr>
                          <tr>
    
                          <td valign="top">Message</td>
                          <td>' . $patient->message . '</td>
                          </tr>
    
                          <tr>
                          <td ></td>
    
                          </table>
                          </tr>
                            <tr>
                            
                            </tr>
                          </table> <!--content table end-->
    
                              </td>
                            </tr>
                          </table>
    
                          </body>
                          </html>';

            $email_data['to'] = 'info@nirvanawellnessclinic.com';

            $email_data['body'] = $content;

            General::sendMailFunction('emails.main', $email_data, 'Inquiry from ' . $patient->full_name);


            $client_content = '<!DOCTYPE html>
                          <html lang="en">
                          <head>
                          <meta charset="utf-8">
                          <meta name="viewport" content="width=device-width, initial-scale=1.0">
                          <meta name="description" content="">
                          <meta name="author" content="">
                          <link href="" type="images/png" rel="icon" />
                          <title>Nirvana Welness Clinic </title>
    
                          </head>
                          <body >
                          <table border="0" style="width:650px; background:#f2f2f2; color:#333; margin:auto; font-family:Arial, Helvetica, sans-serif; font-size:13px; line-height:1.6">
                          <tr><td style=" text-align:center;  padding-top:15px ;"><a target="_blank"><img src="' . asset('images/logo.png') . '" style="width:300px;"></a></td></tr>
    
    
                            <tr>
                              <td style="padding:15px; ">
                              
                              <table border="0" style="background:#fff; padding:20px; width:100%">
                          <tr>
                            <td >Dear <strong>' . $patient->full_name . ', <br> Your booking with <strong>Dr. ' . $doctor . '</strong> was successful. <br><br> 
    
                          </td>
                          </tr>
    
                          <tr>
    
                          <table border="0" cellpadding="5" cellspacing="1" style=" padding:0px 20px 20px 20px; width:100%; background:#fff; ">
    
                          <tr>
    
                          <td width="25%">Full Name</td>
                          <td width="75%">' . $patient->full_name . '</td>
                          </tr>
                          <tr>
    
                          <td>Address</td>
                          <td>' . $patient->address . '</td>
                          </tr>
                          <tr>
                          <tr>
    
                          <td>Mobile</td>
                          <td>' . $patient->mobile . '</td>
                          </tr>
                          <tr>
    
                          <td>Email Address</td>
                          <td>' . $patient->email . '</td>
                          </tr>
                          <tr>
                          <tr>
    
                          <td>Date</td>
                          <td>' . Carbon::parse(Input::get('date'))->toFormattedDateString() . '</td>
                          </tr>
                          <tr>
                          <tr>
    
                          <td>Shift</td>
                          <td>' . Input::get('shift') . '</td>
                          </tr>
                          <tr>
    
                          <td valign="top">Message</td>
                          <td>' . $patient->message . '</td>
                          </tr>
    
                          <tr>
                          <td ></td>
    
                          </table>
                          </tr>
                            <tr>
                            
                            </tr>
                          </table> <!--content table end-->
    
                              </td>
                            </tr>
                          </table>
    
                          </body>
                          </html>';

            $client_email_data['to'] = $patient->email;

            $client_email_data['body'] = $client_content;

            General::sendMailFunction('emails.main', $client_email_data, 'Response from Nirvana Wellness Clinic.');
        }

        if($patient->status == 'confirm')
            return redirect('admin/appointments/packages');
        elseif($patient->Status == 'pending')
            return redirect('admin/appointments/pending');
        else
            return redirect('admin/appointments/packages/successful');


    }

}