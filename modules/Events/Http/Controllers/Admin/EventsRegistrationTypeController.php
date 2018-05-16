<?php namespace Modules\Events\Http\Controllers\Admin;

use Auth;
use Input;
use Validator;
use Modules\Events\Entities\Events;
use Pingpong\Modules\Routing\Controller;
use Modules\Events\Entities\EventRegistrationType;
use Modules\Events\Entities\EventRegistrationTypeFacility;
use Modules\Events\Entities\EventFacilityPermission;

class EventsRegistrationTypeController extends Controller
{

    public function index($eventId)
    {
        $eventInfo = Events::find($eventId);
        $paginate = 50;
        //$registrationType = EventRegistrationType::with('')->paginate($paginate);
        $registrationType = EventRegistrationType::paginate($paginate);
        $registrationType->setPath('');
        return view('events::admin.event_registration_type')->with(array('registrationTypes' => $registrationType, 'eventInfo' => $eventInfo));
    }


    public function registerTypePermission($eventId, $typeId)
    {
        $eventInfo = Events::find($eventId);
        $eventRegistrationType = EventRegistrationType::find($typeId);
        $registrationFacilities = EventRegistrationTypeFacility::where('event_id', $eventId)->get();
        return view('events::admin.event_registration_type_permission')->with(array('eventInfo' => $eventInfo, 'eventRegistrationType' => $eventRegistrationType, 'registrationFacilities' => $registrationFacilities));

    }

    public function changePermission()
    {
        $rules = ['facility_id' => 'required'];
        $rules = ['date' => 'required'];
        $rules = ['event_id' => 'required'];
        $rules = ['registration_type_id' => 'required'];
        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails())
            return response()->json(['status' => false, 'message' => $validator->errors()->all()]);

        try {

            $objectPermission = EventFacilityPermission::where('event_id', Input::get('event_id'))->where('registration_type_id', Input::get('registration_type_id'))->whereDate('date', '=', Input::get('date'))->where('facility_id',Input::get('facility_id'))->first();

            if (count($objectPermission) == 0) {
                $objectFacilityPermission = new EventFacilityPermission();
                $objectFacilityPermission->event_id= Input::get('event_id');
                $objectFacilityPermission->registration_type_id= Input::get('registration_type_id');
                $objectFacilityPermission->facility_id= Input::get('facility_id');
                $objectFacilityPermission->date= Input::get('date');
                $objectFacilityPermission->permission= '1';
                $objectFacilityPermission->created_by= Auth::user()->id;
                $objectFacilityPermission->save();
                $message = Input::get('permission_type').' Permission Added on '.Input::get('date').'.';

            } else {

                if ($objectPermission->permission == 1) {
                    $objectPermission->permission = 0;
                    $message = Input::get('permission_type').' Permission Removed on '.Input::get('date').'.';
                } else {
                    $objectPermission->permission = 1;
                    $message = Input::get('permission_type').' Permission Added on '.Input::get('date').'.';
                }

                $objectPermission->updated_by = Auth::user()->id;
                $objectPermission->save();

            }
            return response()->json(['status' => true, 'message' => $message]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['status' => false, 'message' => 'Ooops somthing went wrong.']);
        }
    }
}