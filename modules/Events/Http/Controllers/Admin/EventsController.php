<?php namespace Modules\Events\Http\Controllers\Admin;

use Pingpong\Modules\Routing\Controller;

use Modules\Events\Entities\Events;
use Modules\Events\Entities\EventType;
use Modules\Events\Entities\EventsContent;
use Input;
use Validator;
use Auth;

class EventsController extends Controller
{

    public function index()
    {
        $paginate = 10;
        $events = Events::with('eventType')->paginate($paginate);
        $events->setPath('');
        return view('events::admin.index')->with(array('events' => $events));
    }

    public function add()
    {
        $eventType = EventType::where('is_active', 1)->lists('name', 'id');
        return view('events::admin.add')->with(array('event_type' => $eventType->toArray()));
    }

    public function create()
    {
        $rules = array(
            'name' => 'required',
            'event_type_id' => 'required',
            'slogan' => 'required',
            'location' => 'required',
            'start_date' => 'required|date',
            'start_time' => 'required|',
            'end_date' => 'required|after:arrival_date',
            'end_time' => 'required',
            'description' => 'required',
        );
        $messages = [
            'name.required' => 'The Event name is required.',
            'event_type_id.required' => 'The Event type is required.',
            'slogan.required' => 'The Slogan is required.',
            'location.required' => 'The location is required.',
            'start_date.required' => 'The start date is required.',
            'start_date.date' => 'Please enter the valid start date.',
            'end_date.required' => 'End date is required.',
            'end_date.date' => 'Please enter the valid end date.',
            'end_date.after' => 'The end date must be greater than start date.',
            'description.required' => 'Description is required.',
        ];

        $validator = Validator::make(Input::all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            $objectEvent = new Events();
            $objectEvent->event_type_id = Input::get('event_type_id');
            $objectEvent->name = Input::get('name');
            $objectEvent->slogan = Input::get('slogan');
            $objectEvent->location = Input::get('location');
            $objectEvent->longitude = Input::get('longitude');
            $objectEvent->latitude = Input::get('latitude');
            $objectEvent->start_date = Input::get('start_date');
            $objectEvent->end_date = Input::get('end_date');
            $objectEvent->start_time = Input::get('start_time');
            $objectEvent->end_time = Input::get('end_time');
            $objectEvent->book_online = Input::get('book_online');
            $objectEvent->registration_start_date = Input::get('registration_start_date');
            $objectEvent->registration_end_date = Input::get('registration_end_date');
            $objectEvent->no_of_participants = Input::get('no_of_participants');
            $objectEvent->description = Input::get('description');
            $objectEvent->is_active = Input::get('is_active');
            $objectEvent->created_by = Auth::user()->id;
            $objectEvent->save();
            if ($objectEvent->id) {
                if (Input::file('banner')) {
                    $destinationPath = 'uploads/media'; // upload path
                    $extension = Input::file('banner')->getClientOriginalExtension(); // getting image extension
                    $fileName = 'banner_' . str_random(20) . '.' . $extension; // renameing image
                    Input::file('banner')->move($destinationPath, $fileName); // uploading file to given path


                }

                return redirect()->route('admin.event.index')->withInput()->with('success', 'Event added successfully.');
            } else {
                return redirect()->back()->withInput();
            }
        }
    }

    public function edit($id)
    {
        $eventType = EventType::where('is_active', 1)->lists('name', 'id');
        $event = Events::FindOrFail($id);
        return view('events::admin.edit_event')->with(array('event' => $event, 'event_type' => $eventType->toArray()));
    }

    public function update($id)
    {
        $rules = array(
            'name' => 'required',
            'event_type_id' => 'required',
            'slogan' => 'required',
            'location' => 'required',
            'start_date' => 'required|date',
            'start_time' => 'required',
            'end_date' => 'required|after:arrival_date',
            'end_time' => 'required',
            'description' => 'required',
        );
        $messages = [
            'name.required' => 'The Event name is required.',
            'event_type_id.required' => 'The Event type is required.',
            'slogan.required' => 'The Slogan is required.',
            'location.required' => 'The location is required.',
            'start_date.required' => 'The start date is required.',
            'start_date.date' => 'Please enter the valid start date.',
            'end_date.required' => 'End date is required.',
            'end_date.date' => 'Please enter the valid end date.',
            'end_date.after' => 'The end date must be greater than start date.',
            'description.required' => 'Description is required.',
        ];

        $validator = Validator::make(Input::all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            $objectEvent = Events::find($id);

            $objectEvent->event_type_id = Input::get('event_type_id');
            $objectEvent->name = Input::get('name');
            $objectEvent->slogan = Input::get('slogan');
            $objectEvent->location = Input::get('location');
            $objectEvent->longitude = Input::get('longitude');
            $objectEvent->latitude = Input::get('latitude');
            $objectEvent->start_date = Input::get('start_date');
            $objectEvent->end_date = Input::get('end_date');
            $objectEvent->start_time = date("H:i", strtotime(Input::get('start_time')));
            $objectEvent->end_time = date("H:i", strtotime(Input::get('end_time')));
            $objectEvent->book_online = Input::get('book_online');
            $objectEvent->registration_start_date = Input::get('registration_start_date');
            $objectEvent->registration_end_date = Input::get('registration_end_date');
            $objectEvent->no_of_participants = Input::get('no_of_participants');
            $objectEvent->description = Input::get('description');
            $objectEvent->is_active = Input::get('is_active');
            $objectEvent->updated_by = Auth::user()->id;
            $objectEvent->save();
            if ($objectEvent->id) {
                if (Input::file('banner')) {
                    $destinationPath = 'uploads/media'; // upload path
                    $extension = Input::file('banner')->getClientOriginalExtension(); // getting image extension
                    $fileName = 'banner_' . str_random(20) . '.' . $extension; // renameing image
                    Input::file('banner')->move($destinationPath, $fileName); // uploading file to given path

                    if ($objectEvent->photo) {
                        $photo = $objectEvent->photo()->update(
                            array(
                                'caption' => Input::get('name'),
                                'file_name' => $fileName,
                                'updated_by' => Auth::user()->id,
                            )
                        );

                    } else {
                        $photo = $objectEvent->photo()->create(
                            array(
                                'type_id' => '1',
                                'caption' => Input::get('name'),
                                'file_name' => $fileName,
                                'created_by' => Auth::user()->id,
                            )
                        );

                    }

                }

                return redirect()->route('admin.event.index')->withInput()->with('success', 'Event Updated successfully.');
            } else {
                return redirect()->back()->withInput();
            }
        }

    }

    public function changeStatus()
    {
        $rules = ['id' => 'required'];
        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'message' => $validator->errors()->all()]);
        }

        try {
            $objectEvent = Events::findOrFail(Input::get('id'));
            if ($objectEvent->is_active == 1) {
                $objectEvent->is_active = 0;
                $message = 'Event unpublished successfully.';
            } else {
                $objectEvent->is_active = 1;
                $message = 'Event published successfully.';
            }
            $objectEvent->save();

            return response()->json(['status' => true, 'message' => $message, 'is_active' => $objectEvent->is_active]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['status' => false, 'message' => Input::get('id')]);
        }
    }

    public function delete()
    {
        $rules = ['id' => 'required'];
        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails())
            return response()->json(['status' => false, 'message' => $validator->errors()->all()]);

        try {
            $objectEvent = Events::findOrFail(Input::get('id'))->delete();
            return response()->json(['status' => true, 'message' => 'Event deleted successfully.']);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['status' => false, 'message' => 'Access denied.']);
        }
    }

    public function getEventContent($id)
    {
        $event = Events::with('contents')->find($id);
        return view('events::admin.content')->with(array('event' => $event));
    }

    public function contentAdd($id)
    {
        $event = Events::find($id);
        return view('events::admin.content_add')->with(array('event' => $event));

    }

    public function contentCreate($id)
    {

        $rules = array(
            'title' => 'required',
            'description' => 'required',
        );
        $messages = [
            'title.required' => 'Title is required.',
            'description.required' => 'Description is required.',
        ];

        $validator = Validator::make(Input::all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            $objectEventContent = new EventsContent();
            $objectEventContent->event_id = $id;
            $objectEventContent->title = Input::get('title');
            $objectEventContent->display_order = Input::get('display_order');
            $objectEventContent->description = Input::get('description');
            $objectEventContent->is_active = Input::get('is_active');
            $objectEventContent->added_by = Auth::user()->id;
            $objectEventContent->save();
            if ($objectEventContent->id) {
                return redirect()->route('admin.event.content.index', $id)->withInput()->with('success', 'Event Content added successfully.');
            } else {
                return redirect()->back()->withInput();
            }
        }

    }

    public function editContent($id, $contentId)
    {
        $event = Events::find($id);
        $content = EventsContent::find($contentId);
        return view('events::admin.edit_event_content')->with(array('event' => $event, 'content' => $content));
    }

    public function updateContent($id, $contentId)
    {
        $rules = array(
            'title' => 'required',
            'description' => 'required',
        );
        $messages = [
            'title.required' => 'The Title is required.',
            'description.required' => 'The description is required.',
        ];

        $validator = Validator::make(Input::all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            $objectEventContent = EventsContent::where('event_id', $id)->where('id', $contentId)->first();

            $objectEventContent->title = Input::get('title');
            $objectEventContent->display_order = Input::get('display_order');
            $objectEventContent->description = Input::get('description');
            $objectEventContent->is_active = Input::get('is_active');
            $objectEventContent->updated_by = Auth::user()->id;
            $objectEventContent->save();
            if ($objectEventContent->id) {
                return redirect()->route('admin.event.content.index', $id)->withInput()->with('success', 'Event Content Updated successfully.');
            } else {
                return redirect()->back()->withInput();
            }
        }

    }

    public function ContentChangeStatus()
    {
        $rules = ['id' => 'required'];
        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'message' => $validator->errors()->all()]);
        }

        try {
            $objectEventContent = EventsContent::findOrFail(Input::get('id'));
            if ($objectEventContent->is_active == 1) {
                $objectEventContent->is_active = 0;
                $message = 'Event Content unpublished successfully.';
            } else {
                $objectEventContent->is_active = 1;
                $message = 'Event Content published successfully.';
            }
            $objectEventContent->save();

            return response()->json(['status' => true, 'message' => $message, 'is_active' => $objectEventContent->is_active]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['status' => false, 'message' => Input::get('id')]);
        }

    }

    public function deleteEventContent()
    {
        $rules = ['id' => 'required'];
        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails())
            return response()->json(['status' => false, 'message' => $validator->errors()->all()]);

        try {
            EventsContent::findOrFail(Input::get('id'))->delete();
            return response()->json(['status' => true, 'message' => 'Event Content deleted successfully.']);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['status' => false, 'message' => 'Access denied.']);
        }
    }

}