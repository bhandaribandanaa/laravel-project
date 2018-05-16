<?php namespace Modules\Newsletter\Http\Controllers;

use Pingpong\Modules\Routing\Controller;
use App\Newsletter;
class NewsletterController extends Controller {
	
	public function index()
	{
		return view('newsletter::admin.index');
	}
	
  public function create()
  {
    $newsletter = Newsletter::findByEmail(trim(Input::get('email')));
    if(!$newsletter) {
      $newsletter = new Newsletter();
      $newsletter->email = trim(Input::get('email'));
      $newsletter->save();

      return ['status' => 'success', 'message' => 'Email Successfully Subscribed'];
    }
    else{
      return ['status' => "failure", 'message' => 'Email Already Subscribed'];
    }
  }
}