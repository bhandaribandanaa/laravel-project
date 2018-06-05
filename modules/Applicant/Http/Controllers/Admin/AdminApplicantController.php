<?php namespace Modules\Applicant\Http\Controllers\Admin;

use Pingpong\Modules\Routing\Controller;


use Illuminate\Support\Facades\Validator;

use Input;
use Session;
use App\CustomLibrary\General;
use Carbon\Carbon;
use DB;
use Redirect;

use App\Applicant;
use App\Demand;




class AdminApplicantController extends Controller {

    public function index()
    {

	    $applicants = Applicant::where('status','active')->paginate(10);
        
		return view('applicant::admin.v_applicants')->with(array('applicants' => $applicants));
        
    }




}