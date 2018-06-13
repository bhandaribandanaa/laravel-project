<?php
/**
 * Created by PhpStorm.
 * User: kokil
 * Date: 1/21/16
 * Time: 1:02 PM
 */
namespace App\Classes;
use App\Contact;

use Modules\Content\Entities\Content;
use Modules\Events\Entities\Events;
use Modules\Events\Entities\EventType;
use Modules\Members\Entities\Members;
use Modules\Gallery\Entities\Album;
use Modules\Setting\Entities\Setting;
Use Session;
class Helper
{
    public static function getUpcomingEvent()
    {
        return Events::with('eventType','photo')->where('is_active','1')->where('start_date', '>', new \DateTime())->first();
    }

    public static function getEventTypes()
    {
        return EventType::where('is_active',1)->get();
    }

    public static function getMemberInfo($id)
    {
        return Members::find($id);
    }

    public static function getLatestAlbum()
    {
        return  Album::where('is_active',1)->orderBy('id','desc')->first();
    }

    public static function getMainMenu($items = 3)
    {
        return Content::with(['children' => function ($query) {
            $query->where('is_active',1);
            $query->orderBy('order_postition','ASC');
        }])->where('is_active',1)->where('parent_id',0)->orderBy('order_postition','ASC')->take($items)->get();
    }

    public static function getMainMenus()
    {
        return Contact::where('status','active')->where('deleted_at',null)->get();
        }
    


    public static function getJobCategories() {
        return Content::with(['children' => function ($query) {
            $query->where('is_active',1);
            $query->orderBy('order_postition','ASC');
        }])->where('is_active',1)->where('parent_id',20)->orderBy('order_postition','ASC')->get();
   }

    public static function getContact(){

         


       
    }


     public static function getBusiness(){

         return Content::where('is_active',1)->where('id',30)->get();
       
    }

     public static function getAboutUs(){

         return Content::where('is_active',1)->where('id',1)->get();
       
    }

    

    // public static function getTopBar()
    // {
    //     if(!Session::has('settings')){
    //     $settings = \Modules\Setting\Entities\Setting::lists('value', 'slug')->toArray();
    //     Session::put('settings', $settings);

    // }
}

    

