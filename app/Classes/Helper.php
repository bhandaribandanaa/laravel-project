<?php
/**
 * Created by PhpStorm.
 * User: kokil
 * Date: 1/21/16
 * Time: 1:02 PM
 */
namespace App\Classes;

use Modules\Content\Entities\Content;
use Modules\Events\Entities\Events;
use Modules\Events\Entities\EventType;
use Modules\Members\Entities\Members;
use Modules\Gallery\Entities\Album;
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

    public static function getAbout(){
        $about = Content::where('page_title','About')->first();
        $about = (strlen($about->description) > 150) ? substr($about->description , 0 , 150).'...' : $about->description;
        return strip_tags($about);
    }

    

}