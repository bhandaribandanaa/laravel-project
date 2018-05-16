<?php namespace Modules\Banner\Http\Controllers;

use Pingpong\Modules\Routing\Controller;

class BannerController extends Controller {
	
	public function index()
	{
		return view('Banner::index');
	}
	
}