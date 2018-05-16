<?php namespace Modules\Packages\Http\Controllers;

use Illuminate\Workbench\Package;
use Pingpong\Modules\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Input;
use Session;
use DB;
use Redirect;

use App\Packages;
use App\Treatments;
use App\PackagesTreatments;
use App\PackagesDoctors;
use App\Specializations;
use App\Doctors;
use App\Timetable;
use App\PackageBookings;
use App\CustomLibrary\General;

use Carbon;

class PackagesController extends Controller {
	
	public function index()
	{
        $data['packages'] = Packages::where('status',1)->get();
        $data['treatments'] = Treatments::where('status',1)->get();
        foreach($data['treatments'] as $tr){
            $packages[] = PackagesTreatments::where('treatment_id',$tr->id)->pluck('package_id');
            $tr->packages = $packages;
        }

		return view('packages::v_packages',$data);
	}

	public function book($slug){
	    $id = Packages::where('slug',$slug)->pluck('id');

	    $data['doctors'] = DB::table('packages_doctors as PD')
                                ->join('doctors as D','PD.doctor_id','=','D.id')
                                ->where('PD.package_id',$id)
                                ->select('D.*')
                                ->get();

        $data['package_name'] = Packages::where('slug',$slug)->pluck('title');
	    $data['package'] = $slug;

	    return view('packages::v_select_doctor',$data);

    }

    public function appointment($package, $slug){
        $data['doctor'] = Doctors::where('slug', $slug)->first();
        $data['package'] = $package;
        $data['package_name'] = Packages::where('slug',$package)->pluck('title');
        $data['schedule'] = Timetable::where('doctor_id',$data['doctor']->id)->select('start_date as start','end_date as end','days')->get()->toArray();
        $today = date('Y-m-d');
        if(count($data['schedule']) > 0) {
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

            return view('packages::v_packages_doctors_calender_zabuto', $data);
        }else{

            $package_id = Packages::where('slug',$package)->pluck('id');
            $data['alternates'] = DB::table('packages_doctors as PD')
                                        ->join('doctors as D','PD.doctor_id','=','D.id')
                                        ->where('PD.package_id',$package_id)
                                        ->where('D.id','!=',$data['doctor']->id)
                                        ->select('D.*')
                                        ->get();

            $data['package'] = $package;
            $data['sp'] = Specializations::where('id',$data['doctor']->specialization_id)->select('slug','title')->first();
            Session::flash('package_doctor_error','Dr. '.$data['doctor']->full_name.'\'s schedule has not been updated in the system. Please contact clinic for information.');
            return view('packages::v_doctor_alternative',$data);
        }

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

    public function getAppointment($package,$slug,$date){

        $times = strtotime($date);
        $day = self::return_full_day(date('D', $times));
        $data['doctor'] = Doctors::where('slug', $slug)->first();
        $sch = Timetable::where('doctor_id',$data['doctor']->id)->get();
        $data['package'] = Packages::where('slug',$package)->select('id','title')->first();

        foreach($sch as $s){
            if(self::check_in_range($s->start_date, $s->end_date, $date)){
                if(in_array($day, explode(',',$s->days)))
                    $data['shift'] = $s->shift;
            }
        }

        $data['shifts'] = explode(',',$data['shift']);


        $data['date'] = $date;

        return view('packages::v_book_package',$data);

//        $data['doctor'] = Doctors::where('slug',$slug)->select('id','full_name','unavailability_time','specialization_id')->first();
//        $sch = Timetable::where('doctor_id',$data['doctor']->id)->get();
//
//        if($data['doctor']->unavailable_time != "")
//            $unavailable= explode(' - ',$data['doctor']->unavailability_time);
//
//
//
//        /*
//         * The following code is deprecated as the schedule feature has been updated. Assuming no any schedule
//         * overlaps with each other, checking date is not necessary. For the time being, I have not removed
//         * the code as it might be needed later.
//         */
//
//
//        if(isset($unavailable)){
//            if(self::check_in_range($unavailable[0],$unavailable[1],$date)) {
//                $data['alternates'] = Doctors::where('specialization_id', $data['doctor']->specialization_id)->where('id', '!=', $data['doctor']->id)->get();
//                $data['package'] = $package;
//                $data['sp'] = Specializations::where('id', $data['doctor']->specialization_id)->select('slug', 'title')->first();
//                Session::flash('appointment_doctor_error', 'Dr. ' . $data['doctor']->full_name . ' is not available on the selected date. Following are the alternative for you to visit on your desired date.');
//                return view('packages::v_doctor_alternative', $data);
//            }
//        }else{
//            $data['doctor'] = Doctors::where('slug', $slug)->first();
//            $data['schedule'] = Timetable::where('doctor_id',$data['doctor']->id)->select('start_date as start','end_date as end')->get()->toArray();
//            $unavailable= explode(' - ',$data['doctor']->unavailability_time);
//            for ($i=0; $i<count($data['schedule']); $i++){
//                $test[] = self::dateRange($data['schedule'][$i]['start'], $data['schedule'][$i]['end']);
//            }
//            $final_dates = array_values(array_unique(self::array_flatten($test)));
//            for ($i = 0; $i<count($final_dates); $i++){
//                $result[] = date("Y-m-d", strtotime($final_dates[$i]));
//
//            }
//
//            if(in_array($date,$result)){
//                foreach($sch as $sc){
//                    if($date >= $sc->start_date && $date <= $sc->end_date){
//                        $data['shift']=explode(',',$sc->shift);
//                    }
//                }
//                $data['package'] = Packages::where('slug',$package)->select('id','title')->first();
//                $data['date'] = $date;
//            }else{
//                $package_id = Packages::where('slug',$package)->pluck('id');
//                $data['alternates'] = DB::table('packages_doctors as PD')
//                    ->join('doctors as D','PD.doctor_id','=','D.id')
//                    ->where('PD.package_id',$package_id)
//                    ->where('D.id','!=',$data['doctor']->id)
//                    ->select('D.*')
//                    ->get();
//
//                $data['package'] = $package;
//                $data['sp'] = Specializations::where('id',$data['doctor']->specialization_id)->select('slug','title')->first();
//                Session::flash('unavailable_error','Dr. '.$data['doctor']->full_name.' is not available on the selected date. Following are the alternative for you to visit on your desired date.');
//                return view('packages::v_doctor_alternative',$data);
//            }
//
//
//        }

    }

    public function bookPackage(Request $request){
        ini_set('memory_limit', '512M');
        ini_set('max_execution_time', 3000);


        $this->validate($request, ['f_name' => 'required',
            'address' => 'required',
            'mobile' => 'required',
            'email' => 'required|email',
            'date' => 'required',
            'shift' => 'required'
        ]);


        $doc_name = Doctors::where('id',Input::get('doctor_id'))->pluck('full_name');
        $package_name = Packages::where('id',Input::get('package_id'))->pluck('title');
        $app = new PackageBookings;
        $app->doctor_id = Input::get('doctor_id');
        $app->package_id = Input::get('package_id');
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
                        <td >Dear <strong>Admin</strong>, <br> Booking from <strong>'. Input::get('f_name') . '</strong> for <strong> Dr. '. $doc_name .'</strong> for <strong>'.$package_name  .'</strong> <br><br> 

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

        $email_data['to']= 'info@nirvanawellnessclinic.com';

        $email_data['body']=$content;

        General::sendMailFunction('emails.main',$email_data,'Inquiry from '.Input::get('f_name'));


        $content_user = '<!DOCTYPE html>
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
                        <td >Dear <strong>'. Input::get('f_name') .'</strong>, <br> Your booking is has been created with <strong> Dr. '. $doc_name .'<strong> for <strong>'.$package_name  .'</strong> <br><br> 

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

        $user_email_data['to']= Input::get('email');

        $user_email_data['body']=$content_user;

        General::sendMailFunction('emails.main',$user_email_data,'Response from Nirvana Wellness Clinic');
        $data['detail'] = Input::all();

        return view('packages::v_success',$data);

    }
	
}