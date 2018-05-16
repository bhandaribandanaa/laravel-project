<?php
/**
 * Created by PhpStorm.
 * User: kokil
 * Date: 1/18/16
 * Time: 11:55 AM
 */

namespace Modules\Events\Entities;

use DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Participants extends Model
{
    use SoftDeletes;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'participants';

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['event_id', 'event_registration_type', 'registration_via', 'salutation', 'first_name', 'middle_name', 'last_name', 'address', 'phone_no', 'mobile_no', 'email', 'organization', 'designation', 'spouse_name', 'barcode', 'payment_status', 'receipt_no', 'remarks', 'is_active', 'created_by', 'updated_by'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['created_at', 'updated_at'];


    public function event()
    {
        return $this->belongsTo('Modules\Events\Entities\Events', 'event_id');
    }

    public function eventRegistrationType()
    {
        return $this->belongsTo('Modules\Events\Entities\EventRegistrationType', 'event_registration_type');
    }

    public function attendance()
    {
        return $this->belongsTo('Modules\Events\Entities\EventAttendence', 'id', 'participant_id');
    }

    public function lunch()
    {
        return $this->belongsTo('Modules\Events\Entities\EventLunch', 'id', 'participant_id');
    }

    public function dinner()
    {
        return $this->belongsTo('Modules\Events\Entities\EventDinner', 'id', 'participant_id');
    }


    public static function listParticipants($eventId = '', $payment_status = '', $event_registration_type = '')
    {
        $query = Participants::select('participants.*');
        if ($eventId)
            $query->where('event_id', $eventId);
        if ($payment_status) {
            if ($payment_status === '3') {
                $query->where('payment_status', '0');
            } else {
                $query->where('payment_status', $payment_status);
            }
        }
        if ($event_registration_type)
            $query->where('event_registration_type', $event_registration_type);
        return $query->orderBy('participants.id', 'desc')->paginate('500');
    }

}