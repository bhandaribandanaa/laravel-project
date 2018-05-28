<?php namespace Modules\Demand\Http\Controllers;

use Pingpong\Modules\Routing\Controller;
use App\Demand;


class DemandController extends Controller {
	
	public function index()
	{
		
	
	    $demands = Demand::where('status','active')->paginate(8);
        
		return view('demand::v_demands')->with(array('demands' => $demands));
	}

	
	
}