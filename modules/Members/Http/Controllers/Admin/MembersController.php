<?php namespace Modules\Members\Http\Controllers\Admin;

use App\Classes\Email;
use App\User;
use Auth;
use Hash;
use Input;
use Modules\Members\Entities\Members;
use Modules\Members\Entities\MemberType;
use Pingpong\Modules\Routing\Controller;
use Validator;

/**
 * Controller used to manage members in admin part.
 *
 * @author Kokil Thapa <thapa.kokil@gmail.com>
 */
class MembersController extends Controller
{

    public function index()
    {
        $paginate = 10;
        $members = Members::with('memberType')->where('is_existing_member', 1)->orderBy('created_at', 'desc')->paginate($paginate);
        $members->setPath('');
        return view('members::admin.index')->with(array('members' => $members));
    }

    public function newMembers()
    {
        $paginate = 10;
        $members = Members::with('memberType')->where('is_existing_member', 0)->paginate($paginate);
        $members->setPath('');
        return view('members::admin.new_members')->with(array('members' => $members));
    }

    public function add()
    {
        $memberType = MemberType::where('is_active', 1)->lists('member_type_name', 'id');
        return view('members::admin.add')->with(array('member_type' => $memberType->toArray()));
    }

    public function create()
    {
        $rules = array(
            'member_type' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:members,email',
            'address' => 'required',
            'mobile_no' => 'required',
            'nmc_no' => 'required',
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
        ];

        $validator = Validator::make(Input::all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {

            $password = str_random(10);
            $objectMember = new Members();
            $objectMember->member_type = Input::get('member_type');
            $objectMember->membership_no = Input::get('membership_no');
            $objectMember->registration_via = '0';
            $objectMember->salutation = 'Dr';
            $objectMember->first_name = Input::get('first_name');
            $objectMember->middle_name = Input::get('middle_name');
            $objectMember->last_name = Input::get('last_name');
            $objectMember->email = Input::get('email');
//            $objectMember->password = Hash::make($password);
            $objectMember->address = Input::get('address');
            $objectMember->phone_no = Input::get('phone_no');
            $objectMember->mobile_no = Input::get('mobile_no');
            $objectMember->organization = Input::get('organization');
            $objectMember->designation = Input::get('designation');
            $objectMember->nmc_no = Input::get('nmc_no');
            $objectMember->is_active = Input::get('is_active');
            $objectMember->created_by = Auth::user()->id;
            if (Input::file('member_photo')) {
                $destinationPath = 'uploads/member'; // upload path
                $extension = Input::file('member_photo')->getClientOriginalExtension(); // getting image extension
                $fileName = 'member_' . str_random(20) . '.' . $extension; // renameing image
                Input::file('member_photo')->move($destinationPath, $fileName); // uploading file to given path
                $objectMember->member_photo = $fileName;
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
            $objectUser->is_active = '1';
            $objectUser->save();
            // inserting to user table ends


            if ($objectMember->id) {
                // send email and password to member
                $subject = "User Account Created.";
                $content = '<br><strong>Dear ' . Input::get('first_name') . ' '. Input::get('middle_name') .' ' . Input::get('last_name') . ' </strong><br /><p>Your account to: Simon.org.np has been created</p><p><strong>Login detail:</strong><br>
                Username : ' . Input::get('email') . '<br/>
                Password : ' . $password . '<br/>
                Please Click <a href="' . route('member.login') . '">Here</a> to visit the site.
                </p>';
                Email::sendEmail(Input::get('email'), $subject, $content);
                return redirect()->route('admin.member.index')->withInput()->with('success', 'Member added successfully.');
            } else {
                return redirect()->back()->withInput();
            }
        }
    }

    public function edit($id)
    {
        $memberType = MemberType::where('is_active', 1)->lists('member_type_name', 'id');
        $member = Members::findOrFail($id);
        return view('members::admin.edit')->with(array('member' => $member, 'member_type' => $memberType->toArray()));
    }

    public function update($id)
    {
        $rules = array(
            'member_type' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
//            'email' => 'required|email|unique:members,email,' . $id,
            'address' => 'required',
            'mobile_no' => 'required',
            'nmc_no' => 'required',
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
        ];

        $validator = Validator::make(Input::all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {

            $objectMember = Members::findOrFail($id);
            $objectMember->salutation = Input::get('salutation');
            $objectMember->member_type = Input::get('member_type');
            $objectMember->membership_no = Input::get('membership_no');
            $objectMember->registration_via = '0';
            // $objectMember->salutation = 'Dr';
            $objectMember->first_name = Input::get('first_name');
            $objectMember->middle_name = Input::get('middle_name');
            $objectMember->last_name = Input::get('last_name');
//            $objectMember->email = Input::get('email');
            $objectMember->address = Input::get('address');
            $objectMember->phone_no = Input::get('phone_no');
            $objectMember->mobile_no = Input::get('mobile_no');
            $objectMember->organization = Input::get('organization');
            $objectMember->designation = Input::get('designation');
            $objectMember->nmc_no = Input::get('nmc_no');
//            $objectMember->is_active = Input::get('is_active');
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

                return redirect()->route('admin.member.index')->withInput()->with('success', 'Member updated successfully.');
            } else {
                return redirect()->back()->withInput();
            }
        }
    }

    public function changeStatus()
    {
        $rules = ['id' => 'required'];
        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'message' => $validator->errors()->all()]);
        }

        try {
            $objectMember = Members::findOrFail(Input::get('id'));
            $objectUser = User::where('member_id', $objectMember->id)->first();
            if ($objectMember->is_active == '1') {
                $objectMember->is_active = 0;
                $objectUser->is_active = 0;
                $message = 'Member deactivate successfully.';
            } else {
                $objectMember->is_active = 1;
                $objectUser->is_active = 1;
                $message = 'Member Approved successfully.';

                // email admin with approved message
                $subject = "Simon User Account Activated.";
                $content = '<br><strong>Dear ' . $objectMember->first_name . ' '. $objectMember->middle_name.' ' . $objectMember->last_name . ' </strong><br /><p>Your account to: Simon.org.np has been Activated.</p>
                Please Click <a href="' . route('member.login') . '">Here</a> to visit the site.
                </p>';
                $email = Email::sendEmail($objectMember->email, $subject, $content);
            }
            $objectUser->save();
            $objectMember->save();

            return response()->json(['status' => true, 'message' => $message, 'is_active' => $objectMember->is_active]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['status' => false, 'message' => Input::get('id')]);
        }
    }

    public function delete()
    {
        $rules = ['id' => 'required'];
        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails())
            return response()->json(['status' => false, 'message' => $validator->errors()->all()]);

        try {
            $objectMember = Members::findOrFail(Input::get('id'))->delete();
            return response()->json(['status' => true, 'message' => 'Member deleted successfully.']);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['status' => false, 'message' => 'Access denied.']);
        }
    }

    public function getNewMemberInfo($id)
    {
        $member = Members::findOrFail($id);
        return view('members::admin.view_member_info')->with(array('member' => $member));
    }

    //For existing member info
    public function getExistingMemberInfo($id)
    {
        $member = Members::findOrFail($id);
        return view('members::admin.view_existing_member_info')->with(array('member' => $member));
    }

    public function approveNewMember($memberId)
    {
        $ObjectMemberInfo = Members::find($memberId);
        $ObjectUserInfo = User::where('member_id', $ObjectMemberInfo->id)->first();
        $password = str_random(10);

        $ObjectUserInfo->password = Hash::make($password);
        $ObjectUserInfo->is_active = 1;
        $ObjectUserInfo->save();

        $ObjectMemberInfo->is_active=1;
        $ObjectMemberInfo->is_existing_member=1;
        $ObjectMemberInfo->save();
            // send email and password to member
            $subject = "Registration Acknowledgement.";
            $content = '<br><strong>Dear ' . $ObjectUserInfo->first_name . ' ' . $ObjectUserInfo->middle_name . ' ' . $ObjectUserInfo->last_name . ' </strong><br /><p>Thank you for your registration with SIMON. </p><p>Your Account to Simon has been approved. <br /> <strong>Your Login detail:</strong><br>
                Username : ' . $ObjectUserInfo->email_address . '<br/>
                Password : ' . $password . '<br/>
                URL      : '.route('member.login').'<br />
                </p><p>If you have any question regarding your account activitaiton, please contact our office Secretary Mr. Arjun Bahadur Chand [+977 9851206644 ].</p><p><storng>Regards,<br>SIMON<br>simonnepal@gmail.com</storng></p>';
            Email::sendEmail($ObjectUserInfo->email_address, $subject, $content);
            return redirect()->route('admin.member.new.index')->withInput()->with('success','Member '. $ObjectUserInfo->first_name . ' ' . $ObjectUserInfo->middle_name . ' ' . $ObjectUserInfo->last_name.' has been Approved and Activated Successfully.');

    }
}