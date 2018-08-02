<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;

class Countries extends Model
{
    use SluggableTrait;

    protected $table = 'countries';

    protected $sluggable = [
        'build_from' => 'name',
        'save_to' => 'slug',
    ];


     protected $fillable = ['name','image', 'description'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['created_at', 'updated_at','deleted_at'];

   public function demand()
    {
        return $this->hasMany('app\demand', 'country_id');
    }   

    public function activeDemand()
    {
        return $this->demand()
            ->where('status', 'active')
            ->orderBy('created_at');
    }
}
