<?php

use App\PackagesTreatments;

class Helpers{

    public static function getTreatmentTick($t_id, $p_id){
        if(PackagesTreatments::where('treatment_id',$t_id)->where('package_id',$p_id)->count() > 0)
            $value = 'yes';
        else
            $value = 'no';

        return $value;
    }

}