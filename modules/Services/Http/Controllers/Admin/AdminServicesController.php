<?php namespace Modules\Services\Http\Controllers\Admin;

use Pingpong\Modules\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Input;
use Session;
use Image;

use App\Services;

class AdminServicesController extends Controller {

    public function index()
    {
        $data['services'] = Services::paginate(5);
        return view('services::admin.v_services',$data);
    }

    public function add(){
        return view('services::admin.v_add_services');
    }

    public function addSubmit(Request $request){

        $this->validate($request,['title' => 'required',
                                    'icon' => 'required',
                                    'description' => 'required',
                                    'status' => 'required']);


        $service = new Services;

        $service->title = Input::get('title');
        $service->slug = str_slug(Input::get('title'));
        $service->icon = Input::get('icon');
        $service->description = Input::get('description');
        $service->status = Input::get('status');
        $service->created_at = date('Y-m-d');

        $service->save();

        if(Input::file('image') != ""){
            $image = Input::file('image');
            $image_name=time()."_".$image->getClientOriginalName();
            $path = public_path('uploads/services')."/".$image_name;
            Image::make($image->getRealPath())->save($path);
            $service['image'] = $image_name;
            Services::where('id',$service->id)->update($service);
        }


        Session::flash('add_success','Service has been successfully added.');
        return redirect('admin/services');

    }

    public function changeStatus()
    {
        $rules = ['id' => 'required'];
        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'message' => $validator->errors()->all()]);
        }

        try {
            $objectContent = Services::findOrFail(Input::get('id'));
            if ($objectContent->status == 1) {
                $objectContent->status = 0;
                $message = 'Service unpublished successfully.';
            } else {
                $objectContent->status = 1;
                $message = 'Service published successfully.';
            }
            $objectContent->save();

            return response()->json(['status' => true, 'message' => $message, 'status' => $objectContent->status]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['status' => false, 'message' => Input::get('id')]);
        }
    }

    public function delete(){
        $rules = ['id' => 'required'];
        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails())
            return response()->json(['status' => false, 'message' => $validator->errors()->all()]);

        try {
            $objectContent = Services::findOrFail(Input::get('id'))->delete();
            return response()->json(['status' => true, 'message' => 'Service deleted successfully.']);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['status' => false, 'message' => 'Access denied.']);
        }
    }

    public function edit($id){
        $data['service'] = Services::where('id',$id)->first();
        return view('services::admin.v_edit_service',$data);
    }

    public function editSubmit(Request $request){

        $this->validate($request,['title' => 'required',
                                    'icon' => 'required',
                                    'description' => 'required',
                                    'status' => 'required']);


        $service = Services::find(Input::get('id'));

        $service->title = Input::get('title');
        $service->slug = str_slug(Input::get('title'));
        $service->icon = Input::get('icon');
        $service->description = Input::get('description');
        $service->status = Input::get('status');
        $service->save();

        if(Input::file('image') != ""){
            $image = Input::file('image');
            $image_name=time()."_".$image->getClientOriginalName();
            $path = public_path('uploads/services')."/".$image_name;
            Image::make($image->getRealPath())->save($path);
            $service_data['image'] = $image_name;
            Services::where('id',Input::get('id'))->update($service_data);
        }

        Session::flash('add_success','Service has been successfully updated.');
        return redirect('admin/services');

    }


}