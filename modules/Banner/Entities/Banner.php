<?php namespace Modules\Banner\Entities;
   
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Banner extends Model {

    use SoftDeletes;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'banner';
    protected $fillable = ['title','description','image','url','button_label','is_active','added_by','updated_by'];

}