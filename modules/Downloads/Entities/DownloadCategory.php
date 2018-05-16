<?php namespace Modules\Downloads\Entities;
   
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;

class DownloadCategory extends Model implements SluggableInterface {

    use SoftDeletes;
    use SluggableTrait;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'download_category';

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

    protected $fillable = ['name','slug','description','is_active','created_by','updated_by','created_at','updated_at','deleted_at'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['created_at', 'updated_at'];

}