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
    $content = Content::where('id',1)->where('is_active',1)->get();
     $banner = Banner::where('is_active',1)->get();
   $demands = Demand::where('status','active')->orderBy('created_at', 'desc')->paginate(5);
   $testimonials = Testimonial::where('status','active')->get();
   $images = Images::where('is_active',1)->where('album_id', 10)->orderBy('id', 'desc')->get();
   $data = News::where('status','active')->orderBy('published_date','desc')->get();
   $jobCategories = Content::with('photo')->where('parent_id', 20)->where('is_active', 1)->get();

   return view('frontend.home')->with(array('jobCategories'=>$jobCategories ))->with('data',$data)->with('images',$images)->with(array('testimonials'=> $testimonials))->with(array('demands' => $demands))->with(array('banner' =>  $banner))->with('content',$content);
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
    

    public function getJobApply()
    {

        return view('frontend.job_applyform');

    }
    public function sendJobEmail(Request $request){
         Mail::send('jobapply.form',
            array('first_name' => $request->get('first_name'),
                'last_name' => $request->get('last_name'),
                'email' => $request->get('email'),
                'phone' => $request->get('phone'),
                'address' => $request->get('address'),
                'resume' => $request->get('resume')), function($message)
        {
            
            $message->from('');
            $message->to('prakritiadhikari2@gmail.com', 'Prakriti')->subject('Test');
        });

    return Redirect::route('/')->with('message', 'Thank You. Your Message has been Submitted');


     //    $jobs = new Job;

     //        $jobs = new Job();
     //        $jobs->first_name = Input::get('first_name');
     //        $jobs->last_name = Input::get('last_name');
     //        $jobs->email = Input::get('email');
     //        $jobs->phone = Input::get('phone');
     //        $jobs->address = Input::get('address');
     //        $jobs->position = Input::get('position');
     //        $jobs->job_id= Input::get('job_id');
     //        $jobs->save();
     //     Session::flash('add_success','Application has been successfully sent.');
     //     return redirect('/');

     // }
         }
     }



    //      public function contactpage()
    // {
    //     $contact = AvoContact::all();

    //     return view('pages.contact')->with(['contact' => $contact]);
    // }

    // public function store(ContactFormRequest $request)
    // {

    //     Mail::send('pages.contact',
    //         array(
    //             'name' => $request->get('name'),
    //             'email' => $request->get('email'),
    //             'phone' => $request->get('phone'),
    //             'subject' => $request->get('subject'),
    //             'message' => $request->get('message')
    //         ), function($message)
    //     {
    //         $message->from('sanjiarya2112@gmail.com');
    //         $message->to('mrtext21@gmail.com', 'Mr Cool')->subject('Test');
    //     });

    // return Redirect::route('contact')->with('message', 'Thank You. Your Message has been Submitted');

    // }  


