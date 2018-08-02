<?php namespace Modules\Demand\Http\Controllers;

use Pingpong\Modules\Routing\Controller;
use App\Demand;
use App\Countries;


class DemandController extends Controller {
	
	public function index()
	{
		 $countries = Countries::select('id', 'name')->get();
	
	    $demands =  Demand::with('country')->where('status','active')->orderBy('published_date', 'desc')->paginate(100);
        
		return view('demand::v_demands')->with(array('demands' => $demands))->with('countries', $countries);
	}

	
	
}