<?php
/**
 * Created by PhpStorm.
 * User: kokil
 * Date: 2/1/16
 * Time: 12:36 PM
 */

namespace modules\Members\Http\Controllers;

use Pingpong\Modules\Routing\Controller;

use Auth;
use Session;
use Input;
use Validator;
use Hash;
use Request;
use App\Classes\Email;
use Config;
use App\User;


class AuthController extends Controller
{

    /**
     * Instantiate a new UserController instance.
     */
    public function __construct()
    {
//        Config::set( 'auth.model' , 'Modules\Members\Entities\Members' );
//        Config::set( 'auth.table' , 'members' );
    }

    public function getLogin()
    {
        return view('members::auth.login');
    }

    public function postLogin()
    {
        $auth = Auth::attempt(array(
            'username' => Input::get('username'),
            'password' => Input::get('password'),
            'is_active' => 1));
        if ($auth) {
            return redirect()->route('member.dashboard');
        } else {
            return view('members::auth.login')->with('error', 'Invalid username or password. Please try again.');
        }
    }

    public function getForgetPasswordRequest()
    {
        return view('members::auth.forget_password');
    }

    public function forgetPasswordRequest()
    {
        $rules = array(
            'email' => 'required|email'
        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return redirect()->route('member.forget.password')
                ->withErrors($validator)
                ->withInput();
        } else {

            $user = User::where('username', Input::get('email'))->where('user_type', '3')->first();
            if (count($user) == 1) {
                $password_reset_token = str_random(60);
                $user->password_reset_token = $password_reset_token;
                $user->save();

                $receiverEmail = $user->email_address;
                $subject = "Account Password Reset";

                $content = 'Dear ' . $user->first_name . ' ' . $user->last_name . '<br>You have requested to reset your account password. Please click the link below to change your password. <br>';
                $content .= '<a href=" ' . route('member.password_reset', $password_reset_token) . ' " target="_blank">' . route('member.password_reset', $password_reset_token) . '.</a>';

                $email = Email::sendEmail($receiverEmail, $subject, $content);
                return redirect()->route('member.login')->withInput()->with('success', 'Email sent to provided email.Please check your email for further instructions.');

            } else {

                return redirect()->route('member.forget.password')->withInput()->with('pass_error', 'The email you supplied does not exist in our system .');
            }


        }

    }

    public function getReset($token)
    {
        if (is_null($token)) {
            throw new NotFoundHttpException;
        }

        $user = User::where('password_reset_token', $token)->first();
        if (count($user) == 1) {
            return view('members::auth.reset')->with('token', $token);
        } else {
            return redirect()->route('home');
        }
    }

    public function postReset($token)
    {
        if (is_null($token)) {
            throw new NotFoundHttpException;
        }
        $rules = array(
            'password' => 'required|min:6 ',
            'confirm_password' => 'required|same:password',
        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return redirect()->route('member.password_reset', $token)
                ->withErrors($validator)
                ->withInput();
        } else {
            $user = User::where('password_reset_token', $token)->first();
            $user->password = Hash::make(Input::get('password'));
            $user->password_reset_token = '';
            $userUpdate = $user->save();
            if ($userUpdate) {

                $receiverEmail = $user->email_address;
                $subject = "Your password has been changed";

                $content = 'Dear ' . $user->first_name . ' ' . $user->last_name . '<br>The password for the SIMON account associated with this email address, ' . $user->email_address . ', has been changed as of ' . $user->updated_at . ' <br>';
                $content .= 'Your password was changed by a user at the following IP address: ' . Request::ip() . '';

                $email = Email::sendEmail($receiverEmail, $subject, $content);

            }
            return redirect()->route('member.login')->withInput()->with('success', 'Your password has been changed.');

        }
    }

    public function memberLogout()
    {
        Session::flush();
        Auth::logout();
        return redirect()->route('member.login');
    }

    public function changePasswordRequest()
    {
        return view('members::auth.change-password');
    }

    public function changePassword()
    {
        $user = Auth::user();

        $rules = array(
            'old_password' => 'required',
            'password' => 'required|min:6 ',
            'confirm_password' => 'required|same:password',
        );
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()) {
            return redirect()->route('member.change.password')->withErrors($validator)->withInput();
        } else {

            if (Hash::check(Input::get('old_password'), $user->password)) {
                $user->password = bcrypt(Input::get('password'));
                $user->save();
                return redirect()->route('member.change.password')->withInput()->with('success', 'Password changed successfully.');

            } else {
                return redirect()->route('member.change.password')->withInput()->with('error', 'Old Password doesnot match - please try again.');
            }
        }

    }

}