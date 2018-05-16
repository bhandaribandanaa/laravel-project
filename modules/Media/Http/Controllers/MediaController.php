<?php namespace Modules\Media\Http\Controllers;

use Pingpong\Modules\Routing\Controller;

class MediaController extends Controller {
	
	public function index()
	{
		return view('media::index');
	}
	
}