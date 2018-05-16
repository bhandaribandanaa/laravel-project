<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Input;
use Modules\Events\Entities\EventAttendence;
use Modules\Events\Entities\EventDinner;
use Modules\Events\Entities\EventLunch;
use Modules\Events\Entities\Participants;
use Validator;


class OldBarcodeController extends Controller
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

            if (count($objectParticipants) == '1') {
                $totalAttendance = EventAttendence::whereDate('date', '=', date('Y-m-d'))->count();
                $attendant = EventAttendence::where('participant_id', $objectParticipants->id)->whereDate('date', '=', date('Y-m-d'))->count();
                if ($objectParticipants->payment_status == '1') {
                    $payment_status = 'Paid';
                } elseif ($objectParticipants->payment_status == '2') {
                    $payment_status = 'Credit';
                } else {
                    $payment_status = 'Unpaid';
                }
                if ($attendant == '0') {
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
                    $message = '<div class="title" style="color: green;">Welcome ' . $objectParticipants->salutation . ' ' . $objectParticipants->first_name . '' . $objectParticipants->last_name . '</div>';
                    $message .= '<p style="color: red;">You are Already Checked In</p>';
                    $message .= '<table>';
                    $message .= '<tr><td>Name</td><td>' . $objectParticipants->salutation . ' ' . $objectParticipants->first_name . ' ' . $objectParticipants->last_name . '</td></tr>';
                    $message .= '<tr><td>Registration Type</td><td>' . $objectParticipants->eventRegistrationType->name . '</td></tr>';
                    $message .= '<tr><td>Payment Status</td><td>' . $payment_status . '</td></tr>';
                    $message .= '</table>';
                    $message .= '<br /><div style="color: #0a0a0a;">Total <em>' . $totalAttendance . ' </em>Attendance on <em>' . date('Y-m-d') . '</em></div>';

                }
                // if first time
            } else {
                $message = '<div class="title">Participant Not Found</div>';
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

            if (count($objectParticipants) == '1') {
                $lunch = EventLunch::where('participant_id', $objectParticipants->id)->whereDate('date', '=', date('Y-m-d'))->count();
                $totalLunch = EventLunch::whereDate('date', '=', date('Y-m-d'))->count();
                if ($lunch == '0') {
                    $objectLunch = new EventLunch();
                    $objectLunch->participant_id = $objectParticipants->id;
                    $objectLunch->event_id = $objectParticipants->event_id;
                    $objectLunch->date = date('Y-m-d');
                    $objectLunch->time = date('H:i:s');
                    $objectLunch->save();
                    $totalLunch= $totalLunch+1;

                    if ($objectLunch->id) {

                        $message = '<div class="title" style="color: green;">Welcome ' . $objectParticipants->salutation . ' ' . $objectParticipants->first_name . '' . $objectParticipants->last_name . '</div>';
                        $message .= '<p style="color: green;">Welcome to Lunch</p>';
                        $message .= '<table>';
                        $message .= '<tr><td>Name</td><td>' . $objectParticipants->salutation . ' ' . $objectParticipants->first_name . ' ' . $objectParticipants->last_name . '</td></tr>';
                        $message .= '<tr><td>Registration Type</td><td>' . $objectParticipants->eventRegistrationType->name . '</td></tr>';
                        $message .= '</table>';
                        $message .= '<br /><div style="color: #0a0a0a;">Total <em>' . $totalLunch . ' </em>Participants for lunch on <em>' . date('Y-m-d') . '</em></div>';
                    }

                } else {
                    $message = '<div class="title" style="color: green;">Welcome ' . $objectParticipants->salutation . ' ' . $objectParticipants->first_name . '' . $objectParticipants->last_name . '</div>';
                    $message .= '<p style="color: red;">You are Already Taken Lunch</p>';
                    $message .= '<table>';
                    $message .= '<tr><td>Name</td><td>' . $objectParticipants->salutation . ' ' . $objectParticipants->first_name . ' ' . $objectParticipants->last_name . '</td></tr>';
                    $message .= '<tr><td>Registration Type</td><td>' . $objectParticipants->eventRegistrationType->name . '</td></tr>';
                    $message .= '</table>';
                    $message .= '<br /><div style="color: #0a0a0a;">Total <em>' . $totalLunch . ' </em>Participants for lunch on <em>' . date('Y-m-d') . '</em></div>';

                }
                // if first time
            } else {
                $message = '<div class="title">Participant Not Found</div>';
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

            if (count($objectParticipants) == '1') {
                $dinner = EventDinner::where('participant_id', $objectParticipants->id)->whereDate('date', '=', date('Y-m-d'))->count();
                $totalDinner = EventDinner::whereDate('date', '=', date('Y-m-d'))->count();
                if ($dinner == '0') {
                    $objectDinner = new EventDinner();
                    $objectDinner->participant_id = $objectParticipants->id;
                    $objectDinner->event_id = $objectParticipants->event_id;
                    $objectDinner->date = date('Y-m-d');
                    $objectDinner->time = date('H:i:s');
                    $objectDinner->save();
                    $totalDinner=$totalDinner+1;

                    if ($objectDinner->id) {

                        $message = '<div class="title" style="color: green;">Welcome ' . $objectParticipants->salutation . ' ' . $objectParticipants->first_name . '' . $objectParticipants->last_name . '</div>';
                        $message .= '<p style="color: green;">Welcome to Dinner</p>';
                        $message .= '<table>';
                        $message .= '<tr><td>Name</td><td>' . $objectParticipants->salutation . ' ' . $objectParticipants->first_name . ' ' . $objectParticipants->last_name . '</td></tr>';
                        $message .= '<tr><td>Registration Type</td><td>' . $objectParticipants->eventRegistrationType->name . '</td></tr>';
                        $message .= '</table>';
                        $message .= '<br /><div style="color: #0a0a0a;">Total <em>' . $totalDinner . ' </em>Participants for donner on <em>' . date('Y-m-d') . '</em></div>';
                    }

                } else {
                    $message = '<div class="title" style="color: green;">Welcome ' . $objectParticipants->salutation . ' ' . $objectParticipants->first_name . '' . $objectParticipants->last_name . '</div>';
                    $message .= '<p style="color: red;">You are Already Taken Dinner</p>';
                    $message .= '<table>';
                    $message .= '<tr><td>Name</td><td>' . $objectParticipants->salutation . ' ' . $objectParticipants->first_name . ' ' . $objectParticipants->last_name . '</td></tr>';
                    $message .= '<tr><td>Registration Type</td><td>' . $objectParticipants->eventRegistrationType->name . '</td></tr>';
                    $message .= '</table>';
                    $message .= '<br /><div style="color: #0a0a0a;">Total <em>' . $totalDinner . ' </em>Participants for donner on <em>' . date('Y-m-d') . '</em></div>';

                }
                // if first time
            } else {
                $message = '<div class="title">Participant Not Found</div>';
            }
            return response()->json(['status' => true, 'message' => $message]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['status' => false, 'message' => 'Error: Oops. Something went wrong. Please try again later.']);
        }

    }
}
