<?php namespace Modules\Applicant\Http\Controllers;

use Pingpong\Modules\Routing\Controller;

class ApplicantController extends Controller {
	
	public function index()
	{
		return view('Applicant::index');
	}
	
}