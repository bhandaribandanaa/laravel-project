<?php namespace App\Classes;

use Mail;

class Email
{

    public static function sendEmail($receiverEmail, $subject, $content, $replyTo = "", $ccBCC = [])
    {
        $senderEmail = 'info@nirvanawellnessclinic.com';
        $senderName = 'Nirvana';
        $sitePath = url('/');
        $siteName = 'Nirvana';

        $data = array(
            'logopath' => asset('images/logo.png'),
            'content' => $content,
            'footer' => ' Copyright ' . date('Y') . ' ',
            'sitepath' => $sitePath,
            'sitename' => $siteName,
        );

        try {
            Mail::send('emails.email', $data, function ($message)
            use ($senderEmail, $senderName, $receiverEmail, $subject) {
                $message->from($senderEmail, $senderName);
                $message->to($receiverEmail)->subject($subject);
            });
            return count(Mail::failures()) > 0 ? false : true;

        } catch (Swift_RfcComplianceException $e) {
            return false;
        }

    }
    public static function sendBarcodeEmail($receiverEmail, $subject, $content,$attachment)
    {
        $senderEmail = 'no-reply@simon.org.np';
        $senderName = 'Society of internal Medicine of Nepal (SIMON)';
        $sitePath = url('http://simon.org.np/');
        $siteName = 'Society of internal Medicine of Nepal (SIMON) ';

        $data = array(
            'logopath' => asset('images/logo_small.png'),
            'content' => $content,
            'footer' => ' Copyright ' . date('Y') . ' ',
            'sitepath' => $sitePath,
            'sitename' => $siteName,
        );

        try {
            Mail::send('emails.email', $data, function ($message)
            use ($senderEmail, $senderName, $receiverEmail, $subject,$attachment) {
                $message->from($senderEmail, $senderName);
                $message->to($receiverEmail)->subject($subject);
                if($attachment)
                    $message->attachData($attachment->output(), "ticket.pdf");
            });
            return count(Mail::failures()) > 0 ? false : true;

        } catch (Swift_RfcComplianceException $e) {
            return false;
        }

    }

}
