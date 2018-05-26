<?php namespace Modules\Gallery\Entities;
   
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class News extends Model {

    use SoftDeletes;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'news';

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
   

    protected $fillable = ['title','image','description','created_by','updated_at'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['created_at', 'updated_at'];




      public function photo()
    {
        return $this->morphOne('Modules\News\Entities\News', 'imageable');
    }

}