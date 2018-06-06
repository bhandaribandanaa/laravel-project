<?php namespace Modules\Applicant\Http\Controllers;

use Pingpong\Modules\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Input;
use Redirect;
use App\Demand;

use Session;
use App\CustomLibrary\General;

use Image;
use Auth;
use App\Applicant;

use Mail;

class ApplicantController extends Controller
{


    public function testMethod(){
        
       dd("here");
    }



    public function index()
    {

       $applicants = Applicant::paginate(5);
       // dd("here");
      
          
        return view('applicant::index')->with(array('applicant' => $applicants));

    }

    public function add($id)
    {
        return view('applicant::add')->with(array('id' => $id));

        // $menu_location = MenuLocation::where('is_active', 1)->lists('name', 'id');
        // return view('demand::admin.add')->with(array('parents_select' => Demand::Demand_list_for_DemandEntry(0, 0, ''), 'menu_location' => $menu_location->toArray()));
    }

    public function addSubmit(Request $request){

        
        $this->validate($request,['name' => 'required',
            'address' => 'required',
            'email' => 'required',
            'phone' => 'required']);


        $applicants = Demand::find(Input::get('id'));
        $applicants = new Applicant();

            $applicants = new Applicant();
            $applicants->name = Input::get('name');
            $applicants->address = Input::get('address');
            $applicants->email = Input::get('email');
            $applicants->phone = Input::get('phone');
            $applicants->cv = Input::get('cv');
            $applicants->job_id = Input::get('id');
            $applicants->job_position = Input::get('job_position');
            $applicants->published_date = date('Y-m-d');
            $applicants->status = Input::get('status');


$content = '<!DOCTYPE html>
                      <html lang="en">
                      <head>
                      <meta charset="utf-8">
                      <meta name="viewport" content="width=device-width, initial-scale=1.0">
                      <meta name="description" content="">
                      <meta name="author" content="">
                      <link href="" type="images/png" rel="icon" />
                      <title>Job Application </title>

                      </head>
                      <body >
                      <table border="0" style="width:650px; background:#f2f2f2; color:#333; margin:auto; font-family:Arial, Helvetica, sans-serif; font-size:13px; line-height:1.6">
                      <tr><td style=" text-align:center;  padding-top:15px ;"><a target="_blank"><img src="'. asset('images/logo.png') .'" style="width:300px;"></a></td></tr>


                        <tr>
                          <td style="padding:15px; ">
                          
                          <table border="0" style="background:#fff; padding:20px; width:100%">
                      <tr>
                        <td >Applicant <strong>'. Input::get('name') . ',  

                      </td>
                      </tr>

                      <tr>

                      <table border="0" cellpadding="5" cellspacing="1" style=" padding:0px 20px 20px 20px; width:100%; background:#fff; ">

                      <tr>

                      <td width="25%">Full Name</td>
                      <td width="75%">'. Input::get('name') .'</td>
                      </tr>
                      <tr>

                      <td>Address</td>
                      <td>'. Input::get('address') .'</td>
                      </tr>
                      <tr>
                      <tr>

                      <td>Mobile</td>
                      <td>'. Input::get('phone') .'</td>
                      </tr>
                      <tr>

                      <td>Email Address</td>
                      <td>'. Input::get('email') .'</td>
                      </tr>
                      <tr>
                      <tr>

                      
                      </tr>
                      <tr>
                      <tr>

                      <td>Job Position</td>
                      <td>'. Input::get('id') .'</td>
                      </tr>
                      <tr>

                      <td valign="top">Cv</td>
                      <td>'. Input::get('cv') .'</td>
                      </tr>

                      <tr>
                      <td ></td>

                      </table>
                      </tr>
                        <tr>
                        
                        </tr>
                      </table> <!--content table end-->

                          </td>
                        </tr>
                      </table>

                      </body>
                      </html>';

            

            if($applicants->save()){
                $email_data['to']= 'developer.prakriti@gmail.com';
        
             $email_data['body']=$content;
        
        General::sendMailFunction('emails.main',$email_data,'Inquiry from '.Input::get('name'));

               
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


