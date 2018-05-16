<?php
/**
 * Created by PhpStorm.
 * User: kokil
 * Date: 1/18/16
 * Time: 11:55 AM
 */

namespace Modules\Events\Entities;

use Illuminate\Database\Eloquent\Model;
use DB;

class EventFacilityPermission  extends Model
{


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'event_facility_permission';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['event_id', 'registration_type_id', 'facility_id', 'date', 'permission', 'created_by','updated_by','created_at','updated_at'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['created_at', 'updated_at'];

    public function facilityType()
    {
        return $this->belongsTo('Modules\Events\Entities\EventRegistrationTypeFacility', 'facility_id');
    }

}