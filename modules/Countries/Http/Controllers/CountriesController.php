<?php namespace Modules\Countries\Http\Controllers;

use Pingpong\Modules\Routing\Controller;
use App\Countries;

class CountriesController extends Controller {
	
	public function index()
	{
		// dd('jdnsaj');
      $countries = Countries::with('activeDemand')
                        ->where('is_active', 1)
                        ->orderBy('created_at')
                      ->paginate(5);

        return view('countries::index')
                    ->with('countries', $countries);
		
	}

	 public function show($slug)
    {
        $countries = Countries::where('slug', $slug)->first();

        if($countries){
            $demands = $countries->activeDemand()->paginate(5);
            return view('countries::countries_detail')
                    ->with('countries', $countries)
                    ->with('demands', $demands);
        } else {
            return view('frontend.404');
        }   
    }    
}
	
