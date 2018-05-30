<?php namespace Modules\Banner\Http\Controllers;

use Pingpong\Modules\Routing\Controller;

class BannerController extends Controller {
	
	{
	    $banner = Banner::where('is_active',1)->get();
      
		return view('frontend.partials.index-slider', $banner)->with(array('banner' =>  $banner));
	}
	
}