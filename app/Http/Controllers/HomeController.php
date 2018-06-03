<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\PackageBookings;
use Modules\Banner\Entities\Banner;
use Modules\Gallery\Entities\Album;
use Modules\Gallery\Entities\Images;
use Modules\Setting\Entities\Setting;

use Modules\Events\Entities\Events;
use Input;
use Redirect;
use Session;
use Auth;

use Validator;
use App\Newsletter;
use App\News;
use App\NewsCategory;

use App\ChooseUs;

use Modules\Content\Entities\Content;
use App\Testimonial;
use App\Demand;
use App\Appointments;


class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $today_appointments = Appointments::where('date', date('Y-m-d'))->where('is_confirmed',1)->where('is_success',0)->count();
        $pending_appointments = Appointments::where('is_confirmed',0)->where('is_success',0)->count();
        $today_packages = PackageBookings::where('date', date('Y-m-d'))->where('is_confirmed',1)->where('is_success',0)->count();
        $pending_packages = PackageBookings::where('is_confirmed',0)->where('is_success',0)->count();

        return view('admin.dashboard',['today_appointments' => $today_appointments, 'pending_appointments' => $pending_appointments, 'today_packages' => $today_packages, 'pending_packages' => $pending_packages]);
    }

    public function getHome()
 {
    // $settings = Setting::pluck('slug','value');
      $banner = Banner::where('is_active',1)->get();
     

        $demands = Demand::where('status','active')->orderBy('published_date', 'desc')->get();
        
$testimonials = Testimonial::where('status','active')->get();
 
 
 $images = Images::where('is_active',1)->where('album_id', 10)->orderBy('id', 'desc')->paginate(6);
        
        



 $data = News::where('status','active')->orderBy('published_date','desc')->paginate(6);
 $jobCategories = Content::with('photo')->where('parent_id', 20)->where('is_active', 1)->get();

return view('frontend.home')->with(array('jobCategories'=>$jobCategories ))->with('data',$data)->with('images',$images)->with(array('testimonials'=> $testimonials))->with(array('demands' => $demands))->with(array('banner' =>  $banner));
// ->with(array('settings' => $settings));




        


      



       
    }

    public function subscribeNewsletter()
    {
        $rules = ['email' => 'required|email|unique:newsletter,email'];

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return response()->json(['status' => "failure", 'message' => '<p style="color:red;">This email has already been subscribed.</p>']);
        }
        try {
            $objectNewsLetter= new Newsletter();
            $objectNewsLetter->email = Input::get('email');
            $objectNewsLetter->save();
            if($objectNewsLetter->id){
                $message = '<p style="color:green;">Successfully subscribed to the newsletter. </p>';
            }
            return response()->json(['status' => "success", 'message' => $message]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['status' => "failure", 'message' => 'Error: Oops. Something went wrong. Please try again later.']);
        }
    }
}
