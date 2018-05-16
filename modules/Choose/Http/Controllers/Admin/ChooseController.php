<?php namespace Modules\Choose\Http\Controllers\Admin;

use Pingpong\Modules\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Session;
use Input;

use App\ChooseUs;

class ChooseController extends Controller {
	
	public function index(){
		$data['choose'] = ChooseUs::paginate(5);
		return view('choose::admin.v_why_choose',$data);
	}

	public function add(){
		return view('choose::admin.v_add_choose');
	}

	public function addSubmit(Request $request){
		$this->validate($request,['title' => 'required',
									'subtitle' => 'required',
									'is_active' => 'required']);

		$choose = new ChooseUs;

		$choose->title = Input::get('title');
		$choose->subtitle = Input::get('subtitle');
		$choose->is_active = Input::get('is_active');
		if($choose->save())
			Session::flash('success','Choose Question has been added.');
		else
			Session::flash('error','Something went wrong.');
		return redirect('admin/choose');
	}

	public function edit($id){
		$data['choose'] = ChooseUs::where('id',$id)->first();
		return view('choose::admin.v_edit_choose',$data);
	}

	public function editSubmit(Request $request){
		$this->validate($request,['title' => 'required',
									'subtitle' => 'required',
									'is_active' => 'required']);

		$choose = ChooseUs::find(Input::get('id'));

		$choose->title = Input::get('title');
		$choose->subtitle = Input::get('subtitle');
		$choose->is_active = Input::get('is_active');
		if($choose->save())
			Session::flash('success','Choose Question has been added.');
		else
			Session::flash('error','Something went wrong.');
		return redirect('admin/choose');
	}

	public function deleteChoose()
    {
        $rules = ['id' => 'required'];
        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails())
            return response()->json(['status' => false, 'message' => $validator->errors()->all()]);

        try {
            $choose = ChooseUs::findOrFail(Input::get('id'))->delete();
            return response()->json(['status' => true, 'message' => 'Question deleted successfully.']);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['status' => false, 'message' => 'Access denied.']);
        }
    }

    public function changeChooseStatus()
    {
        $rules = ['id' => 'required'];
        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'message' => $validator->errors()->all()]);
        }

        try {
            $objectGallery = ChooseUs::findOrFail(Input::get('id'));
            if ($objectGallery->is_active == 1) {
                $objectGallery->is_active = 0;
                $message = 'Question unpublished successfully.';
            } else {
                $objectGallery->is_active = 1;
                $message = 'Question published successfully.';
            }
            $objectGallery->save();

            return response()->json(['status' => true, 'message' => $message, 'is_active' => $objectGallery->is_active]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['status' => false, 'message' => Input::get('id')]);
        }
    }

}