<?php namespace Modules\Downloads\Http\Controllers\Admin;

use Pingpong\Modules\Routing\Controller;
use Modules\Downloads\Entities\Downloads;
use Modules\Downloads\Entities\DownloadCategory;
use Modules\Events\Entities\Events;
use Validator;
use Auth;
Use Input;

class DownloadsController extends Controller {
	
	public function getFiles()
	{
        $paginate = 10;
        $files = Downloads::where('download_type','File')->paginate($paginate);
        $files->setPath('');
        $categories = DownloadCategory::lists('name', 'id');
        return view('downloads::admin.file_list')->with(array('files' => $files,'categories'=>$categories->toArray()));

	}

	public function getVideos()
	{
        $paginate = 10;
        $videos = Downloads::where('download_type','Video')->paginate($paginate);
        $videos->setPath('');
        $categories = DownloadCategory::lists('name', 'id');
        return view('downloads::admin.video_list')->with(array('videos' => $videos,'categories'=>$categories->toArray()));

	}

    public function addFile()
    {
        $events = Events::where('is_active', 1)->lists('name', 'id');
        $categories = DownloadCategory::where('is_active', 1)->lists('name', 'id');
        return view('downloads::admin.add_file')->with(array('event_select'=>$events->toArray(),'category_select'=>$categories->toArray()));

    }

    public function addVideo()
    {
        $events = Events::where('is_active', 1)->lists('name', 'id');
        $categories = DownloadCategory::where('is_active', 1)->lists('name', 'id');
        return view('downloads::admin.add_video')->with(array('event_select'=>$events->toArray(),'category_select'=>$categories->toArray()));

    }

    public function createFile()
    {
        $rules = array(
            'name' => 'required',
            'access_type' => 'required',
            'file' => 'required',

        );
        $messages = [
            'name.required' => 'The name is required.',
            'access_type.required' => 'The access type is required.',
            'file.required' => 'The download file is required.',
        ];

        $validator = Validator::make(Input::all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {

            $objectFile = new Downloads();
            $objectFile->event_id = Input::get('event_id');
            $objectFile->categories = implode(", ", (array)Input::get('categories'));
            $objectFile->download_type = "File";
            $objectFile->access_type = Input::get('access_type');
            $objectFile->name = Input::get('name');
            $objectFile->description = Input::get('description');
            $objectFile->is_active = Input::get('is_active');

            if (Input::file('file')) {
                $destinationPath = 'uploads/downloads';
                $extension = Input::file('file')->getClientOriginalExtension();
                $fileName = 'file_' . str_random(20) . '.' . $extension;
                Input::file('file')->move($destinationPath, $fileName);
                $objectFile->download = $fileName;
            }
            $objectFile->save();
            return redirect()->route('admin.download.file.index')->withInput()->with('success', 'File created successfully.');
        }

    }

    public function createVideo()
    {
        $rules = array(
            'name' => 'required',
            'access_type' => 'required',
            'video_url' => 'required|url',

        );
        $messages = [
            'name.required' => 'The name is required.',
            'access_type.required' => 'The access type is required.',
            'video_url.required' => 'The Video Url is required.',
            'video_url.url' => 'The Video Url is not valid.',
        ];

        $validator = Validator::make(Input::all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {

            $objectFile = new Downloads();
            $objectFile->event_id = Input::get('event_id');
            $objectFile->download_type = "Video";
            $objectFile->access_type = Input::get('access_type');
            $objectFile->name = Input::get('name');
            $objectFile->is_active = Input::get('is_active');
            $objectFile->download = Input::get('video_url');
            $objectFile->categories = implode(", ", (array)Input::get('categories'));
            $objectFile->description = Input::get('description');
            $objectFile->save();
            return redirect()->route('admin.download.video.index')->withInput()->with('success', 'Download created successfully.');
        }

    }

    public function editFile($id)
    {
        $events = Events::where('is_active', 1)->lists('name', 'id');
        $categories = DownloadCategory::where('is_active', 1)->lists('name', 'id');
        $file=Downloads::findOrFail($id);
        return view('downloads::admin.file_edit')->with(array('file'=>$file, 'event_select'=>$events->toArray(),'category_select'=>$categories->toArray()));

    }

    public function editVideo($id)
    {
        $events = Events::where('is_active', 1)->lists('name', 'id');
        $file=Downloads::findOrFail($id);
        $categories = DownloadCategory::where('is_active', 1)->lists('name', 'id');
        return view('downloads::admin.video_edit')->with(array('file'=>$file, 'event_select'=>$events->toArray(),'category_select'=>$categories->toArray()));

    }

    public function updateFile($id)
    {
        $updateInfo=Downloads::findOrFail($id);
        $rules = array(
            'name' => 'required',
            'access_type' => 'required'
        );
        $messages = [
            'name.required' => 'The name is required.',
            'access_type.required' => 'The access type is required.',
        ];

        $validator = Validator::make(Input::all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {

            $objectFile = Downloads::find($id);
            $objectFile->event_id = Input::get('event_id');
            $objectFile->access_type = Input::get('access_type');
            $objectFile->name = Input::get('name');
            $objectFile->is_active = Input::get('is_active');
            $objectFile->categories = implode(", ", (array)Input::get('categories'));
            $objectFile->description = Input::get('description');
            if (Input::file('file')) {
                $destinationPath = 'uploads/downloads';
                $extension = Input::file('file')->getClientOriginalExtension();
                $fileName = 'file_' . str_random(20) . '.' . $extension;
                Input::file('file')->move($destinationPath, $fileName);
                $objectFile->download = $fileName;
            }
            $objectFile->save();
            return redirect()->route('admin.download.file.index')->withInput()->with('success', 'File updated successfully.');
        }

    }

    public function updateVideo($id)
    {
        $updateInfo=Downloads::findOrFail($id);
        $rules = array(
            'name' => 'required',
            'access_type' => 'required'
        );
        $messages = [
            'name.required' => 'The name is required.',
            'access_type.required' => 'The access type is required.',
        ];

        $validator = Validator::make(Input::all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {

            $objectFile = Downloads::find($id);
            $objectFile->event_id = Input::get('event_id');
            $objectFile->access_type = Input::get('access_type');
            $objectFile->name = Input::get('name');
            $objectFile->is_active = Input::get('is_active');
            $objectFile->download = Input::get('video_url');
            $objectFile->categories = implode(", ", (array)Input::get('categories'));
            $objectFile->description = Input::get('description');
            $objectFile->save();
            return redirect()->route('admin.download.video.index')->withInput()->with('success', 'Video updated successfully.');
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
            $objectDownloads = Downloads::findOrFail(Input::get('id'));
            if ($objectDownloads->is_active == 1) {
                $objectDownloads->is_active = 0;
                $message = 'Downloads unpublished successfully.';
            } else {
                $objectDownloads->is_active = 1;
                $message = 'Downloads published successfully.';
            }
            $objectDownloads->save();

            return response()->json(['status' => true, 'message' => $message, 'is_active' => $objectDownloads->is_active]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['status' => false, 'message' => 'Oops something went wrong.']);
        }
    }

    public function delete()
    {
        $rules = ['id' => 'required'];
        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails())
            return response()->json(['status' => false, 'message' => $validator->errors()->all()]);

        try {
            Downloads::findOrFail(Input::get('id'))->delete();
            return response()->json(['status' => true, 'message' => 'File deleted successfully.']);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['status' => false, 'message' => 'Access denied.']);
        }
    }
	
}