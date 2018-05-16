<?php namespace Modules\Members\Entities;
   
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

class MemberType extends Model implements SluggableInterface
{
    use SoftDeletes;
    use SluggableTrait;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'members_type';

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
        'build_from' => 'member_type_name',
        'save_to' => 'slug',
    ];

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
    protected $fillable = ['member_type_name','slug','description','is_active','created_by','updated_by','created_at','updated_at'];

}