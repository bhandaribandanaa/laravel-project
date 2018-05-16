<?php namespace App\Classes;

use Modules\Configuration\Entities\AccessList;
use Modules\Configuration\Entities\UserType;

use Auth;

/**
 * @auther Sunil Adhikari <adhikarysunil.1@gmail.com>
 */
class Permission
{
    public function hasAccess($slug, $action)
    {
        $flag = false;
        $modules = session()->get('modules');
        foreach ($modules as $module) {
            if ($module->slug == $slug) {
                $flag = ($module->pivot->$action == 1) ? true : false;
            }
            if ($flag) break;
        }

        return $flag;
    }
}