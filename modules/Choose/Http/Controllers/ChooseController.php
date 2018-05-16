<?php namespace Modules\Choose\Http\Controllers;

use Pingpong\Modules\Routing\Controller;
use App\ChooseUs;

class ChooseController extends Controller {
	
	public function index()
	{
		$data['choose'] = ChooseUs::paginate(5);
		return view('choose::v_why_choose',$data);
	}
	
}