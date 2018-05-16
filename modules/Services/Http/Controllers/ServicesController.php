<?php namespace Modules\Services\Http\Controllers;

use Pingpong\Modules\Routing\Controller;

use App\Services;

class ServicesController extends Controller {
	
	public function index()
	{
	    $data['services'] = Services::where('status',1)->get();
		return view('services::v_services',$data);
	}
	
}