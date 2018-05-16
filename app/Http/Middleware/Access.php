<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Illuminate\Contracts\Auth\Guard;
use Modules\Configuration\Entities\UserType;
use App\Facades\Access as AccessFacade;

/**
* @auther Sunil Adhikari <adhikarysunil.1@gmail.com>
*/

class Access
{
    /**
     * The Guard implementation.
     *
     * @var Guard
     */
    protected $access;

    /**
     * Create a new filter instance.
     *
     * @param  Guard  $access
     * @return void
     */
    public function __construct(Guard $access)
    {
        $this->access = $access;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $module_slug, $action)
    {
       $usertype = UserType::with(['modules'=> function($query){
            $query->where('modules.is_active', 1);
        }])->find(Auth::user()->user_type);

        $request->session()->put('modules', $usertype->modules);

        $flag = AccessFacade::hasAccess($module_slug, $action);
        
        if ($this->access->guest() || !$flag) {
            if ($request->ajax()) {
                return response('Unauthorized.', 401);
            } else {
                return view('admin/denied');
            }
        }
        return $next($request);
    }
}
