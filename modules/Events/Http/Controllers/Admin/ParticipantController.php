<?php namespace Modules\Events\Http\Controllers\Admin;

use App\Classes\Email;
use App\Libraries\FPDF\Barcode;
use App\Libraries\FPDF\eFPDF;
use Auth;
use DateInterval;
use DatePeriod;
use DateTime;
use Excel;
use Input;
use Modules\Events\Entities\BarcodeHistory;
use Modules\Events\Entities\EventRegistrationType;
use Modules\Events\Entities\Events;
use Modules\Events\Entities\Participants;
use PDF;
use Pingpong\Modules\Routing\Controller;
use Response;
use Validator;

class ParticipantController extends Controller
{
    public function getEventParticipants($eventId, $eventSlug)
    {
        $participants = Participants::listParticipants($eventId, Input::get('payment_status'), Input::get('event_registration_type'));
        $registrationType = EventRegistrationType::where('is_active', 1)->lists('name', 'id')->prepend('All Members Type', '');
        $event = Events::find($eventId);
        return view('events::admin.participants_list')->with(array('event' => $event, 'participants' => $participants, 'event_registration_type' => $registrationType));
    }

    public function editParticipants($event_id, $event_slug, $participant_id)
    {
        $eventParticipantsType = EventRegistrationType::where('is_active', 1)->lists('name', 'id');
        $participant = Participants::with('event')->find($participant_id);
        return view('events::admin.edit_participant')->with(array('participant' => $participant, 'event_participants_type' => $eventParticipantsType->toArray()));
    }

    public function updateParticipants($event_id, $event_slug, $participant_id)
    {
        $rules = array(
            'first_name' => 'required',
            'last_name' => 'required',
//            'address' => 'required',
//            'mobile_no' => 'required',
//            'email' => 'required|email',
//            'organization' => 'required',
//            'designation' => 'required',
        );
        $messages = [
            'first_name.required' => 'The First name is required.',
            'last_name.required' => 'The Last name is required.',
//            'address.required' => 'The address is required.',
//            'mobile_no.required' => 'The mobile is required.',
//            'email.required' => 'The email is required.',
//            'email.email' => 'Please enter the valid email address.',
//            'organization.required' => 'The organization is required.',
//            'designation.required' => 'The designation is required.',
        ];

        $validator = Validator::make(Input::all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {

            $eventDetail = Events::find($event_id);
            $objectParticipant = Participants::find($participant_id);
            if (empty($objectParticipant->barcode)) {
                $participantBarcode = self::generateParticipantBarcode($event_id, $objectParticipant->id);
                $objectParticipant->barcode = $participantBarcode;
            }
            $objectParticipant->salutation = Input::get('salutation');
            $objectParticipant->first_name = Input::get('first_name');
            $objectParticipant->middle_name = Input::get('middle_name');
            $objectParticipant->last_name = Input::get('last_name');
            $objectParticipant->address = Input::get('address');
            $objectParticipant->phone_no = Input::get('phone_no');
            $objectParticipant->mobile_no = Input::get('mobile_no');
            $objectParticipant->email = Input::get('email');
            $objectParticipant->organization = Input::get('organization');
            $objectParticipant->designation = Input::get('designation');
            $objectParticipant->payment_status = Input::get('payment_status');
            $objectParticipant->event_registration_type = Input::get('event_registration_type');
            if (Input::get('payment_status') === '1') {
                $objectParticipant->receipt_no = Input::get('receipt_no');
            }
            if (Input::get('payment_status') === '2') {
                $objectParticipant->remarks = Input::get('remarks');
            }
            $objectParticipant->updated_by = Auth::user()->id;
            $objectParticipant->save();

            if ($objectParticipant->id) {


                return redirect()->route('admin.event.participants', array($event_id, $event_slug))->withInput()->with('success', 'Participants Updated Successful.');

            } else {
                return redirect()->back()->withInput();
            }
        }

    }

    public function addEventParticipants($event_id, $event_slug)
    {
        $eventParticipantsType = EventRegistrationType::where('is_active', 1)->lists('name', 'id');
        $event = Events::findOrFail($event_id);
        return view('events::admin.add_participants')->with(array('event' => $event, 'event_participants_type' => $eventParticipantsType->toArray()));

    }


    public function createEventParticipants($event_id, $event_slug)
    {
//        $ParticipantsCheck = Participants::where('event_id', $event_id)->where('email', Input::get('email'))->get();
//        if (count($ParticipantsCheck) > 0) {
//            return redirect()->back()->withInput()->with('error', 'This email has already been register to this event. Please try with different email.');
//        }

        $rules = array(
            'first_name' => 'required',
            'last_name' => 'required',
            'event_registration_type' => 'required',
//            'address' => 'required',
//            'mobile_no' => 'required',
//            'email' => 'required|email',
        );
        $messages = [
            'first_name.required' => 'The First name is required.',
            'last_name.required' => 'The Last name is required.',
            'event_registration_type.required' => 'The Registration Type is required.',
//            'address.required' => 'The address is required.',
//            'mobile_no.required' => 'The mobile is required.',
//            'email.required' => 'The email is required.',
//            'email.email' => 'Please enter the valid email address.',
        ];

        $validator = Validator::make(Input::all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            $eventDetail = Events::find($event_id);
            $objectParticipant = new Participants;
            $objectParticipant->event_id = $event_id;
            $objectParticipant->event_registration_type = Input::get('event_registration_type');
            $objectParticipant->registration_via = '0';
            $objectParticipant->salutation = Input::get('salutation');
            $objectParticipant->first_name = Input::get('first_name');
            $objectParticipant->middle_name = Input::get('middle_name');
            $objectParticipant->last_name = Input::get('last_name');
            $objectParticipant->address = Input::get('address');
            $objectParticipant->phone_no = Input::get('phone_no');
            $objectParticipant->mobile_no = Input::get('mobile_no');
            $objectParticipant->email = Input::get('email');
            $objectParticipant->organization = Input::get('organization');
            $objectParticipant->designation = Input::get('designation');
            $objectParticipant->payment_status = Input::get('payment_status');
            $objectParticipant->barcode = Input::get('barcode1');
            if (Input::get('payment_status') === '1') {
                $objectParticipant->receipt_no = Input::get('receipt_no');
            }
            if (Input::get('payment_status') === '2') {
                $objectParticipant->remarks = Input::get('remarks');
            }
            $objectParticipant->created_by = Auth::user()->id;
            $objectParticipant->save();

            if ($objectParticipant->id) {

                // if the barcode is empty than generate barcode
                if (empty($objectParticipant->barcode)) {
                    $participantBarcode = self::generateParticipantBarcode($event_id, $objectParticipant->id);
                    $objectParticipant->barcode = $participantBarcode;
                    $objectParticipant->save();
                }
                // if participant with spouse

                if (Input::get('event_registration_type') == '3' || Input::get('event_registration_type') == '4') {
                    $objectSpouseParticipant = new Participants;
                    $objectSpouseParticipant->event_id = $event_id;
                    $objectSpouseParticipant->event_registration_type = '11';
                    $objectSpouseParticipant->parent_participant_id = $objectParticipant->id;
                    $objectSpouseParticipant->registration_via = '0';
                    $objectSpouseParticipant->salutation = Input::get('spouse_salutation');
                    $objectSpouseParticipant->first_name = Input::get('spouse_first_name');
                    $objectSpouseParticipant->middle_name = Input::get('spouse_middle_name');
                    $objectSpouseParticipant->last_name = Input::get('spouse_last_name');
                    $objectSpouseParticipant->address = Input::get('address');
                    $objectSpouseParticipant->phone_no = Input::get('phone_no');
                    $objectSpouseParticipant->mobile_no = Input::get('mobile_no');
                    $objectSpouseParticipant->email = Input::get('email');
                    $objectSpouseParticipant->organization = Input::get('organization');
                    $objectSpouseParticipant->designation = Input::get('designation');

                    $objectSpouseParticipant->barcode = Input::get('barcode2');
                    $objectSpouseParticipant->payment_status = Input::get('payment_status');
                    if (Input::get('payment_status') === '1') {
                        $objectSpouseParticipant->receipt_no = 'Spouse of ' . $objectParticipant->salutation . ' ' . $objectParticipant->first_name . ' ' . $objectParticipant->last_name . '';
                    }
                    if (Input::get('payment_status') === '2') {
                        $objectSpouseParticipant->remarks = 'Spouse of ' . $objectParticipant->salutation . ' ' . $objectParticipant->first_name . ' ' . $objectParticipant->last_name . '';
                    }
                    $objectSpouseParticipant->created_by = Auth::user()->id;
                    $objectSpouseParticipant->save();

                    if ($objectSpouseParticipant->id && empty($objectSpouseParticipant->barcode)) {
                        $spouseBarcode = self::generateParticipantBarcode($event_id, $objectSpouseParticipant->id);
                        $objectSpouseParticipant->barcode = $spouseBarcode;
                        $objectSpouseParticipant->save();
                    }
                }


//                if ($objectParticipant->payment_status == 0) {
//
//                    $receiverEmail = $objectParticipant->email;
//                    $subject = "Registration Confirmation";
//
//                    $content = 'Dear ' . $objectParticipant->salutation . ' ' . $objectParticipant->first_name . ' ' . $objectParticipant->last_name . '<br>This email acknowledges your registration for ' . $eventDetail->name . ' starting from ' . date("j F Y", strtotime($eventDetail->start_date)) . ' to ' . date("j F Y", strtotime($eventDetail->end_date)) . ' at ' . $eventDetail->location . '.<br> However your status is still "UNPAID", we request you to please contact any members of the registration committee or the names given below for the payment. Once you pay the amount as per the tariff, you will get another e-mail acknowledging your payment. <br>';
//                    $content .= '<p><b>Contact Person</b><br>CONFERENCE SECRETARIAT<br> National Conference of SIMON-2016<br>Dr Pankay Pant  Organizing Secretary,<br> SIMON <br>Mobile: 00977-9851110939<br>Email: drpant2015@gmail.com<br >
//<hr /> OFFICE SECRETARY<br/ > Mr. Arjun Bahadur Chand<br/ > Janakalyan Sadan, Babarmahal, <br> Kathmandu, Nepal<br> Mobile: 00977-9851206644<br> Email: simonnepal@gmail.com<br/ > Website: www.simon.org.np</p>';
//                    $email = Email::sendEmail($receiverEmail, $subject, $content);
//
//                } else {
//
//                    $receiverEmail = $objectParticipant->email;
//                    $subject = "Registration Payment Confirmation";
//
//                    $content = 'Dear ' . $objectParticipant->salutation . ' ' . $objectParticipant->first_name . ' ' . $objectParticipant->last_name . '<br><p>Thank you very much for the payment against the registration of ' . $eventDetail->name . '. We appreciate your support to us in our program.</p><p>This email acknowledges your registration and payment.  Please keep the receipt for future correspondence and you will be asked to show the receipt at the registration desk.</p><p>You will be entitled to enjoy the facilities of the conference including the lunch and dinner organized by SIMON. Please collect the name tag with bar code on it and the registration kit from the registration desk on the day of the conference.</p><p><u>It&#39;s our request to keep safe the name tag and do not forget to show it, when asked, while you are enjoying the facilities during the conference . </u ></p>';
//                    $email = Email::sendEmail($receiverEmail, $subject, $content);
//
//                }

                return redirect()->route('admin.event.participants', array($event_id, $event_slug))->withInput()->with('success', 'Participants Added Successful.');
            } else {
                return redirect()->back()->withInput();
            }
        }

    }

    public function deleteParticipant()
    {
        $rules = ['id' => 'required'];
        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails())
            return response()->json(['status' => false, 'message' => $validator->errors()->all()]);

        try {
            $objectParticipant = Participants::findOrFail(Input::get('id'))->delete();
            return response()->json(['status' => true, 'message' => 'Participant deleted successfully.']);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['status' => false, 'message' => 'Access denied.']);
        }
    }

    public function downloadParticipantTicket($id, $eventId)
    {
        $participant = Participants::where('id', $id)->where('event_id', $eventId)->first();

        $fontSize = 10;
        $marge = 10;   // between barcode and hri in pixel
        $x = 30;  // barcode center
        $y = 8;  // barcode center
        $height = 10;   // barcode height in 1D ; module size in 2D
        $width = 0.5;    // barcode height in 1D ; not use in 2D
        $angle = 0;   // rotation in degrees

        $code = $participant->barcode; // barcode, of course ;)

        $type = 'code128';
        $black = '000000'; // color in hexa

        $pdf = new eFPDF('L', 'mm', 'A4');
        $pdf->AddPage('L');

        $data = Barcode::fpdf($pdf, $black, $x, $y, $angle, $type, array('code' => $code), $width, $height);

        $pdf->SetFont('Arial', 'B', $fontSize);
        $pdf->SetTextColor(0, 0, 0);

        $len = $pdf->GetStringWidth($data['hri']);
        Barcode::rotate(-$len, ($data['height']) + $fontSize + $marge, $angle, $xt, $yt);

        $pdf->TextWithRotation(17, 17, $data['hri'], $angle);
        $pdf->SetFont('Arial', '', 12);

        $pdf->SetFont('Arial', 'B', 10);
        $pdf->TextWithRotation(10, 25, $participant->salutation . ' ' . $participant->first_name . ' ' . $participant->last_name, $angle);
        $pdf->Output($participant->first_name . '_' . $participant->last_name . '_' . $participant->barcode . '.pdf', 'D');

    }

    public function updateParticipantsBarcode()
    {
        $rules = ['id' => 'required'];
        $rules = ['barcode' => 'required'];
        // $rules = ['event_id' => 'required'];
        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'message' => $validator->errors()->all()]);
        }
        try {
            $objectParticipants = Participants::findOrFail(Input::get('id'));
            $objectBarcodeHistory = new BarcodeHistory();
            $objectBarcodeHistory->participant_id = $objectParticipants->id;
            $objectBarcodeHistory->event_id = $objectParticipants->event_id;
            $objectBarcodeHistory->barcode = $objectParticipants->barcode;
            $objectBarcodeHistory->added_by = Auth::user()->id;
            $objectBarcodeHistory->save();
            if ($objectBarcodeHistory->id) {
                $objectParticipants->barcode = Input::get('barcode');
                $objectParticipants->save();
                $message = 'Barcode updated successfully.';
            }
            return response()->json(['status' => true, 'message' => $message]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['status' => false, 'message' => 'Error: Oops. Something went wrong. Please try again later.']);
        }

    }

    public function downloadAllBarcode($eventId)
    {
        $participants = Participants::where('event_id', $eventId)->get();
//        $participants = Participants::where('event_id', $eventId)->where('payment_status', '!=', 0)->get();
        $pdf = new eFPDF('L', 'mm', 'A4');
        $pdf->setMargins('auto', 0, 'auto');
        // $pdf->AddPage();
        $pdf->addPage('L');
        $fontSize = 10;
        $marge = -10;   // between barcode and hri in pixel
        $x = 50;  // barcode center
        $y = 20;  // barcode center
        $height = 10;   // barcode height in 1D ; module size in 2D
        $width = 0.5;    // barcode height in 1D ; not use in 2D
        $angle = 0;   // rotation in degrees
        $type = 'code128';
        $black = '000000'; // color in hexa
        $pdf->SetFont('Arial', 'B', $fontSize);
        $pdf->SetTextColor(0, 0, 0);

        foreach ($participants as $participant) {
            $code = $participant->barcode; // barcode, of course ;)
            $data = Barcode::fpdf($pdf, $black, $x, $y, $angle, $type, array('code' => $code), $width, $height);
            $len = $pdf->GetStringWidth($data['hri']);
            Barcode::rotate(-$len, ($data['height']) + $fontSize + $marge, $angle, $xt, $yt);
            $pdf->TextWithRotation($x - 13, $y + 9, $data['hri'], $angle);
            $pdf->SetFont('Arial', '', 12);
            $pdf->SetFont('Arial', 'B', 10);
            $pdf->TextWithRotation($x - 20, $y + 17, $participant->salutation . ' ' . $participant->first_name . ' ' . $participant->last_name, $angle);
            $x += 60;
            if ($x >= 240) {
                $x = 50;
                $y += 32;
            }
            if ($y >= 190) {
//                $pdf->AddPage();
                $pdf->addPage('L');
                $x = 50;  // barcode center
                $y = 20;

            }
        }
        $pdf->Output('barcodes.pdf', 'D');
    }

    public function generateParticipantBarcode($eventId, $participantId)
    {
        $event = Events::find($eventId);
        $barcode = $event->event_type_id . '' . date("y", strtotime($event->start_date)) . '' . date("m", strtotime($event->start_date)) . '' . date("d", strtotime($event->start_date)) . '' . str_pad($participantId, 3, '0', STR_PAD_LEFT);
        return $barcode;
    }

    public function editPayment($eventId, $id)
    {
        $eventDetail = Events::find($eventId);
        $eventParticipantsType = EventRegistrationType::where('is_active', 1)->lists('name', 'id');
        $participant = Participants::with('event')->find($id);
        return view('events::admin.edit_participant_payment')->with(array('event' => $eventDetail, 'participant' => $participant, 'event_participants_type' => $eventParticipantsType->toArray()));

    }

    public function updatePayment($eventid, $id)
    {
        $rules = array(
            'payment_status' => 'required',
        );
        $messages = [
            'payment_status.required' => 'The Payment Status is required.',
        ];

        $validator = Validator::make(Input::all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {

            $eventDetail = Events::find($eventid);
            $objectParticipant = Participants::find($id);
            $objectParticipant->payment_status = Input::get('payment_status');
            if (Input::get('payment_status') === '1') {
                $objectParticipant->receipt_no = Input::get('receipt_no');
            }
            if (Input::get('payment_status') === '2') {
                $objectParticipant->remarks = Input::get('remarks');
            }
            $objectParticipant->updated_by = Auth::user()->id;
            $objectParticipant->save();

            if ($objectParticipant->id) {
                if (!empty($objectParticipant->email) && filter_var($objectParticipant->email, FILTER_VALIDATE_EMAIL)) {
                    if ($objectParticipant->payment_status == 1) {
                        // paid email

                        $receiverEmail = $objectParticipant->email;
                        $subject = "Registration Payment Confirmation";

                        $content = 'Dear ' . $objectParticipant->salutation . ' ' . $objectParticipant->first_name . ' ' . $objectParticipant->last_name . '<br><p>Thank you very much for the payment against the registration of ' . $eventDetail->name . '. We appreciate your support to us in our program.</p><p>This email acknowledges your registration and payment.  Please keep the receipt for future correspondence and you will be asked to show the receipt at the registration desk.</p><p>You will be entitled to enjoy the facilities of the conference including the lunch and dinner organized by SIMON. Please collect the name tag with bar code on it and the registration kit from the registration desk on the day of the conference.</p>
                    <p><b><u>It&#39;s our request to keep safe the name tag and do not forget to show it, when asked, while you are enjoying the facilities during the conference . </u ></b ></p>';
                        $email = Email::sendEmail($receiverEmail, $subject, $content);

                    }
                    if ($objectParticipant->payment_status == 2) {
                        // credit email

                        $receiverEmail = $objectParticipant->email;
                        $subject = "Registration Payment Confirmation";

                        $content = 'Dear ' . $objectParticipant->salutation . ' ' . $objectParticipant->first_name . ' ' . $objectParticipant->last_name . '<br><p>Thank you very much for the payment against the registration of ' . $eventDetail->name . '. We appreciate your support to us in our program.</p><p>This email acknowledges your registration and payment.  Please keep the receipt for future correspondence and you will be asked to show the receipt at the registration desk.</p><p>You will be entitled to enjoy the facilities of the conference including the lunch and dinner organized by SIMON. Please collect the name tag with bar code on it and the registration kit from the registration desk on the day of the conference.</p><p><u>It&#39;s our request to keep safe the name tag and do not forget to show it, when asked, while you are enjoying the facilities during the conference . </u ></p>';
                        $email = Email::sendEmail($receiverEmail, $subject, $content);

                    }
                }

                return redirect()->route('admin.event.participants', array($eventDetail->id, $eventDetail->slug))->withInput()->with('success', 'Payment updated Successful.');

            } else {
                return redirect()->back()->withInput();
            }
        }

    }

    public function getEventParticipantsAttendance($eventId)
    {
        $event = Events::findOrFail($eventId);

        $startDate = new DateTime($event->start_date . '01:00 ');
        $endDate = new DateTime($event->end_date . '24:00 ');

        $interval = DateInterval::createFromDateString('1 day');
        $period = new DatePeriod($startDate, $interval, $endDate);
        $attendanceData = '';

        foreach ($period as $dt) {
            $totalAttendance = '0';
            $totalLunch = '0';
            $totalDinner = '0';
            $participants = Participants::with(['attendance' => function ($query) use ($dt, $eventId) {
                    $query->whereDate('date', '=', $dt->format("Y-m-d"));
                }, 'lunch' => function ($query1) use ($dt, $eventId) {
                    $query1->whereDate('date', '=', $dt->format("Y-m-d"));
                }, 'dinner' => function ($query2) use ($dt, $eventId) {
                    $query2->whereDate('date', '=', $dt->format("Y-m-d"));
                }]
            )->where('event_id', $eventId)->get();


            $single = '<div class="card-header"><h2>' . $dt->format("Y-m-d") . ' Attendence</h2></div><table class="table table-striped"><tr><th>S. No.</th><th>Participants</th><th>Attendence</th><th>Lunch</th><th>Dinner</th></tr>';
            foreach ($participants as $index => $participant) {
                $index = $index + 1;
                $single .= '<tr>';
                $single .= '<td>' . $index . '</td>';
                $single .= '<td>' . $participant->salutation . ' ' . $participant->first_name . ' ' . $participant->last_name . '</td>';
                if (isset($participant->attendance->time)) {
                    $totalAttendance = $totalAttendance + 1;
                    $single .= '<td><i class="zmdi zmdi-check zmdi-hc-fw"></i></td>';
                } else {
                    $single .= '<td><i class="zmdi zmdi-close zmdi-hc-fw"></i></td>';
                }

                if (isset($participant->lunch->time)) {
                    $totalLunch = $totalLunch + 1;
                    $single .= '<td><i class="zmdi zmdi-check zmdi-hc-fw"></i></td>';
                } else {
                    $single .= '<td><i class="zmdi zmdi-close zmdi-hc-fw"></i></td>';
                }

                if (isset($participant->dinner->time)) {
                    $totalDinner = $totalDinner + 1;
                    $single .= '<td><i class="zmdi zmdi-check zmdi-hc-fw"></i></td>';
                } else {
                    $single .= '<td><i class="zmdi zmdi-close zmdi-hc-fw"></i></td>';
                }

                $single .= '</tr>';
            }

            $single .= '<tr><td colspan="2" align="right"><strong>Total</strong></td><td>' . $totalAttendance . '</td><td>' . $totalLunch . '</td><td>' . $totalDinner . '</td> </tr>';
            $single .= ' </table><hr />';
            $attendanceData .= $single;

        }


        return view('events::admin.participants_attendance')->with(array('event' => $event, 'attendance' => $attendanceData));
    }

    public function downloadAllParticipants($eventId)
    {
        $participants = Participants::with('eventRegistrationType')->where('event_id', $eventId)->get();
//        $participants = Participants::with('eventRegistrationType')->where('event_id', $eventId)->where('payment_status', '!=', 0)->get();
        $event = Events::find($eventId);

        Excel::create($event->name . '-' . date('m-d-Y', time()), function ($excel) use ($participants, $event) {

            $excel->sheet('Excel sheet', function ($sheet) use ($participants, $event) {
                // first row styling and writing content
                $sheet->loadView('events::admin.participants_excel')->with('participants', $participants)
                    ->with('event', $event);
                $sheet->setOrientation('landscape');
            });

        })->export('xls');


    }

    public function downloadUnAssignedBarcode($eventId)
    {
        $event = Events::find($eventId);
        $pdf = new eFPDF('L', 'mm', 'A4');
        $pdf->setMargins('auto', 0, 'auto');
        $pdf->addPage('L');
        $fontSize = 10;
        $marge = -10;   // between barcode and hri in pixel
        $x = 50;  // barcode center
        $y = 20;  // barcode center
        $height = 10;   // barcode height in 1D ; module size in 2D
        $width = 0.5;    // barcode height in 1D ; not use in 2D
        $angle = 0;   // rotation in degrees
        $type = 'code128';
        $black = '000000'; // color in hexa
        $pdf->SetFont('Arial', 'B', $fontSize);
        $pdf->SetTextColor(0, 0, 0);

        for ($i = 800; $i < 901; $i++) {
            $code = $event->event_type_id . '' . date("y", strtotime($event->start_date)) . '' . date("m", strtotime($event->start_date)) . '' . date("d", strtotime($event->start_date)) . '' . str_pad($i, 3, '0', STR_PAD_LEFT);
            $data = Barcode::fpdf($pdf, $black, $x, $y, $angle, $type, array('code' => $code), $width, $height);
            $len = $pdf->GetStringWidth($data['hri']);
            Barcode::rotate(-$len, ($data['height']) + $fontSize + $marge, $angle, $xt, $yt);
            $pdf->TextWithRotation($x - 13, $y + 9, $data['hri'], $angle);
            $pdf->SetFont('Arial', '', 12);
            $pdf->SetFont('Arial', 'B', 10);
            $pdf->TextWithRotation($x - 20, $y + 17, '.................................', $angle);
            $x += 60;
            if ($x >= 240) {
                $x = 50;
                $y += 32;
            }
            if ($y >= 190) {
//                $pdf->AddPage();
                $pdf->addPage('L');
                $x = 50;  // barcode center
                $y = 20;

            }

        }

        $pdf->Output('un-assigned_barcode_' . date('Y-m-d') . '.pdf', 'D');

    }

}