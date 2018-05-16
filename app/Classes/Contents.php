<?php
/**
 * Created by PhpStorm.
 * User: kokil
 * Date: 1/21/16
 * Time: 1:02 PM
 */
namespace App\Classes;

use Modules\Content\Entities\Content;
class Contents
{
    public static function getContentByParentId($id)
    {
        return Content::with('photo')->where('parent_id',$id)->where('is_active',1)->get();

    }
}