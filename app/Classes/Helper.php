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
use Modules\Media\Entities\Media;
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

    public static function getMainMenus() {
        return Contact::where('status','active')->where('deleted_at',null)->get();
    }

    public static function getJobCategories() {
        return Content::with(['children' => function ($query) {
            $query->where('is_active',1);
            $query->orderBy('order_postition','ASC');
        }])->where('is_active',1)->where('parent_id',20)->orderBy('order_postition','ASC')->get();
   }

    public static function getContact(){

         return Content::where('is_active',1)->where('id',35)->get();   
    }

     public static function getEducation(){

         return Content::where('is_active',1)->where('id',36)->get();   
    }
    public static function getEducationImg(){

         return Media::where('is_active',1)->where('id',41)->get();   
    }

    public static function getAboutNepal(){

         return Content::where('is_active',1)->where('id',42)->get();   
    }

    public static function getAboutNepalImg(){

         return Media::where('is_active',1)->where('id',43)->get();   
    }

    public static function getRecruitNepal(){

         return Content::where('is_active',1)->where('id',43)->get();   
    }
    public static function getRecruitNepalImg(){

         return Media::where('is_active',1)->where('id',44)->get();   
    }
    public static function getWelcome(){

         return Content::where('is_active',1)->where('id',37)->get();   
    }
    
    public static function getService() {
        return Content::with(['children' => function ($query) {
            $query->where('is_active',1);
            $query->orderBy('order_postition','ASC');
        }])->where('is_active',1)->where('parent_id',38)->orderBy('order_postition','ASC')->get();
   }

    public static function getCategory() {
        return Content::with(['children' => function ($query) {
            $query->where('is_active',1);
            $query->orderBy('order_postition','ASC');
        }])->where('is_active',1)->where('parent_id',44)->orderBy('order_postition','ASC')->get();
   } 
    public static function getHeaderAbout() {
        return Content::with(['children' => function ($query) {
            $query->where('is_active',1);
            $query->orderBy('order_postition','ASC');
        }])->where('is_active',1)->where('parent_id',51)->orderBy('order_postition','ASC')->get();
   } 
    public static function getBusiness(){

         return Content::where('is_active',1)->where('id',30)->get();
       
    }

    public static function getCompanyintro(){

         return Content::where('is_active',1)->where('id',52)->get();
       
    }

    public static function getRecruit(){

         return Content::where('is_active',1)->where('id',31)->get();
       
    }
     public static function getAbtUs(){

         return Content::where('is_active',1)->where('id',55)->get();
       
    }
    public static function getAbtUsImg(){

         return Media::where('is_active',1)->where('id',31)->get();
       
    }
     public static function getVision(){

         return Content::where('is_active',1)->where('id',58)->get();
       
    }
    public static function getVisionImg(){

         return Media::where('is_active',1)->where('id',36)->get();
       
    }
    public static function getMissionImg(){

         return Media::where('is_active',1)->where('id',35)->get();
       
    }

    public static function getMision(){

         return Content::where('is_active',1)->where('id',57)->get();
       
    }
    public static function getProcedure(){

         return content::where('is_active',1)->where('id',60)->get();
       
    }
     public static function getMessage(){

         return Content::where('is_active',1)->where('id',53)->get();
       
     }
      public static function getMessageImg(){

         return Media::where('is_active',1)->where('id',40)->get();
       
     }
     public static function getTurkish(){

         return Content::where('is_active',1)->where('id',40)->get();
       
     }
    public static function getTutkishImg(){

         return Media::where('is_active',1)->where('id',42)->get();
       
    }
     public static function getProfessional(){

         return Content::where('is_active',1)->where('id',22)->get();
       
     }
       public static function getSkilled(){

         return Content::where('is_active',1)->where('id',23)->get();
       
     }
    public static function getSemiskilled(){

         return Content::where('is_active',1)->where('id',25)->get();
       
     }
    public static function getHotel(){

         return Content::where('is_active',1)->where('id',26)->get();
       
     }
    public static function getUnskilled(){

         return Content::where('is_active',1)->where('id',27)->get();
       
     }
    public static function getDomestic(){

         return Content::where('is_active',1)->where('id',32)->get();  
     }
     
    public static function getInnervision(){

         return Content::where('is_active',1)->where('id',61)->get();
       }
    public static function getInnervisionImg(){

         return Media::where('is_active',1)->where('id',46)->get();
       
     }
    public static function getProfessionalImg(){

         return Media::where('is_active',1)->where('id',47)->get();
       
     }
    public static function getSkilledImg(){

         return Media::where('is_active',1)->where('id',48)->get(); 
     }

    public static function getUnskilledImg(){

         return Media::where('is_active',1)->where('id',51)->get();  
     }

    public static function getSemiskilledImg(){

         return Media::where('is_active',1)->where('id',49)->get();
       
     }
    public static function getHotelImg(){

         return Media::where('is_active',1)->where('id',50)->get();
       
     }
    public static function getDomesticImg(){

         return Media::where('is_active',1)->where('id',52)->get(); 
     }

    public static function settings(){

    $settings = \Modules\Setting\Entities\Setting::lists('value', 'slug')->toArray();
    return Setting::lists('value','slug');
   }    
}

    

