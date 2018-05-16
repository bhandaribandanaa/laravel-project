<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Input;
use Modules\Events\Entities\EventAttendence;
use Modules\Events\Entities\EventDinner;
use Modules\Events\Entities\EventFacilityPermission;
use Modules\Events\Entities\EventLunch;
use Modules\Events\Entities\EventRegistrationTypeFacility;
use Modules\Events\Entities\Events;
use Modules\Events\Entities\Participants;
use Validator;


class BarcodeController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('frontend.barcode');
    }

    public function getAttendance()
    {
        return view('frontend.getAttendance');
    }

    public function getAttendanceResult()
    {
        $rules = ['barcodeData' => 'required'];
        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'message' => $validator->errors()->all()]);
        }
        try {
            $objectParticipants = Participants::where('barcode', Input::get('barcodeData'))->where('payment_status', '!=', 0)->first();
            $totalAttendance = EventAttendence::whereDate('date', '=', date('Y-m-d'))->count();
            if (count($objectParticipants) == '1') {

                $userRegisterTypeId = $objectParticipants->event_registration_type;
                $eventFacilityId = 1;
                $eventDate = date('Y-m-d');
                $eventId = $objectParticipants->event_id;

                $permissionCheck = EventFacilityPermission::where('event_id', $eventId)->where('registration_type_id', $userRegisterTypeId)->where('facility_id', $eventFacilityId)->whereDate('date', '=', $eventDate)->where('permission', '1')->first();
                $totalAttendance = EventAttendence::whereDate('date', '=', $eventDate)->count();

                if (count($permissionCheck) == '1') {

                    $totalAttendance = EventAttendence::whereDate('date', '=', $eventDate)->count();
                    $objectOldAttendant = EventAttendence::where('participant_id', $objectParticipants->id)->whereDate('date', '=', date('Y-m-d'))->first();
                    if ($objectParticipants->payment_status == '1') {
                        $payment_status = 'Paid';
                    } elseif ($objectParticipants->payment_status == '2') {
                        $payment_status = 'Credit';
                    } else {
                        $payment_status = 'Unpaid';
                    }
                    if (count($objectOldAttendant) == '0') {
                        $objectAttendence = new EventAttendence();
                        $objectAttendence->participant_id = $objectParticipants->id;
                        $objectAttendence->event_id = $objectParticipants->event_id;
                        $objectAttendence->date = date('Y-m-d');
                        $objectAttendence->time = date('H:i:s');
                        $objectAttendence->save();

                        $totalAttendance = $totalAttendance + 1;

                        if ($objectAttendence->id) {

                            $message = '<div class="title" style="color: green;">Welcome ' . $objectParticipants->salutation . ' ' . $objectParticipants->first_name . '' . $objectParticipants->last_name . '</div>';
                            $message .= '<table>';
                            $message .= '<tr><td>Name</td><td>' . $objectParticipants->salutation . ' ' . $objectParticipants->first_name . ' ' . $objectParticipants->last_name . '</td></tr>';
                            $message .= '<tr><td>Registration Type</td><td>' . $objectParticipants->eventRegistrationType->name . '</td></tr>';
                            $message .= '<tr><td>Payment Status</td><td>' . $payment_status . '</td></tr>';
                            $message .= '<tr><td>Check In Time</td><td>' . date('Y-m-d H:i:s') . '</td></tr>';
                            $message .= '</table>';
                            $message .= '<br /><div style="color: #0a0a0a;">Total <em>' . $totalAttendance . ' </em>Attendance on <em>' . date('Y-m-d') . '</em></div>';
                        }

                    } else {

                        $message = '<div class="title" style="color: red;">Welcome ' . $objectParticipants->salutation . ' ' . $objectParticipants->first_name . '' . $objectParticipants->last_name . '</div>';
                        $message .= '<p style="color: green;">You are Already Checked In</p>';
                        $message .= '<p style="color: red;">Last Checked In ' . $this->timeAgo(strtotime($objectOldAttendant->date . ' ' . $objectOldAttendant->time)) . '</p>';
                        $message .= '<table>';
                        $message .= '<tr><td>Name</td><td>' . $objectParticipants->salutation . ' ' . $objectParticipants->first_name . ' ' . $objectParticipants->last_name . '</td></tr>';
                        $message .= '<tr><td>Registration Type</td><td>' . $objectParticipants->eventRegistrationType->name . '</td></tr>';
                        $message .= '<tr><td>Payment Status</td><td>' . $payment_status . '</td></tr>';
                        $message .= '</table>';
                        $message .= '<br /><div style="color: #0a0a0a;">Total <em>' . $totalAttendance . ' </em>Attendance on <em>' . date('Y-m-d') . '</em></div>';

                    }

                } else {

                    $message = $message = '<div class="title" style="color: red;">No Access to Attendence </div>';
                    $message .= '<p style="color: green;">Participant : ' . $objectParticipants->salutation . ' ' . $objectParticipants->first_name . ' ' . $objectParticipants->last_name . '</p>';

                    $message .= '<br /><div style="color: #0a0a0a;">Total <em>' . $totalAttendance . ' </em>Attendance on <em>' . date('Y-m-d') . '</em></div>';

                }


            } else {
                $message = '<div class="title" style="color:red;">Participant Not Found</div>';
                $message .= '<br /><div style="color: #0a0a0a;">Total <em>' . $totalAttendance . ' </em>Attendance on <em>' . date('Y-m-d') . '</em></div>';
            }

            return response()->json(['status' => true, 'message' => $message]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['status' => false, 'message' => 'Error: Oops. Something went wrong. Please try again later.']);
        }
    }

    public function getLunch()
    {
        return view('frontend.getLunch');
    }

    public function getLunchResult()
    {

        $rules = ['barcodeData' => 'required'];
        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'message' => $validator->errors()->all()]);
        }
        try {
            $objectParticipants = Participants::where('barcode', Input::get('barcodeData'))->where('payment_status', '!=', 0)->first();
            $totalLunch = EventLunch::whereDate('date', '=', date('Y-m-d'))->count();

            if (count($objectParticipants) == '1') {

                $objectOldLunch = EventLunch::where('participant_id', $objectParticipants->id)->whereDate('date', '=', date('Y-m-d'))->first();

                $userRegisterTypeId = $objectParticipants->event_registration_type;
                $eventFacilityId = 2;
                $eventDate = date('Y-m-d');
                $eventId = $objectParticipants->event_id;

                $permissionCheck = EventFacilityPermission::where('event_id', $eventId)->where('registration_type_id', $userRegisterTypeId)->where('facility_id', $eventFacilityId)->whereDate('date', '=', $eventDate)->where('permission', '1')->first();

                if (count($permissionCheck) == '1') {

                    if ($objectParticipants->payment_status == '1') {
                        $payment_status = 'Paid';
                    } elseif ($objectParticipants->payment_status == '2') {
                        $payment_status = 'Credit';
                    } else {
                        $payment_status = 'Unpaid';
                    }

                    if (count($objectOldLunch) == '0') {
                        $objectLunch = new EventLunch();
                        $objectLunch->participant_id = $objectParticipants->id;
                        $objectLunch->event_id = $objectParticipants->event_id;
                        $objectLunch->date = date('Y-m-d');
                        $objectLunch->time = date('H:i:s');
                        $objectLunch->save();
                        $totalLunch = $totalLunch + 1;

                        if ($objectLunch->id) {

                            $message = '<div class="title" style="color: green;">Welcome ' . $objectParticipants->salutation . ' ' . $objectParticipants->first_name . '' . $objectParticipants->last_name . '</div>';
                            $message .= '<p style="color: green;">Welcome to Lunch</p>';
                            $message .= '<table>';
                            $message .= '<tr><td>Name</td><td>' . $objectParticipants->salutation . ' ' . $objectParticipants->first_name . ' ' . $objectParticipants->last_name . '</td></tr>';
                            $message .= '<tr><td>Registration Type</td><td>' . $objectParticipants->eventRegistrationType->name . '</td></tr>';
                            $message .= '<tr><td>Payment Status</td><td>' . $payment_status . '</td></tr>';
                            $message .= '</table>';
                            $message .= '<br /><div style="color: #0a0a0a;">Total <em>' . $totalLunch . ' </em>Participants for lunch on <em>' . date('Y-m-d') . '</em></div>';
                        }

                    } else {
                        $message = '<div class="title" style="color: red;">Welcome ' . $objectParticipants->salutation . ' ' . $objectParticipants->first_name . '' . $objectParticipants->last_name . '</div>';
                        $message .= '<p style="color: green;">You are Already Taken Lunch</p>';
                        $message .= '<p style="color: red;">Last Lunch taken ' . $this->timeAgo(strtotime($objectOldLunch->date . ' ' . $objectOldLunch->time)) . '</p>';
                        $message .= '<table>';
                        $message .= '<tr><td>Name</td><td>' . $objectParticipants->salutation . ' ' . $objectParticipants->first_name . ' ' . $objectParticipants->last_name . '</td></tr>';
                        $message .= '<tr><td>Registration Type</td><td>' . $objectParticipants->eventRegistrationType->name . '</td></tr>';
                        $message .= '<tr><td>Payment Status</td><td>' . $payment_status . '</td></tr>';
                        $message .= '</table>';
                        $message .= '<br /><div style="color: #0a0a0a;">Total <em>' . $totalLunch . ' </em>Participants for lunch on <em>' . date('Y-m-d') . '</em></div>';

                    }

                } else {

                    $message = $message = '<div class="title" style="color: red;">No Access to Lunch </div>';
                    $message .= '<p style="color: green;">Participant : ' . $objectParticipants->salutation . ' ' . $objectParticipants->first_name . ' ' . $objectParticipants->last_name . '</p>';

                    $message .= '<br /><div style="color: #0a0a0a;">Total <em>' . $totalLunch . ' </em>Participants for lunch on <em>' . date('Y-m-d') . '</em></div>';

                }


                // if first time
            } else {
                $message = '<div class="title">Participant Not Found</div><br /><div style="color: #0a0a0a;">Total <em>' . $totalLunch . ' </em>Participants for lunch on <em>' . date('Y-m-d') . '</em></div>';
            }
            return response()->json(['status' => true, 'message' => $message]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['status' => false, 'message' => 'Error: Oops. Something went wrong. Please try again later.']);
        }

    }

    public function getDinner()
    {
        return view('frontend.getDinner');
    }

    public function getDinnerResult()
    {
        $rules = ['barcodeData' => 'required'];
        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'message' => $validator->errors()->all()]);
        }
        try {
            $objectParticipants = Participants::where('barcode', Input::get('barcodeData'))->where('payment_status', '!=', 0)->first();
            $totalDinner = EventDinner::whereDate('date', '=', date('Y-m-d'))->count();
            if (count($objectParticipants) == '1') {
                $objectOldDinner = EventDinner::where('participant_id', $objectParticipants->id)->whereDate('date', '=', date('Y-m-d'))->first();

                $userRegisterTypeId = $objectParticipants->event_registration_type;
                $eventFacilityId = 3;
                $eventDate = date('Y-m-d');
                $eventId = $objectParticipants->event_id;

                $permissionCheck = EventFacilityPermission::where('event_id', $eventId)->where('registration_type_id', $userRegisterTypeId)->where('facility_id', $eventFacilityId)->whereDate('date', '=', $eventDate)->where('permission', '1')->first();


                if (count($permissionCheck) == '1') {
                    if ($objectParticipants->payment_status == '1') {
                        $payment_status = 'Paid';
                    } elseif ($objectParticipants->payment_status == '2') {
                        $payment_status = 'Credit';
                    } else {
                        $payment_status = 'Unpaid';
                    }
                    if (count($objectOldDinner) == '0') {
                        $objectDinner = new EventDinner();
                        $objectDinner->participant_id = $objectParticipants->id;
                        $objectDinner->event_id = $objectParticipants->event_id;
                        $objectDinner->date = date('Y-m-d');
                        $objectDinner->time = date('H:i:s');
                        $objectDinner->save();
                        $totalDinner = $totalDinner + 1;

                        if ($objectDinner->id) {

                            $message = '<div class="title" style="color: green;">Welcome ' . $objectParticipants->salutation . ' ' . $objectParticipants->first_name . '' . $objectParticipants->last_name . '</div>';
                            $message .= '<p style="color: green;">Welcome to Dinner</p>';
                            $message .= '<table>';
                            $message .= '<tr><td>Name</td><td>' . $objectParticipants->salutation . ' ' . $objectParticipants->first_name . ' ' . $objectParticipants->last_name . '</td></tr>';
                            $message .= '<tr><td>Registration Type</td><td>' . $objectParticipants->eventRegistrationType->name . '</td></tr>';
                            $message .= '<tr><td>Payment Status</td><td>' . $payment_status . '</td></tr>';
                            $message .= '</table>';
                            $message .= '<br /><div style="color: #0a0a0a;">Total <em>' . $totalDinner . ' </em>Participants for donner on <em>' . date('Y-m-d') . '</em></div>';
                        }

                    } else {


                        $message = '<div class="title" style="color: red;">Welcome ' . $objectParticipants->salutation . ' ' . $objectParticipants->first_name . '' . $objectParticipants->last_name . '</div>';
                        $message .= '<p style="color: green;">You are Already Taken Dinner</p>';
                        $message .= '<p style="color: red;">Last Dinner taken ' . $this->timeAgo(strtotime($objectOldDinner->date . ' ' . $objectOldDinner->time)) . '</p>';
                        $message .= '<table>';
                        $message .= '<tr><td>Name</td><td>' . $objectParticipants->salutation . ' ' . $objectParticipants->first_name . ' ' . $objectParticipants->last_name . '</td></tr>';
                        $message .= '<tr><td>Registration Type</td><td>' . $objectParticipants->eventRegistrationType->name . '</td></tr>';
                        $message .= '<tr><td>Payment Status</td><td>' . $payment_status . '</td></tr>';
                        $message .= '</table>';
                        $message .= '<br /><div style="color: #0a0a0a;">Total <em>' . $totalDinner . ' </em>Participants for donner on <em>' . date('Y-m-d') . '</em></div>';

                    }

                } else {

                    $message = $message = '<div class="title" style="color: red;">No Access to Dinner </div>';
                    $message .= '<p style="color: green;">Participant : ' . $objectParticipants->salutation . ' ' . $objectParticipants->first_name . ' ' . $objectParticipants->last_name . '</p>';

                    $message .= '<br /><div style="color: #0a0a0a;">Total <em>' . $totalDinner . ' </em>Participants for Dinner on <em>' . date('Y-m-d') . '</em></div>';

                }

                // if first time
            } else {
                $message = '<div class="title">Participant Not Found</div>';
                $message .= '<br /><div style="color: #0a0a0a;">Total <em>' . $totalDinner . ' </em>Participants for Dinner on <em>' . date('Y-m-d') . '</em></div>';
            }
            return response()->json(['status' => true, 'message' => $message]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['status' => false, 'message' => 'Error: Oops. Something went wrong. Please try again later.']);
        }

    }

    public function getCheck()
    {
        return view('frontend.getCheck');
    }

    public function getCheckResult()
    {
        $rules = ['barcodeData' => 'required'];
        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'message' => $validator->errors()->all()]);
        }
        try {
//            $objectParticipants = Participants::where('barcode', Input::get('barcodeData'))->where('payment_status', '!=', 0)->first();
            $objectParticipants = Participants::where('barcode', Input::get('barcodeData'))->first();

            if (count($objectParticipants) == '1') {

                $paymentNote = '';

                if ($objectParticipants->payment_status == '1') {
                    $payment_status = 'Paid';
                    $paymentNote = $objectParticipants->receipt_no;
                } elseif ($objectParticipants->payment_status == '2') {
                    $payment_status = 'Credit';
                    $paymentNote = $objectParticipants->remarks;;
                } else {
                    $payment_status = 'Unpaid';
                }

                $objectRegistrationTypeFacility = EventRegistrationTypeFacility::where('event_id', $objectParticipants->event_id)->get();
                $eventInfo = Events::find($objectParticipants->event_id);

                $message = '<div class="title" style="color: green;">Welcome ' . $objectParticipants->salutation . ' ' . $objectParticipants->first_name . '' . $objectParticipants->last_name . '</div>';
                $message .= '<table>';
                $message .= '<tr><td>Name</td><td>' . $objectParticipants->salutation . ' ' . $objectParticipants->first_name . ' ' . $objectParticipants->last_name . '</td></tr>';
                $message .= '<tr><td>Registration Type</td><td>' . $objectParticipants->eventRegistrationType->name . '</td></tr>';
                $message .= '<tr><td>Payment Status</td><td>' . $payment_status . '</td></tr>';
                $message .= '<tr><td>Receipt/Remarks</td><td>' . $paymentNote . '</td></tr>';
                $message .= '</table>';
                $message .= '<hr>';
                $message .= '<table class="bordered">';
                $message .= '<thead> <tr> <th rowspan="2" style="vertical-align: bottom;">Date</th><th colspan="4">Permission</th></tr>';

                foreach ($objectRegistrationTypeFacility as $facility) {
                    $message .= '<th>' . $facility->facility_name . '</th>';
                }

                $startTime = strtotime($eventInfo->start_date . '12:00');
                $endTime = strtotime($eventInfo->end_date . '12:00');
                for ($i = $startTime; $i <= $endTime; $i = $i + 86400) {
                    $message .= '<tr>';
                    $message .= '<td>' . date('Y-m-d', $i) . '</td>';
                    foreach ($objectRegistrationTypeFacility as $facility) {
                        $hasFacility = \App\Classes\EventPermission::getEventPermissionCheckBy($eventInfo->id, $objectParticipants->event_registration_type, $facility->id, date('Y-m-d', $i));

                        $message .= '<td>' . $hasFacility . '</td>';
                    }

                    $message .= '</tr>';
                }

                $message .= ' </tr></thead>';
                $message .= '</table>';

            } else {
                $message = '<div class="title">Participant Not Found</div>';

            }

            return response()->json(['status' => true, 'message' => $message]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['status' => false, 'message' => 'Error: Oops. Something went wrong. Please try again later.']);
        }

    }

    public function timeAgo($time)
    {
        define('TIMEBEFORE_NOW', 'now');
        define('TIMEBEFORE_MINUTE', '{num} minute ago');
        define('TIMEBEFORE_MINUTES', '{num} minutes ago');
        define('TIMEBEFORE_HOUR', '{num} hour ago');
        define('TIMEBEFORE_HOURS', '{num} hours ago');
        define('TIMEBEFORE_YESTERDAY', 'yesterday');
        define('TIMEBEFORE_FORMAT', '%e %b');
        define('TIMEBEFORE_FORMAT_YEAR', '%e %b, %Y');
        $out = ''; // what we will print out
        $now = time(); // current time
        $diff = $now - $time; // difference between the current and the provided dates

        if ($diff < 60) // it happened now
            return TIMEBEFORE_NOW;

        elseif ($diff < 3600) // it happened X minutes ago
            return str_replace('{num}', ($out = round($diff / 60)), $out == 1 ? TIMEBEFORE_MINUTE : TIMEBEFORE_MINUTES);

        elseif ($diff < 3600 * 24) // it happened X hours ago
            return str_replace('{num}', ($out = round($diff / 3600)), $out == 1 ? TIMEBEFORE_HOUR : TIMEBEFORE_HOURS);

        elseif ($diff < 3600 * 24 * 2) // it happened yesterday
            return TIMEBEFORE_YESTERDAY;

        else // falling back on a usual date format as it happened later than yesterday
            return strftime(date('Y', $time) == date('Y') ? TIMEBEFORE_FORMAT : TIMEBEFORE_FORMAT_YEAR, $time);
    }


}
