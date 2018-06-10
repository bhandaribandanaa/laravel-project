<?php namespace Modules\Contact\Http\Controllers;

use Pingpong\Modules\Routing\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Input;
use Redirect;
use App\Demand;
use App\CustomLibrary\General;
use Session;

use Image;
use Auth;
use App\Contact;

class ContactController extends Controller {


 public function testMethod(){
        
       dd("here");
    }



    public function index()
    {

       $contacts = Contact::paginate(5);
       // dd("here");
      
          
        return view('contact::index')->with(array('contacts' => $contacts));

    }

    public function add()
    {
        return view('contact::add');

        // $menu_location = MenuLocation::where('is_active', 1)->lists('name', 'id');
        // return view('demand::admin.add')->with(array('parents_select' => Demand::Demand_list_for_DemandEntry(0, 0, ''), 'menu_location' => $menu_location->toArray()));
    }

    public function addSubmit(Request $request){

        $this->validate($request,['name' => 'required',
           'email' => 'required',
            'phone' => 'required',
         'message' => 'required',
      'subject' => 'required']);


        $contacts = Contact::find(Input::get('id'));
        $conatacts = new Contact();

            $contacts = new Contact();
            $contacts->name = Input::get('name');
            $contacts->email = Input::get('email');
            $contacts->phone = Input::get('phone');
            $contacts->message = Input::get('message');
            $contacts->subject = Input::get('subject'); 
            $contacts->save();


            $content = '<!DOCTYPE html>
                      <html lang="en">
                      <head>
                      <meta charset="utf-8">
                      <meta name="viewport" content="width=device-width, initial-scale=1.0">
                      <meta name="description" content="">
                      <meta name="author" content="">
                      <link href="" type="images/png" rel="icon" />
                      <title>Message</title>

                      </head>
                      <body >
                      <table border="0" style="width:650px; background:#f2f2f2; color:#333; margin:auto; font-family:Arial, Helvetica, sans-serif; font-size:13px; line-height:1.6">
                    


                        <tr>
                          <td style="padding:15px; ">
                          
                          <table border="0" style="background:#fff; padding:20px; width:100%">
                      <tr>
                        <td >Message From <strong>'. Input::get('name') . ',  

                      </td>
                      </tr>

                      <tr>

                      <table border="0" cellpadding="5" cellspacing="1" style=" padding:0px 20px 20px 20px; width:100%; background:#fff; ">

                      <tr>

                      <td width="25%">Full Name</td>
                      <td width="75%">'. Input::get('name') .'</td>
                      </tr>
                      <tr>

                     
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
                      <td>Subject</td>
                      <td>'. Input::get('subject') .'</td>
                      

                      
                      </tr>
                      <tr>
                      <tr>

                      <td>Message</td>
                      <td>'. Input::get('message') .'</td>
                      </tr>
                      <tr>

                      
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

            

            if($contacts->save()){
                $email_data['to']= 'developer.prakriti@gmail.com';
        
             $email_data['body']=$content;
        
        General::sendMailFunction('emails.main',$email_data,'Message from '.Input::get('name'));

               
                   // Mail::send($content,[], function($message) {
                   //     $message->to('developer.prakriti@gmail.com')
                   //             ->subject('Applicants');
                 // });



                Session::flash('add_success','Message Submitted successfully.');
                return redirect()->back();
            }else{
                Session::flash('error','Something went wrong.');
                return redirect()->back();
            }
          



    }



}



          
