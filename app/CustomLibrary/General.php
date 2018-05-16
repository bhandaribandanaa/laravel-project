<?php
namespace App\CustomLibrary;
use Mail;
use Input;

use Illuminate\Http\Request;

use Session;
use Auth;


class General
{   
    public static function sendMailFunction($view, $mailDetails, $subject)
	{
			try{
				
				Mail::send($view, $mailDetails, function($message) use($mailDetails,$subject) {
                       $message->to($mailDetails['to'])
	                           ->subject($subject);
                 });

            }
			catch(Exception $e)
            {
                return $e->getMessage();
            }
		
        return 'success';
			/*return 'OK';
		else
			return Mail::failures();*/
	}
}
