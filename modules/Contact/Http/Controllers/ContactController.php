<?php namespace Modules\Contact\Http\Controllers;

use Pingpong\Modules\Routing\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Input;
use Redirect;
use App\Demand;

use Session;

use Image;
use Auth;
use App\Contact;

class ContactController extends Controller {


 public function testMethod(){
        
       dd("here");
    }



    public function index()
    {

       $contacts = Contact::paginate(5);
       // dd("here");
      
          
        return view('contact::index')->with(array('contacts' => $contacts));

    }

    public function add()
    {
        return view('contact::add');

        // $menu_location = MenuLocation::where('is_active', 1)->lists('name', 'id');
        // return view('demand::admin.add')->with(array('parents_select' => Demand::Demand_list_for_DemandEntry(0, 0, ''), 'menu_location' => $menu_location->toArray()));
    }

    public function addSubmit(Request $request){

        $this->validate($request,['name' => 'required',
           'email' => 'required',
            'phone' => 'required',
         'message' => 'required',
      'subject' => 'required']);


        $contacts = Contact::find(Input::get('id'));
        $conatacts = new Contact();

            $contacts = new Contact();
            $contacts->name = Input::get('name');
            $contacts->email = Input::get('email');
            $contacts->phone = Input::get('phone');
            $contacts->message = Input::get('message');
            $contacts->subject = Input::get('subject'); 
            $contacts->save();
          



        Session::flash('add_success','Message Submitted successfully.');
        return redirect('/');
    }



}


