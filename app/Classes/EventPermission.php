<?php
/**
 * Created by PhpStorm.
 * User: kokil
 * Date: 3/9/16
 * Time: 10:12 AM
 */

namespace App\Classes;

use Modules\Events\Entities\EventFacilityPermission;


Class  EventPermission
{
    public static function getEventPermissionAdminBy($eventId,$registerType,$facilityId,$date)
    {
        $eventPermission= EventFacilityPermission::where('event_id',$eventId)->where('registration_type_id',$registerType)->where('facility_id',$facilityId)->whereDate('date','=',$date)->first();

        if(count($eventPermission)=='0'){
            return false;
        }else {
            if($eventPermission->permission=='1'){
                return true;
            }else {
                return false;
            }
        }

    }

    public static function getEventPermissionCheckBy($eventId,$registerType,$facilityId,$date)
    {
        $eventPermission= EventFacilityPermission::where('event_id',$eventId)->where('registration_type_id',$registerType)->where('facility_id',$facilityId)->whereDate('date','=',$date)->first();

        if(count($eventPermission)=='0'){
            return "No";
        }else {
            if($eventPermission->permission=='1'){
                return "Yes";
            }else {
                return "No";
            }
        }

    }

}