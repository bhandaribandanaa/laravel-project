<?php namespace Modules\Content\Http\Controllers;

use Pingpong\Modules\Routing\Controller;
use Modules\Content\Entities\Content;
use App\Classes\Email;
use Validator;
use Input, Session;

class ContentController extends Controller {
	
	public function index()
	{
		return view('content::index');
	}

	public function getContact()
	{
        return view('content::contact_us');
	}

    public function postContact()
    {
        $rules = array(
            'full_name' => 'required',
            'address' => 'required',
            'mobile_no' => 'required',
            'email' => 'required|email',
            'message' => 'required',
        );
        $messages = [
            'full_name.required' => 'The full name is required.',
            'address.required' => 'The address is required.',
            'mobile_no.required' => 'The mobile no is required.',
            'email.required' => 'The email is required.',
            'email.email' => 'Please enter the valid email address.',
            'message.required' => 'The message is required.',
        ];

        $validator = Validator::make(Input::all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {

            $subject = "Feedback form website.";
            $subjectUser = "Thank you for your feedback.";
            $content = '<br><strong>Dear Admin </strong><br /><p>Feedback from website: </p>';
            $content .=  '<table width="100%"><tr>
                        <td>Sender Name ,<br />'. Input::get('full_name') .'</td>
                      </tr>
                      <tr>Email : '.Input::get('email').'</td></tr>
                      <tr>Phone No. : '.Input::get('phone').'</td></tr>
                      <tr>
                        <td>Address : '.Input::get('address').'</td>
                      </tr>

                      <tr>Mobile No. : '.Input::get('mobile_no').'</td></tr>
                      
                      <tr>Message <br />'.Input::get('message').'</td></tr>
                    </table>';
            $userContent='<br>Dear '.Input::get('full_name').'<br /> <p>Thank you for your feedback. We will back to you shortly.';

		//$adminEmail= Email::sendEmail('kokil.thapa@peacenepal.com', $subject, $content);
            $adminEmail= Email::sendEmail('rajan.shrestha@peacenepal.com', $subject, $content);
            $userEmail= Email::sendEmail(Input::get('email'), $subjectUser, $userContent);
            Session::flash('class', 'alert alert-success');
            Session::flash('message', 'Feedback sent successfully.');
            return redirect()->route('pages.contact_us')->withInput()->with('success', 'Feedback sent successfully.');
        }
    }

    public function getPageBySlug($slug)
    {
        $content= Content::with('photo')->where('slug',$slug)->firstOrFail();
        return view('content::content_detail')->with(array('content'=>$content));
    }

    public function getGallery()
    {
        return view('content::gallery');
    }
}