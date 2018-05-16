<?php
/**
 * Created by PhpStorm.
 * User: kokil
 * Date: 1/18/16
 * Time: 11:55 AM
 */

namespace Modules\Events\Entities;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;
use DB;

class EventRegistrationType extends Model implements SluggableInterface
{

    use SluggableTrait;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'event_registration_type';

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
    protected $fillable = ['name', 'slug', 'description', 'is_active', 'added_by', 'updated_by'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['created_at', 'updated_at'];

}