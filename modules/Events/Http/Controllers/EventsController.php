<?php namespace Modules\Events\Http\Controllers;

use App\Classes\Email;
use Input;
use Modules\Events\Entities\Events;
use Modules\Events\Entities\EventType;
use Modules\Events\Entities\EventsContent;
use Modules\Events\Entities\Participants;
use Pingpong\Modules\Routing\Controller;
use Validator;
use Illuminate\Http\Request;

class EventsController extends Controller
{
    public function index()
    {
        return view('events::index');
    }

    public function getDetail($id, $slug)
    {
        $event = Events::with(array('photo', 'eventType',
        'contents' => function($query) {
            $query->orderBy('display_order', 'ASC');
        })

        )->where('id', $id)->where('slug', $slug)->first();
        return view('events::event_detail')->with(array('event' => $event));
    }

    public function register($id, $slug)
    {
        $event = Events::with(array('photo', 'eventType',
            'contents' => function($query) {
                $query->orderBy('display_order', 'ASC');
            }))->where('id', $id)->where('slug', $slug)->first();
        return view('events::event_registration')->with(array('event' => $event));
    }

    public function postRegistration($id, $slug)
    {
        $eventDetail = Events::find($id);
        // $ParticipantsCheck = Participants::where('event_id', $id)->where('email', Input::get('email'))->get();
        // if (count($ParticipantsCheck) > 0) {
        //     return redirect()->back()->withInput()->with('error', 'This email has already been register to this event. Please try with different email.');
        // }
        $rules = array(
            'first_name' => 'required',
            'last_name' => 'required',
            'address' => 'required',
            'mobile_no' => 'required|numeric',
            'email' => 'required|email',
            'organization' => 'required',
            'designation' => 'required',
        );
        $messages = [
            'first_name.required' => 'The First name is required.',
            'last_name.required' => 'The Last name is required.',
            'address.required' => 'The address is required.',
            'mobile_no.required' => 'The mobile is required.',
            'email.required' => 'The email is required.',
            'email.email' => 'Please enter the valid email address.',
            'organization.required' => 'The organization is required.',
            'designation.required' => 'The designation is required.',
        ];

        $validator = Validator::make(Input::all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {

            $ObjectParticipants = new Participants();
            $ObjectParticipants->event_id = $id;
            $ObjectParticipants->event_registration_type = Input::get('member_type');
            $ObjectParticipants->registration_via = '1';
            $ObjectParticipants->salutation = Input::get('salutation');
            $ObjectParticipants->first_name = Input::get('first_name');
            $ObjectParticipants->middle_name = Input::get('middle_name');
            $ObjectParticipants->last_name = Input::get('last_name');
            $ObjectParticipants->address = Input::get('address');
            $ObjectParticipants->mobile_no = Input::get('mobile_no');
            $ObjectParticipants->email = Input::get('email');
            $ObjectParticipants->organization = Input::get('organization');
            $ObjectParticipants->designation = Input::get('designation');
            // if (Input::get('member_type') == 3) {
            //     $ObjectParticipants->spouse_name = Input::get('mem_spouse_name');
            // }
            // if (Input::get('member_type') == 4) {
            //     $ObjectParticipants->spouse_name = Input::get('nonmem_spouse_name');
            // }
            if(Input::get('has_accompanying_person') == 1){
                $ObjectParticipants->spouse_name = Input::get('accompanying_name');
            }
            // $ObjectParticipants->spouse_name = Input::get('accompanying_name');
            $ObjectParticipants->has_workshop_registration = Input::get('has_workshop_registration');
            $ObjectParticipants->workshop_type = Input::get('workshop_type');
            $ObjectParticipants->save();
            if ($ObjectParticipants->id) {

                $participantBarcode = self::generateParticipantBarcode($eventDetail->id, $ObjectParticipants->id);

                $ObjectParticipants->barcode = $participantBarcode;
                $ObjectParticipants->save();

                $receiverEmail = $ObjectParticipants->email;
                $subject = "Registration Confirmation";

                $content = 'Dear ' . $ObjectParticipants->salutation . ' ' . $ObjectParticipants->first_name . ' ' . $ObjectParticipants->last_name . '<br>This email acknowledges your registration for ' . $eventDetail->name . ' starting from ' . date("j F Y", strtotime($eventDetail->start_date)) . ' to ' . date("j F Y", strtotime($eventDetail->end_date)) . ' at ' . $eventDetail->location . '.<br> However your status is still "UNPAID", we request you to please contact any members of the registration committee or the names given below for the payment. Once you pay the amount as per the tariff, you will get another e-mail acknowledging your payment. <br>';
                $content .= '<p><b>Contact Person</b><br>CONFERENCE SECRETARIAT<br> National Conference of SIMON-2016<br>Dr Pankay Pant  Organizing Secretary,<br> SIMON <br>Mobile: 00977-9851110939<br>Email: drpant2015@gmail.com<br >
<hr /> OFFICE SECRETARY<br/ > Mr. Arjun Bahadur Chand<br/ > Janakalyan Sadan, Babarmahal, <br> Kathmandu, Nepal<br> Mobile: 00977-9851206644<br> Email: simonnepal@gmail.com<br/ > Website: www.simon.org.np</p>';
                $email = Email::sendEmail($receiverEmail, $subject, $content);

                return redirect()->route('event.detail', array($id, $slug))->withInput()->with('success', '<p>Dear <strong>' . Input::get('salutation') . ' ' . Input::get('first_name') . ' ' . Input::get('last_name') . '</strong>, <br/> <br/> Your registration for NationalConference Of Simon has been submitted successfully.<br/><br/>We will get in touch with you very soon.</p>');
            } else {
                return redirect()->back()->withInput();
            }


        }

    }

    public function getEventContent($id, $slug, $eventSlug)
    {
        $event = Events::with(array('photo', 'eventType',
            'contents' => function($query) {
                $query->orderBy('display_order', 'ASC');
            }))->find($id);
        $content = EventsContent::findBySlug($eventSlug);
        return view('events::event_content_detail')->with(array('event' => $event, 'content' => $content));
    }

    public function generateParticipantBarcode($eventId, $participantId)
    {
        $event = Events::find($eventId);
        $barcode = $event->event_type_id . '' . date("y", strtotime($event->start_date)) . '' . date("m", strtotime($event->start_date)) . '' . date("d", strtotime($event->start_date)) . '' . str_pad($participantId, 3, '0', STR_PAD_LEFT);
        return $barcode;
    }

    public function getEventBySlug($slug)
    {
        $paginate = 3;
        $eventType = EventType::where('slug',$slug)->first();
        $events = Events::with(array('photo', 'eventType',
            'contents' => function($query) {
                $query->orderBy('display_order', 'ASC');
            }))->where('event_type_id',$eventType->id)->where('is_active',1)->orderBy('start_date', 'desc') ->paginate($paginate);
        $events->setPath('');
        return view('events::event_types_listing')->with(array('eventType'=>$eventType,'events'=>$events));

    }

}