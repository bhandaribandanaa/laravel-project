<?php namespace Modules\Applicant\Http\Controllers;

use Pingpong\Modules\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Input;
use Redirect;
use App\Demand;

use Session;

use Image;
use Auth;
use App\Applicant;


class ApplicantController extends Controller
{


    public function testMethod(){
        
       dd("here");
    }



    public function index()
    {

       $applicants = Applicant::paginate(5);
       // dd("here");
      
          
        return view('applicant::index')->with(array('applicant' => $applicants));

    }

    public function add($id)
    {
        $applicants = Applicant::whereStatusAndId('active', $id)->get();
        return view('applicant::add')->with(array('applicants' => $applicants));

        // $menu_location = MenuLocation::where('is_active', 1)->lists('name', 'id');
        // return view('demand::admin.add')->with(array('parents_select' => Demand::Demand_list_for_DemandEntry(0, 0, ''), 'menu_location' => $menu_location->toArray()));
    }

    public function addSubmit(Request $request){

        $this->validate($request,['name' => 'required',
            'address' => 'required',
            'email' => 'required',
            'phone' => 'required']);


        $applicants = Demand::find(Input::get('id'));
        $applicants = new Applicant();

            $applicants = new Applicant();
            $applicants->name = Input::get('name');
            $applicants->address = Input::get('address');
            $applicants->email = Input::get('email');
            $applicants->phone = Input::get('phone');
            $applicants->cv = Input::get('cv');
            $applicants->job_id = Demand::find(Input::get('id'));;
            $applicants->job_position = Input::get('job_position');
            $applicants->published_date = date('Y-m-d');
            $applicants->status = Input::get('status');
            $applicants->save();
          



        Session::flash('add_success','Application Submitted successfully.');
        return redirect('/');
    }



}


