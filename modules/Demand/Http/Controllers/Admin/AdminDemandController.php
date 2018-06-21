<?php namespace Modules\Demand\Http\Controllers\Admin;

use Pingpong\Modules\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Input;
use Redirect;

use Session;
use Image;
use Auth;
use App\Demand;


class AdminDemandController extends Controller
{


    public function testMethod(){
        
       dd("here");
    }



    public function index()
    {

       $demands = Demand::where('status','active')->orderBy('published_date', 'desc')->paginate(100);
       // dd("here");
      
          
        return view('demand::admin.index')->with(array('demands' => $demands));

    }

    public function add()
    {
        $demands = Demand::where('status','active')->get();
        return view('demand::admin.add')->with(array('demands' => $demands));

        // $menu_location = MenuLocation::where('is_active', 1)->lists('name', 'id');
        // return view('demand::admin.add')->with(array('parents_select' => Demand::Demand_list_for_DemandEntry(0, 0, ''), 'menu_location' => $menu_location->toArray()));
    }

    public function addSubmit(Request $request){

        $this->validate($request,['job_position' => 'required',
            'salary' => 'required',
            'type' => 'required',
            'request_number' => 'required',
            'fooding' => 'required',
            'accomodation' => 'required']);


        $demands = new Demand;

            $demands = new Demand();
            $demands->job_position = Input::get('job_position');
            $demands->salary = Input::get('salary');
            $demands->type = Input::get('type');
            $demands->request_number = Input::get('request_number');
            $demands->fooding = Input::get('fooding');
            $demands->accomodation = Input::get('accomodation');
            $demands->published_date = date('Y-m-d');
            $demands->status = Input::get('status');
            $demands->save();
          



        Session::flash('add_success','Demand has been successfully added.');
        return redirect('admin/demands');
    }

 public function edit($id)
    {
        $demands = Demand::findOrFail($id);

         
       
            return view('demand::admin.edit_Demands')->with(array('demands' => $demands));
    }
  public function editSubmit(Request $request){

        $this->validate($request,['job_position' => 'required',
            'salary' => 'required',
            'type' => 'required',
            'request_number' => 'required',
            'fooding' => 'required',
            'accomodation' => 'required']);

        $demands = Demand::find(Input::get('id'));

       
            $demands->job_position = Input::get('job_position');
            $demands->salary = Input::get('salary');
            $demands->type = Input::get('type');
            $demands->request_number = Input::get('request_number');
            $demands->fooding = Input::get('fooding');
            $demands->accomodation = Input::get('accomodation');
            $demands->published_date = date('Y-m-d');
            $demands->status = Input::get('status');
            $demands->save();

        Session::flash('edit_success','Demand has been successfully edited.');
        return redirect('admin/demands');
    }

     public function changeStatus($id,$option){
        Demand::where('id',$id)->update(['status' => $option]);
        Session::flash('status_success','Demands has been changed');
        return redirect('admin/demands');
    }

    // public function changeStatus()
    // {
    //     $rules = ['id' => 'required'];
    //     $validator = Validator::make(Input::all(), $rules);

    //     if ($validator->fails()) {
    //         return response()->json(['status' => false, 'message' => $validator->errors()->all()]);
    //     }

    //     try {
    //         $objectContent = Demand::findOrFail(Input::get('id'));
    //         if ($objectContent->status == 'active') {
                
    //             $message = 'Demand unpublished successfully.';
    //         } else {
    //             $objectContent->status = 'not_active';
    //             $message = 'Demand published successfully.';
    //         }
    //         $objectContent->save();

    //         return response()->json(['status' => true, 'message' => $message, 'is_active' => $objectContent->is_active]);
    //     } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
    //         return response()->json(['status' => false, 'message' => Input::get('id')]);
    //     }
    // }

    public function delete($id){
        Demand::where('id',$id)->delete();
        print_r(json_encode(['status' => 'success', 'value' => 'Demand has been deleted.']));
    }

}


