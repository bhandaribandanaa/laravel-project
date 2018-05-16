<?php namespace Modules\Doctors\Http\Controllers;
/**
 * Created by PhpStorm.
 * Author: Amit Shrestha.
 * Date: 12/14/17
 * Time: 11:08 AM
 */
use PhpParser\Comment\Doc;
use Pingpong\Modules\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Redirect;
use Input;
use Session;

use App\Doctors;
use App\Timetable;
use App\CustomLibrary\General;
use App\Specializations;
use App\Appointments;
use Carbon;

class ApiDoctorsController extends Controller{

    public function appointment($slug, $sender_id){

        $data['doctor'] = Doctors::where('slug', $slug)->first();
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

            $data['sender_id'] = $sender_id;

            return view('doctors::api.v_doctor_calender_zabuto', $data);
        }else{
            $data['alternates'] = Doctors::where('specialization_id',$data['doctor']->specialization_id)->where('id','!=',$data['doctor']->id)->get();
            $data['spec'] = Specializations::where('status',1)->get();
            $data['sp'] = Specializations::where('id',$data['doctor']->specialization_id)->select('slug','title')->first();
            Session::flash('no_schedule','Dr. '.$data['doctor']->full_name.'\'s schedule has not been updated in the system. Please contact clinic for information.');
            return view('doctors::api.v_doctor_alternative',$data);
        }

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

    public function check_in_range($start_date, $end_date, $date_from_user)
    {
        // Convert to timestamp
        $start_ts = strtotime($start_date);
        $end_ts = strtotime($end_date);
        $user_ts = strtotime($date_from_user);

        // Check that user date is between start & end
        return (($user_ts >= $start_ts) && ($user_ts <= $end_ts));
    }

    public function getAppointment($slug,$date, $sender_id){
        $times = strtotime($date);
        $day = self::return_full_day(date('D', $times));
        $data['doctor'] = Doctors::where('slug',$slug)->select('id','full_name','unavailability_time','specialization_id')->first();
        $sch = Timetable::where('doctor_id',$data['doctor']->id)->get();

        foreach($sch as $s){
            if(self::check_in_range($s->start_date, $s->end_date, $date)){
                if(in_array($day, explode(',',$s->days)))
                    $data['shift'] = $s->shift;
            }
        }

        $data['shifts'] = explode(',',$data['shift']);

        $data['date'] = $date;
        $data['sender_id'] = $sender_id;

        return view('doctors::api.v_doctor_appointment',$data);
    }

    public function book(Request $request){
        ini_set('memory_limit', '512M');
        ini_set('max_execution_time', 3000);

        $this->validate($request, ['f_name' => 'required',
            'address' => 'required',
            'mobile' => 'required',
            'email' => 'required|email',
            'date' => 'required',
            'shift' => 'required'
        ]);

        $doctor = Doctors::where('id',Input::get('doctor_id'))->pluck('full_name');

        $app = new Appointments;
        $app->doctor_id = Input::get('doctor_id');
        $app->date = Input::get('date');
        $app->shift = Input::get('shift');
        $app->f_name = Input::get('f_name');
        $app->address = Input::get('address');
        $app->mobile = Input::get('mobile');
        $app->email = Input::get('email');
        $app->message = Input::get('message');
        $app->is_confirmed = 0;
        $app->is_success = 0;
        $app->save();


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
                      <tr><td style=" text-align:center;  padding-top:15px ;"><a target="_blank"><img src="'. asset('images/logo.png') .'" style="width:300px;"></a></td></tr>


                        <tr>
                          <td style="padding:15px; ">
                          
                          <table border="0" style="background:#fff; padding:20px; width:100%">
                      <tr>
                        <td >Dear <strong>Admin</strong><br>, Booking from <strong>'. Input::get('f_name') . '</strong> for Dr. <strong>'. $doctor .'</strong> <br><br> 

                      </td>
                      </tr>

                      <tr>

                      <table border="0" cellpadding="5" cellspacing="1" style=" padding:0px 20px 20px 20px; width:100%; background:#fff; ">

                      <tr>

                      <td width="25%">Full Name</td>
                      <td width="75%">'. Input::get('f_name') .'</td>
                      </tr>
                      <tr>

                      <td>Address</td>
                      <td>'. Input::get('address') .'</td>
                      </tr>
                      <tr>
                      <tr>

                      <td>Mobile</td>
                      <td>'. Input::get('mobile') .'</td>
                      </tr>
                      <tr>

                      <td>Email Address</td>
                      <td>'. Input::get('email') .'</td>
                      </tr>
                      <tr>
                      <tr>

                      <td>Date</td>
                      <td>'. Input::get('date') .'</td>
                      </tr>
                      <tr>
                      <tr>

                      <td>Shift</td>
                      <td>'. Input::get('shift') .'</td>
                      </tr>
                      <tr>

                      <td valign="top">Message</td>
                      <td>'. Input::get('message') .'</td>
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

        $email_data['to']= 'info@nirvanawellnessclinic.com';

        $email_data['body']=$content;

        General::sendMailFunction('emails.main',$email_data,'Inquiry from '.Input::get('f_name'));


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
                      <tr><td style=" text-align:center;  padding-top:15px ;"><a target="_blank"><img src="'. asset('images/logo.png') .'" style="width:300px;"></a></td></tr>


                        <tr>
                          <td style="padding:15px; ">
                          
                          <table border="0" style="background:#fff; padding:20px; width:100%">
                      <tr>
                        <td >Dear <strong>'. Input::get('f_name') . ', <br> Your booking for <strong>Dr. '. $doctor .'</strong> was successful. <br><br> 

                      </td>
                      </tr>

                      <tr>

                      <table border="0" cellpadding="5" cellspacing="1" style=" padding:0px 20px 20px 20px; width:100%; background:#fff; ">

                      <tr>

                      <td width="25%">Full Name</td>
                      <td width="75%">'. Input::get('f_name') .'</td>
                      </tr>
                      <tr>

                      <td>Address</td>
                      <td>'. Input::get('address') .'</td>
                      </tr>
                      <tr>
                      <tr>

                      <td>Mobile</td>
                      <td>'. Input::get('mobile') .'</td>
                      </tr>
                      <tr>

                      <td>Email Address</td>
                      <td>'. Input::get('email') .'</td>
                      </tr>
                      <tr>
                      <tr>

                      <td>Date</td>
                      <td>'. Carbon\Carbon::parse(Input::get('date'))->toFormattedDateString() .'</td>
                      </tr>
                      <tr>
                      <tr>

                      <td>Shift</td>
                      <td>'. Input::get('shift') .'</td>
                      </tr>
                      <tr>

                      <td valign="top">Message</td>
                      <td>'. Input::get('message') .'</td>
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

        $client_email_data['to']= Input::get('email');

        $client_email_data['body']=$client_content;

        General::sendMailFunction('emails.main',$client_email_data,'Response from Nirvana Wellness Clinic.');



        $data['detail'] = Input::all();

        $data['doctor_name'] = Doctors::where('id',Input::get('doctor_id'))->pluck('full_name');

        $data['sender_id'] = Input::get('sender_id');

        return view('doctors::api.v_success',$data);


    }

    public function sendSMS($receivers, $message) {

        $receivers="9842248633";
        $message="tfkcftytkfty";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'http://app.easy.com.np/easyApi');
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);

        $data = [
            'key' => 'EASY57185b731f6dd1.85446264',
            'source' => 'none',
            'message' =>$message,
            'destination' => $receivers,
            'type' => 1];


        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        $contents = curl_exec($ch);

        curl_close($ch);

        return $decoded = json_decode($contents, true);


    }

}