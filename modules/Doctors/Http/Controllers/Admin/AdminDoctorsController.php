<?php namespace Modules\Doctors\Http\Controllers\Admin;

use PhpParser\Comment\Doc;
use Pingpong\Modules\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Input;
use Session;
use Redirect;
use Image;

use App\Doctors;
use App\Timetable;
use App\Specializations;

class AdminDoctorsController extends Controller {
	
	public function index()
	{
		$data['doctors'] = Doctors::paginate(10);
        foreach($data['doctors'] as $doc){
            $doc->specialization_name = Specializations::where('id', $doc->specialization_id)->pluck('title');
        }
		return view('doctors::admin.v_doctors',$data);
	}

	public function add(){
        $data['spec'] = Specializations::where('status',1)->select('id','title')->get();
		return view('doctors::admin.v_add_doctor',$data);
	}

	public function addSubmit(Request $request){
		$this->validate($request, ['full_name' => 'required',
										'specialization_id' => 'required',
										'description' => 'required',
										'image' => 'mimes:jpg,jpeg,bmp,png'
										]);

		$doctor = new Doctors;

		$doctor->full_name = Input::get('full_name');
        $doctor->slug = str_slug(Input::get('first_name'));
		$doctor->specialization_id = Input::get('specialization_id');
		$doctor->contact = Input::get('contact');
		$doctor->address = Input::get('address');
		$doctor->description = Input::get('description');
		
		if(Input::file('image') != ""){
			$file = Input::file('image');
			$file_name = time()."_".$file->getClientOriginalName();
			$file_path = 'uploads/doctors/';
			if($file->move($file_path,$file_name)){
			    $cropped_image = self::resize_crop_image(600,480, $file_path.$file_name, $file_path."cropped_".$file_name);
				$doctor->image = "cropped_".$file_name;
			}
		}

		$doctor->status = Input::get('status');

		if($doctor->save())
			Session::flash('success', 'Doctor has been successfully added.');
		else
			Session::flash('success', 'Something went wrong.');

		return redirect('admin/doctors');

	}

	public function changeStatus()
    {
        $rules = ['id' => 'required'];
        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'message' => $validator->errors()->all()]);
        }

        try {
            $objectContent = Doctors::findOrFail(Input::get('id'));
            if ($objectContent->status == 1) {
                $objectContent->status = 0;
                $message = 'Record unpublished successfully.';
            } else {
                $objectContent->status = 1;
                $message = 'Record published successfully.';
            }
            $objectContent->save();

            return response()->json(['status' => true, 'message' => $message, 'status' => $objectContent->status]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['status' => false, 'message' => Input::get('id')]);
        }
    }

    public function edit($id){
    	$data['doctor'] = Doctors::find($id);
        $data['spec'] = Specializations::where('status',1)->select('id','title')->get();
    	return view('doctors::admin.v_edit_doctor',$data);
    }

    public function editSubmit(Request $request){
		$this->validate($request, ['full_name' => 'required',
										'specialization_id' => 'required',
										'description' => 'required',
										'image' => 'mimes:jpg,jpeg,bmp,png'
										]);

		$doctor = Doctors::find(Input::get('id'));

		$doctor->full_name = Input::get('full_name');
        $doctor->slug = str_slug(Input::get('full_name'));
		$doctor->specialization_id = Input::get('specialization_id');
		$doctor->contact = Input::get('contact');
		$doctor->address = Input::get('address');
		$doctor->description = Input::get('description');
		
		if(Input::file('image') != ""){
			$file = Input::file('image');
			$file_name = time()."_".$file->getClientOriginalName();
			$file_path = 'uploads/doctors/';
			if($file->move($file_path,$file_name)){

                $cropped_image = self::resize_crop_image(600,480, $file_path.$file_name, $file_path."cropped_".$file_name);
                $doctor->image = "cropped_".$file_name;
            }
		}

		$doctor->status = Input::get('status');

		if($doctor->save())
			Session::flash('success', 'Doctor has been successfully added.');
		else
			Session::flash('success', 'Something went wrong.');

		return redirect('admin/doctors');

	}

	public function delete(){
        $rules = ['id' => 'required'];
        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails())
            return response()->json(['status' => false, 'message' => $validator->errors()->all()]);

        try {
            $objectContent = Doctors::findOrFail(Input::get('id'))->delete();
            return response()->json(['status' => true, 'message' => 'Doctor deleted successfully.']);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['status' => false, 'message' => 'Access denied.']);
        }
    }

    public function timetable($id){
    	$data['timetable'] = Timetable::where('doctor_id',$id)->orderBy('id','desc')->paginate(5);
    	$data['doctor_id'] = $id;
    	$data['doctor'] = Doctors::where('id',$id)->pluck('full_name');
        $data['unavailable'] = explode(' - ',Doctors::where('id',$id)->pluck('unavailability_time'));
    	return view('doctors::admin.v_timetable',$data);
    }

    public function setUnavailability($id){
        $data['doctor_id'] = $id;
        return view('doctors::admin.v_set_unavailability',$data);
    }

    public function unavailableSubmit(Request $request){
        $this->validate($request, ['date_range' => 'required'
                                    ]);

        $record = Doctors::where('id', Input::get('doctor_id'))->pluck('unavailability_time');
        if($record == null) {
            $doc = Doctors::find(Input::get('doctor_id'));
            $doc->unavailability_time = Input::get('date_range');
            $doc->save();
            Session::flash('success', 'Unavailability Time has been set.');
        }else{
            Session::flash('error', 'Unavailability Time has already been set. Please remove previous schedule.');
        }
        return redirect('admin/doctors');

    }

    public function addSchedule($id){
        $data['doctor_id'] = $id;
        return view('doctors::admin.v_add_time',$data);
    }

    public function timeSubmit(Request $request){
        $this->validate($request, ['date_range' => 'required',
                                    'shift' => 'required',
                                    'status' => 'required']);

        $date = explode(' - ', Input::get('date_range'));

//        $schedules = Timetable::where('doctor_id',Input::get('doctor_id'))->select('start_date as start','end_date as end')->get();
//
//        $schedules = collect($schedules)->toArray();
//
//        for($i = 1; $i < count($schedules); $i++){
//            if($date[0]> $schedules[$i]['start'] && $date[])
//        }



            $shift = implode(',',Input::get('shift'));
            $days = implode(',',Input::get('day'));


            $sh = ['doctor_id' => Input::get('doctor_id'),
                            'shift' => $shift,
                            'start_date' => $date[0],
                            'end_date' => $date[1],
                            'status' => Input::get('status'),
                            'days' => $days,
                            'created_at' => date('Y-m-d')];


            if(Timetable::insert($sh)){
                Session::flash('success','Time Shift has been added.');
            }else{
                Session::flash('error','Something went wrong.');
            }
            return redirect('admin/doctors/timetable/'.Input::get('doctor_id'));
    }

    public function timeDelete(){
        $rules = ['id' => 'required'];
        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails())
            return response()->json(['status' => false, 'message' => $validator->errors()->all()]);

        try {
            $objectContent = Timetable::findOrFail(Input::get('id'))->delete();
            return response()->json(['status' => true, 'message' => 'Doctor deleted successfully.']);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['status' => false, 'message' => 'Access denied.']);
        }
    }

    public function untimeDelete(){
        $rules = ['id' => 'required'];
        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails())
            return response()->json(['status' => false, 'message' => $validator->errors()->all()]);

        try {
            $objectContent = Doctors::where('id',Input::get('id'))->update(['unavailability_time' => NULL]);
            return response()->json(['status' => true, 'message' => 'Unavailable Schedule deleted successfully.']);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['status' => false, 'message' => 'Access denied.']);
        }
    }

    public function changeTimeStatus()
    {
        $rules = ['id' => 'required'];
        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'message' => $validator->errors()->all()]);
        }

        try {
            $objectContent = Timetable::findOrFail(Input::get('id'));
            if ($objectContent->status == 1) {
                $objectContent->status = 0;
                $message = 'Record unpublished successfully.';
            } else {
                $objectContent->status = 1;
                $message = 'Record published successfully.';
            }
            $objectContent->save();

            return response()->json(['status' => true, 'message' => $message, 'status' => $objectContent->status]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['status' => false, 'message' => Input::get('id')]);
        }
    }

    public function editTime($id){
        $data['time'] = Timetable::find($id);
        return view('doctors::admin.v_edit_time',$data);
    }

    public function editTimeSubmit(Request $request){
        $this->validate($request, ['date_range' => 'required',
            'shift' => 'required',
            'status' => 'required']);



            $shift = implode(',',Input::get('shift'));
            $days = implode(',',Input::get('day'));

        $date = explode(' - ', Input::get('date_range'));

            $sh = ['shift' => $shift,
                    'start_date' => $date[0],
                    'end_date' => $date[1],
                    'days' => $days ];

        if(Timetable::where('id',Input::get('time_id'))->update($sh)){
            Session::flash('success','Time Shift has been added.');
        }else{
            Session::flash('error','Something went wrong.');
        }
        return redirect('admin/doctors/timetable/'.Input::get('doctor_id'));
    }

    function resize_crop_image($max_width, $max_height, $source_file, $dst_dir, $quality = 80){
        $imgsize = getimagesize($source_file);
        $width = $imgsize[0];
        $height = $imgsize[1];
        $mime = $imgsize['mime'];

        switch($mime){
            case 'image/gif':
                $image_create = "imagecreatefromgif";
                $image = "imagegif";
                break;

            case 'image/png':
                $image_create = "imagecreatefrompng";
                $image = "imagepng";
                $quality = 7;
                break;

            case 'image/jpeg':
                $image_create = "imagecreatefromjpeg";
                $image = "imagejpeg";
                $quality = 80;
                break;

            default:
                return false;
                break;
        }

        $dst_img = imagecreatetruecolor($max_width, $max_height);
        $src_img = $image_create($source_file);

        $width_new = $height * $max_width / $max_height;
        $height_new = $width * $max_height / $max_width;
        //if the new width is greater than the actual width of the image, then the height is too large and the rest cut off, or vice versa
        if($width_new > $width){
            //cut point by height
            $h_point = (($height - $height_new) / 2);
            //copy image
            imagecopyresampled($dst_img, $src_img, 0, 0, 0, $h_point, $max_width, $max_height, $width, $height_new);
        }else{
            //cut point by width
            $w_point = (($width - $width_new) / 2);
            imagecopyresampled($dst_img, $src_img, 0, 0, $w_point, 0, $max_width, $max_height, $width_new, $height);
        }

        $image($dst_img, $dst_dir, $quality);

        if($dst_img)imagedestroy($dst_img);
        if($src_img)imagedestroy($src_img);
    }

}
