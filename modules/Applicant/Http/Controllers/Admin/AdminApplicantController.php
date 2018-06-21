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
    	$count = Applicant::count();
     

	    $applicants = Applicant::with('demand')->orderBy('published_date', 'desc')->paginate(5);
        
		return view('applicant::admin.v_applicants')->with('count', $count)->with(array('applicants' => $applicants));
        
    }

     public function delete($id){
        Applicant::where('id',$id)->delete();
        print_r(json_encode(['status' => 'success', 'value' => 'Applicant has been deleted.']));
    }




}