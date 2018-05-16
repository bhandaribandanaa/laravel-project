<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Modules\Configuration\Entities\UserType;

use Auth;
use Redirect;
use Input;
use Session;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'getLogout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }


    public function redirectLogin()
    {
        return redirect()->route('admin.login');
    }

    public function getLogin()
    {
        Auth::logout();
        return view('admin.login');
    }

    public function postLogin()
    {

        $rules = array(
            'username' => 'required | exists:users',
            'password' => 'required'
        );
        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) return redirect()->back()->withInput()->with('error', 'Username and password field required.');

        $auth = Auth::attempt(['username' => Input::get('username'), 'password' => Input::get('password'), 'is_active' => 1]);
        if ($auth) {
            $usertype = UserType::with(['modules'=> function($query){
                $query->where('modules.is_active', 1);
            }])->find(Auth::user()->user_type);

            Session::put('modules', $usertype->modules);
            return Redirect::route('admin.dashboard');
        }
        return redirect()->back()->withInput()->with('error', 'Invalid username or password. Please try again.');
    }

    public function getLogout()
    {
        Auth::logout();
        return Redirect::route('admin.login');
    }
}
