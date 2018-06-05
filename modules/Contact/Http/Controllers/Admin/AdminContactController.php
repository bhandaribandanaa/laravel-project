<?php namespace Modules\Contact\Http\Controllers\Admin;

use Pingpong\Modules\Routing\Controller;


use Illuminate\Support\Facades\Validator;

use Input;
use Session;
use App\CustomLibrary\General;
use Carbon\Carbon;
use DB;
use Redirect;

use App\Contact;





class AdminContactController extends Controller {

    public function index()
    {

	  

	    $contacts = Contact::where('status', 'active')->paginate(20);
        
		return view('contact::admin.v_contacts')->with(array('contacts' => $contacts));
        
    }




}