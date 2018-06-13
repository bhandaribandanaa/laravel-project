<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\CustomLibrary\General;
use App\PackageBookings;
use Illuminate\Http\Request;
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
use App\Applicant;
use App\Contact;
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
        $count = Applicant::count();
        $counts = Contact::count();


       return view('admin.dashboard',['count' => $count],['counts' => $counts]);
    }



    public function getHome()
 {

    // $settings = Setting::pluck('slug','value');
    $settings = \Modules\Setting\Entities\Setting::lists('value', 'slug')->toArray();
// echo '<pre>';
($settings);
    $content = Content::where('id',1)->where('is_active',1)->get();
     $banner = Banner::where('is_active',1)->get();
   $demands = Demand::where('status','active')->orderBy('created_at', 'desc')->paginate(5);
   $testimonials = Testimonial::where('status','active')->get();
   $images = Images::where('is_active',1)->where('album_id', 10)->orderBy('id', 'desc')->get();
   $data = News::where('status','active')->orderBy('published_date','desc')->get();
   $jobCategories = Content::with('photo')->where('parent_id', 20)->where('is_active', 1)->get();

   return view('frontend.home')->with(array('jobCategories'=>$jobCategories ))->with('data',$data)->with('images',$images)->with(array('testimonials'=> $testimonials))->with(array('demands' => $demands))->with(array('banner' =>  $banner))->with('content',$content)->with('settings', $settings);
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

     public function getjobApplySubmit(Request $request){


        $this->validate($request,['name' => 'required',
            'address' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'job_position' => 'required'
           ]);


      
        $applicants = new Applicant();

            $applicants = new Applicant();
            $applicants->name = Input::get('name');
            $applicants->address = Input::get('address');
            $applicants->email = Input::get('email');
            $applicants->phone = Input::get('phone');
            $applicants->job_position = Input::get('job_position');

            $applicants->published_date = date('Y-m-d');
            $applicants->status = Input::get('status');
            if($applicants->save()){
                $email_data['to']= 'developer.prakriti@gmail.com';
        
        
             $email_data['name'] = $applicants->name; 
             $email_data['address']= $applicants->address;
             $email_data['email'] = $applicants->email;
             $email_data['phone']= $applicants->phone;
             $email_data['job_position'] =$applicants->job_position;
             
        
        General::sendMailFunction('emails.vacancy_submit',$email_data,'Inquiry from '.Input::get('name'));

               
                   // Mail::send($content,[], function($message) {
                   //     $message->to('developer.prakriti@gmail.com')
                   //             ->subject('Applicants');
                 // });



                Session::flash('add_success','Application Submitted successfully.');
                return redirect()->back();
            }else{
                Session::flash('error','Something went wrong.');
                return redirect()->back();
            }
          



    }
}

