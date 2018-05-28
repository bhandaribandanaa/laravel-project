<?php namespace Modules\Testimonial\Http\Controllers;

use Pingpong\Modules\Routing\Controller;

class TestimonialController extends Controller {
	public function index()
	{
	    $testimonials = Testimonial::where('status','active')->get();
      
		return view('testimonial::v_testimonial', $testimonials);
	}

	
	
}