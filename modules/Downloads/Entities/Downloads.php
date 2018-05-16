<?php namespace Modules\Downloads\Entities;
   
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;

class Downloads extends Model implements SluggableInterface {

    use SoftDeletes;
    use SluggableTrait;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'downloads';

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
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    protected $fillable = ['event_id','categories','slug','access_type','download_type','name','download','description','view_count','is_active','created_at','updated_at','deleted_at'];

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

}