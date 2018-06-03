<?php namespace Modules\Setting\Http\Controllers\Admin;

use Pingpong\Modules\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Input;
use Redirect;

use Session;
use Image;
use Auth;
use Modules\Setting\Entities\Setting;

/**
 * Controller used to manage Demands in admin part.
 *
 * 
 */
class AdminSettingController extends Controller
{


    public function testMethod(){
        
       dd("setting");
    }



    public function index()
    {

       $settings = Setting::paginate(8);
       // dd("here");
      
          
        return view('setting::admin.index')->with(array('settings' => $settings));

    }

    public function add()
    {
        $settings = Setting::where('status','active')->get();
        return view('setting::admin.add')->with(array('settings' => $settings));

        
    }

    public function addSubmit(Request $request){

        $this->validate($request,['name' => 'required',
            'slug' => 'required',
            'value' => 'required',
            'type'=>'required']);


        $settings = new Setting;

            $settings = new Setting();
            $settings->name = Input::get('name');
            $settings->slug = Input::get('slug');
            $settings->value = Input::get('value');
            $settings->type = Input::get('type');
            $settings->status = Input::get('status');
            $settings->save();
          



        Session::flash('add_success','Setting has been successfully added.');
        return redirect('admin/settings');
    }

 public function edit($id)

    {
        // print_r("here");
        $data['settings'] = Setting::whereStatusAndId('active', $id)->first();
        return view('setting::admin.edit_Setting',$data);
        // $settings = Setting::where('status', 'active')->get();
        // return view('setting::admin.edit_Setting', $settings);
    }
  public function editSubmit(Request $request){

        $this->validate($request,['name' => 'required',
            'slug' => 'required',
            'value' => 'required',
            'type'=>'required']);

        $settings = Setting::find(Input::get('id'));

         $settings = new Setting();
            $settings->name = Input::get('name');
            $settings->slug = Input::get('slug');
            $settings->value = Input::get('value');
            $settings->type = Input::get('type');
            $settings->status = Input::get('status');
            $settings->save();

        Session::flash('edit_success','Setting has been successfully edited.');
        return redirect('admin/settings');
    }

    public function changeStatus($id,$option){
        Setting::where('id',$id)->update(['status' => $option]);
        Session::flash('status_success','Setting has been changed');
        return redirect('admin/settings');
    }

    public function delete($id){
        Setting::where('id',$id)->delete();
        print_r(json_encode(['status' => 'success', 'value' => 'Setting has been deleted.']));
    }

}


