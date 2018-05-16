<?php namespace Modules\Members\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
//use Illuminate\Auth\Authenticatable;
//use Illuminate\Auth\Passwords\CanResetPassword;
//use Illuminate\Foundation\Auth\Access\Authorizable;
//use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
//use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
//use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class Members extends Model
//    implements AuthenticatableContract,
//    AuthorizableContract,
//    CanResetPasswordContract
{

//    use Authenticatable, Authorizable, CanResetPassword;
    use SoftDeletes;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'members';

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];
    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['created_at', 'updated_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = ['member_type', 'membership_no', 'registration_via', 'salutation', 'first_name', 'middle_name', 'last_name', 'email', 'address', 'phone_no', 'mobile_no', 'organization', 'designation','member_photo','nmc_no', 'is_active', 'created_by', 'updated_by', 'created_at', 'created_at', 'updated_at'];


    public function memberType()
    {
        return $this->belongsTo('Modules\Members\Entities\MemberType', 'member_type');
    }
}