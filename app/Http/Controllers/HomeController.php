<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\PackageBookings;
use Modules\Banner\Entities\Banner;
use Modules\Events\Entities\Events;
use Input;
use Validator;
use App\Newsletter;
use App\ChooseUs;
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
        $upcomingConference = Events::with('eventType', 'photo')->where('is_active', '1')->where('start_date', '>', new \DateTime())->first();
        $pastConference = Events::with('eventType', 'photo')->where('is_active', '1')->where('start_date', '<', new \DateTime())->orderBy('id', 'DESC')->first();
        
        $sliders = Banner::orderBy('id', 'DESC')->where('is_active', '1')->take(5)->get();
        $choose = ChooseUs::orderBy('id', 'DESC')->where('is_active','1')->take(5)->get();



        return view('frontend.home')->with(array('upcoming_conference' => $upcomingConference, 'past_conference' => $pastConference, 'sliders' => $sliders, 'choose' => $choose));
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
