<?php namespace Modules\Appointments\Http\Controllers;

use Pingpong\Modules\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Appointments;

class AppointmentsController extends Controller {
	
	public function index()
	{
		return view('Appointments::index');
	}
	
}