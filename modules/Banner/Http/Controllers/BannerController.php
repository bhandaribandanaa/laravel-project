<?php namespace Modules\Banner\Http\Controllers;

use Pingpong\Modules\Routing\Controller;

class BannerController extends Controller {
	
	{
	    $banners = Banner::where('is_active',1)->get();
      
		return view('frontend.partials.index-slider', $banners)->with(array('banners' =>  $banners));
	}
	
}