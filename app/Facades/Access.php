<?php namespace App\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @auther Sunil Adhikari <adhikarysunil.1@gmail.com>
 */
class Access extends Facade
{

    protected static function getFacadeAccessor()
    {
        return 'access';
    }
}
