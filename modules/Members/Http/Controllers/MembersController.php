<?php namespace Modules\Members\Http\Controllers;

use App\Classes\Email;
use App\User;
use Auth;
use Hash;
use Input;
use Modules\Members\Entities\Members;
use Modules\Members\Entities\MemberType;
use Pingpong\Modules\Routing\Controller;
use Validator;

class MembersController extends Controller
{

    public function index()
    {
        return view('members::index');
    }

    public function dashboard()
    {
        $userInfo = Members::find(Auth::user()->member_id);
        return view('members::dashboard')->with(array('userInfo' => $userInfo));
    }

    public function editProfile()
    {
        $userInfo = Members::find(Auth::user()->member_id);
        return view('members::update_info')->with(array('userInfo' => $userInfo));
    }

    public function updateProfile()
    {
        $rules = array(
            'first_name' => 'required',
            'last_name' => 'required',
            // 'address' => 'required',
            // 'mobile_no' => 'required',
            'nmc_no' => 'required',
            'membership_no' => 'required',
            // 'about' => 'required',
            'member_photo' => 'mimes:jpeg,jpg,png,gif|max:1024',
            'facebook_url' => 'url',
            'linkedin_url' => 'url',
            'twitter_url' => 'url',
        );
        $messages = [
            'first_name.required' => 'The First name is required.',
            'last_name.required' => 'The last name is required.',
            'email.required' => 'The email is required.',
            'address.required' => 'The address is required.',
            'mobile_no.required' => 'The Mobile number is required.',
            'nmc_no.required' => 'The NMC number is required.',
            'membership_no.required' => 'The Membership  number is required.',
            'about.required' => 'The About field is required.',
            'member_photo.mimes' => 'The choose profile image with gif,png, jpeg extension.',
            'member_photo.max' => 'Profile image should not exceed more than 1mb.',
            'facebook_url.url' => 'Please enter valid facebook url',
            'linkedin_url.url' => 'Please enter valid linked url',
            'twitter_url.url' => 'Please enter valid twitter url',
        ];

        $validator = Validator::make(Input::all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {

            $objectMember = Members::find(Auth::user()->member_id);
            $objectMember->membership_no = Input::get('membership_no');
            $objectMember->first_name = Input::get('first_name');
            $objectMember->last_name = Input::get('last_name');
            $objectMember->address = Input::get('address');
            $objectMember->phone_no = Input::get('phone_no');
            $objectMember->mobile_no = Input::get('mobile_no');
            $objectMember->organization = Input::get('organization');
            $objectMember->designation = Input::get('designation');
            $objectMember->nmc_no = Input::get('nmc_no');
            $objectMember->about = Input::get('about');
            $objectMember->interests = Input::get('interests');
            $objectMember->facebook_url = Input::get('facebook_url');
            $objectMember->linkedin_url = Input::get('linkedin_url');
            $objectMember->twitter_url = Input::get('twitter_url');
            $objectMember->updated_by = Auth::user()->id;
            if (Input::file('member_photo')) {
                $destinationPath = 'uploads/member'; // upload path
                $extension = Input::file('member_photo')->getClientOriginalExtension(); // getting image extension
                $fileName = 'member_' . str_random(20) . '.' . $extension; // renameing image
                Input::file('member_photo')->move($destinationPath, $fileName); // uploading file to given path
                $objectMember->member_photo = $fileName;
            }
            $objectMember->save();

            if ($objectMember->id) {
                return redirect()->route('member.dashboard')->withInput()->with('success', 'Profile updated successfully.');
            } else {
                return redirect()->back()->withInput();
            }
        }
    }

    public function getLifeTimeMember()
    {
        // lifetime member
        $pagination = 10;
        $members = Members::where('member_type', '1')->where('is_active', '1')->paginate($pagination);
        $members->setPath('');
        return view('members::life_members')->with(array('members' => $members));
    }

    public function getAssociateMember()
    {
        // associative member
        $pagination = 10;
        $members = Members::where('member_type', '2')->where('is_active', '1')->paginate($pagination);
        $members->setPath('');
        return view('members::associative_members')->with(array('members' => $members));

    }

    public function memberInfo($id)
    {
        $memberInfo = Members::find($id);
        return view('members::member_info')->with(array('memberInfo' => $memberInfo));

    }

    public function getRegister()
    {
        $memberType = MemberType::where('is_active', 1)->lists('member_type_name', 'id');
        return view('members::register')->with(array('member_type' => $memberType->toArray()));
    }

    public function postRegister()
    {

        $rules = array(
            'member_type' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:members,email',
            'address' => 'required',
            'mobile_no' => 'required',
//            'nmc_no' => 'required',
        );
        $messages = [
            'member_type.required' => 'The Member Type is required.',
            'first_name.required' => 'The First name is required.',
            'last_name.required' => 'The last name is required.',
            'email.required' => 'The email is required.',
            'email.email' => 'The valid email is required.',
            'address.required' => 'The address is required.',
            'mobile_no.required' => 'The Mobile number is required.',
//            'nmc_no.required' => 'The NMC number is required.',
        ];

        $validator = Validator::make(Input::all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {

            $password = str_random(10);
            $objectMember = new Members();
            $objectMember->member_type = Input::get('member_type');
            $objectMember->membership_no = Input::get('membership_no');
            $objectMember->registration_via = '1';
            $objectMember->salutation = Input::get('salutation');
            $objectMember->first_name = Input::get('first_name');
            $objectMember->middle_name = Input::get('middle_name');
            $objectMember->last_name = Input::get('last_name');
            $objectMember->email = Input::get('email');
            $objectMember->address = Input::get('address');
            $objectMember->phone_no = Input::get('phone_no');
            $objectMember->mobile_no = Input::get('mobile_no');
            $objectMember->organization = Input::get('organization');
            $objectMember->designation = Input::get('designation');
            $objectMember->nmc_no = Input::get('nmc_no');
            $objectMember->is_active = '0';
            $objectMember->save();

            // inserting to user table

            $objectUser = new User();
            $objectUser->user_type = '3';
            $objectUser->member_id = $objectMember->id;
            $objectUser->username = Input::get('email');
            $objectUser->email_address = Input::get('email');
            $objectUser->password = Hash::make($password);
            $objectUser->full_name = Input::get('first_name') . ' ' . Input::get('last_name');
            $objectUser->first_name = Input::get('first_name');
            $objectUser->last_name = Input::get('last_name');
            $objectUser->is_active = '0';
            $objectUser->save();
            // inserting to user table ends


            if ($objectMember->id) {
                // send email and password to member
                $subject = "Registration Acknowledgement.";
                $content = '<br><strong>Dear ' . Input::get('first_name') . ' ' . Input::get('middle_name') . ' ' . Input::get('last_name') . ' </strong><br /><p>Thank you for your registration with SIMON. </p><p><strong>Login detail:</strong><br>
                Username : ' . Input::get('email') . '<br/>
                Password : ' . $password . '<br/>
                You account status is pending. You will be notified  you when your account is activated..
                </p><p>If you have any question regarding your account activitaiton, please contact our office Secretary Mr. Arjun Bahadur Chand [+977 9851206644 ].</p><p><storng>Regards,<br>SIMON<br>simonnepal@gmail.com</storng></p>';
                Email::sendEmail(Input::get('email'), $subject, $content);
                return redirect()->route('member.login')->withInput()->with('success', 'Registration Success. Please Check your email for login Information.');
            } else {
                return redirect()->back()->withInput();
            }
        }
    }

    public function getNewMemberRegistration()
    {
        $memberType = MemberType::where('is_active', 1)->lists('member_type_name', 'id');
        return view('members::new_register')->with(array('member_type' => $memberType->toArray()));
    }

    public function postNewMemberRegistration()
    {

        $rules = array(
            'member_type' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:members,email',
            'address' => 'required',
            'mobile_no' => 'required',
            'nmc_no' => 'required',
            'membership_form' => 'required|max:1000|mimes:jpeg,jpg,png,pdf',
            'atachment2' => 'required|max:1000||mimes:jpeg,jpg,png,pdf',
            'atachment3' => 'required|max:1000|mimes:jpeg,jpg,png,pdf',
        );
        $messages = [
            'member_type.required' => 'The Member Type is required.',
            'first_name.required' => 'The First name is required.',
            'last_name.required' => 'The last name is required.',
            'email.required' => 'The email is required.',
            'email.email' => 'The valid email is required.',
            'address.required' => 'The address is required.',
            'mobile_no.required' => 'The Mobile number is required.',
            'nmc_no.required' => 'The NMC number is required.',
            'membership_form.required' => 'The membership form scan copy is required.',
            'atachment2.required' => 'The Scan Copy of NMC Certificate is required.',
            'atachment3.required' => 'The Scan Copy of Citizenship is required.',
            'membership_form.mimes' => 'The membership_form not valid. accept only image with extension jpg,png,gif and pdf.',
            'atachment2.mimes' => 'The Scan Copy of NMC Certificate  not valid. accept only image with extension jpg,png,gif and pdf .',
            'atachment3.mimes' => 'The Scan Copy of Citizenship not valid. accept only image with extension jpg,png,gif and pdf .',
            'membership_form.max' => 'The membership form scan should not be more than 1 mb.',
            'atachment2.max' => 'The Scan Copy of NMC Certificate  should not be more than 1 mb.',
            'atachment3.max' => 'The Scan Copy of Citizenship should not be more than 1 mb.',
        ];

        $validator = Validator::make(Input::all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {

            $password = str_random(10);
            $objectMember = new Members();
            $objectMember->member_type = Input::get('member_type');
            $objectMember->registration_via = '1';
            $objectMember->salutation = Input::get('salutation');
            $objectMember->first_name = Input::get('first_name');
            $objectMember->middle_name = Input::get('middle_name');
            $objectMember->last_name = Input::get('last_name');
            $objectMember->email = Input::get('email');
            $objectMember->address = Input::get('address');
            $objectMember->phone_no = Input::get('phone_no');
            $objectMember->mobile_no = Input::get('mobile_no');
            $objectMember->organization = Input::get('organization');
            $objectMember->designation = Input::get('designation');
            $objectMember->nmc_no = Input::get('nmc_no');
            $objectMember->is_active = '0';
            $objectMember->is_existing_member = '0';
            if (Input::file('membership_form')) {
                $destinationPath = 'uploads/member'; // upload path
                $extension = Input::file('membership_form')->getClientOriginalExtension(); // getting image extension
                $attachment1 = 'attachment_1_' . str_random(20) . '.' . $extension; // renameing image
                Input::file('membership_form')->move($destinationPath, $attachment1); // uploading file to given path
                $objectMember->attachment_1 = $attachment1;
            }
            if (Input::file('atachment2')) {
                $destinationPath = 'uploads/member'; // upload path
                $extension = Input::file('atachment2')->getClientOriginalExtension(); // getting image extension
                $atachment2 = 'atachment_2_' . str_random(20) . '.' . $extension; // renameing image
                Input::file('atachment2')->move($destinationPath, $atachment2); // uploading file to given path
                $objectMember->attachment_2 = $atachment2;
            }
            if (Input::file('atachment3')) {
                $destinationPath = 'uploads/member'; // upload path
                $extension = Input::file('atachment3')->getClientOriginalExtension(); // getting image extension
                $atachment3 = 'atachment_3_' . str_random(20) . '.' . $extension; // renameing image
                Input::file('atachment3')->move($destinationPath, $atachment3); // uploading file to given path
                $objectMember->attachment_3 = $atachment3;
            }
            $objectMember->save();

            // inserting to user table

            $objectUser = new User();
            $objectUser->user_type = '3';
            $objectUser->member_id = $objectMember->id;
            $objectUser->username = Input::get('email');
            $objectUser->email_address = Input::get('email');
            $objectUser->password = Hash::make($password);
            $objectUser->full_name = Input::get('first_name') . ' ' . Input::get('last_name');
            $objectUser->first_name = Input::get('first_name');
            $objectUser->last_name = Input::get('last_name');
            $objectUser->is_active = '0';
            $objectUser->save();
            // inserting to user table ends

            if ($objectMember->id) {
                // send email and password to member
                $subject = "Registration Acknowledgement.";
                $content = '<br><strong>Dear ' . Input::get('first_name') . ' ' . Input::get('middle_name') . ' ' . Input::get('last_name') . ' </strong><br /><p>Thank you for your registration with SIMON. </p><p>Your Application Have Been submitted.
                You account status is pending. You will be notified  you when your account is activated..
                </p><p>If you have any question regarding your account activitaiton, please contact our office Secretary Mr. Arjun Bahadur Chand [+977 9851206644 ].</p><p><storng>Regards,<br>SIMON<br>simonnepal@gmail.com</storng></p>';
                Email::sendEmail(Input::get('email'), $subject, $content);
                return redirect()->route('member.login')->withInput()->with('success', 'Registration submitted Successfully.');
            } else {
                return redirect()->back()->withInput();
            }
        }

    }

}