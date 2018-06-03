<?php namespace Modules\Setting\Http\Controllers;

use Pingpong\Modules\Routing\Controller;
use Modules\Setting\Entities\Setting;


class SettingController extends Controller {
	
	public function index()
	{
		
	
	    $settings = Setting::where('status','active')->pluck('slug','value')->get();
        
		return view('setting::setting_top_bar')->with(array('settings' => $settings));
	}

	
	
}