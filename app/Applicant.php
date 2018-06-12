<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Applicant extends Model
{

    protected $table = 'applicant';
    


    public function demand(){
    	return $this->belongsTo('App\Demand', 'job_id');
    	 Applicant::count();
    }


}