<?php namespace Modules\Demand\Http\Controllers;

use Pingpong\Modules\Routing\Controller;

class DemandController extends Controller {
	
	public function index()
	{
		return view('Demand::index');
	}
	
}