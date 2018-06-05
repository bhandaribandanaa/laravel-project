<?php
return array(
    'driver' => 'smtp',
    'host' => env('MAIL_HOST'),
    'port' => env('MAIL_PORT'),
   'from' => array('address' => env('MAIL_USERNAME'), 'name' => 'Sadik International Overseas'),
    'encryption' => env('MAIL_ENCRYPTION'),
    'username' => env('MAIL_USERNAME'),
    'password' => env('MAIL_PASSWORD'),
    'sendmail' => '/usr/sbin/sendmail -bs',
    'pretend' => false,

);
