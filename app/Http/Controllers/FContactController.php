<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Input;
use Redirect;
use App\Demand;
use App\CustomLibrary\General;
use Session;

use Image;
use Auth;
use Modules\Setting\Entities\Setting;
use App\Contact;

class FContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $contents=Content::all();
        $setting=Setting::all();
        return view('frontend.partials.contact')->with('setting',$setting);
        // ->with('contents',$contents);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
      public function addSubmit(Request $request){

        $this->validate($request,['name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'message' => 'required',
            'subject' => 'required']);


        $contacts = Contact::find(Input::get('id'));
        // $conatacts = new Contact();

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
                $email_data['to']= 'bhandari.bandana@gmail.com';
        
             $email_data['body']=$content;
        
             General::sendMailFunction('emails.main',$email_data,'Message from '.Input::get('name'));

                Session::flash('add_success','Message Submitted successfully.');
                return redirect()->back();
            }else{
                Session::flash('error','Something went wrong.');
                return redirect()->back();
            }
          



    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
