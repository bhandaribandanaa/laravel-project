<?php
/**
 * Created by PhpStorm.
 * User: kokil
 * Date: 1/18/16
 * Time: 11:55 AM
 */

namespace Modules\Events\Entities;

use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;
use DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Events extends Model implements SluggableInterface
{
    use SoftDeletes;
    use SluggableTrait;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'events';

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * The attributes that are used by Sluggable.
     *
     * @var array
     */
    protected $sluggable = [
        'build_from' => 'name',
        'save_to' => 'slug',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['event_type_id', 'name', 'slug', 'slogan', 'location', 'longitude', 'latitude', 'start_date', 'end_date', 'start_time', 'end_time', 'no_of_participants', 'description', 'is_active', 'created_by', 'updated_by', 'deleted_by'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['created_at', 'updated_at'];


    public function eventType()
    {
        return $this->belongsTo('Modules\Events\Entities\EventType', 'event_type_id');
    }

    /**
     * Get all of the events photos.
     */
    public function photos()
    {
        return $this->morphMany('Modules\Media\Entities\Media', 'imageable');
    }

    /**
     * Get all of the events photos.
     */
    public function photo()
    {
        return $this->MorphOne('Modules\Media\Entities\Media', 'imageable');
    }

    /*
     * get events contents
     */
    public function contents()
    {
        return $this->hasMany('Modules\Events\Entities\EventsContent', 'event_id', 'id');
    }

}