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

class EventDinner extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'event_dinner';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['participant_id', 'event_id', 'date', 'time', 'created_by','updated_by'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['created_at', 'updated_at'];

}