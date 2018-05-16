<?php

use App\PackagesTreatments;
use App\Doctors;
use App\Specializations;
use App\News;
use App\NewsCategory;
use App\Services;

class Helpers{

    public static function getTreatmentTick($t_id, $p_id){
        if(PackagesTreatments::where('treatment_id',$t_id)->where('package_id',$p_id)->count() > 0)
            $value = 'yes';
        else
            $value = 'no';

        return $value;
    }

    public static function getDoctors(){
        $doctors = Doctors::where('status',1)->take(10)->get();
        foreach ($doctors as $doc){
            $doc->specialization = Specializations::where('id',$doc->specialization_id)->pluck('title');
        }
        return $doctors;
    }

    public static function string_limit($string,$limit){
        $name = (strlen($string) > $limit) ? substr($string , 0 , $limit).'...' : $string;
        return strip_tags($name);
    }

    public static function getFormattedDate($date){
        $date = $dt->toFormattedDateString();
        return $date;
    }

    public static function getServices(){
        $services = Services::orderBy('id','desc')->where('status',1)->take(6)->get();
        return $services;
    }

    public static function getBookings($items){
        $bookings = \App\Appointments::orderBy('id','desc')->take(5)->get();
        foreach ($bookings as $b){
            $b->doctor = Doctors::where('id',$b->doctor_id)->pluck('full_name');
        }
        return $bookings;
    }

    public static function getPackageBookings($items){
        $bookings = \App\PackageBookings::orderBy('id','desc')->take(5)->get();
        foreach ($bookings as $b){
            $b->doctor = Doctors::where('id',$b->doctor_id)->pluck('full_name');
            $b->package = \App\Packages::where('id',$b->package_id)->pluck('title');
        }
        return $bookings;
    }

    public static function getAllDoctors(){
        $doctors = Doctors::select('id','full_name')->get();
        return $doctors;
    }


}