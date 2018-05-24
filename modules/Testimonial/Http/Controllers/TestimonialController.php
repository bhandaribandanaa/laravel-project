<?php namespace Modules\Testimonial\Http\Controllers;

use Pingpong\Modules\Routing\Controller;

class TestimonialController extends Controller {
	
	public function index()
	{
		return view('Testimonial::index');
	}
	
}