<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{

    protected $table = 'contact';

     public function contact(){
    	
    	 Contact::count();
    }
    

   

}