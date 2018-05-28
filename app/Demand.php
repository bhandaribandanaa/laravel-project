<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;

class Demand extends Model
{
	use SluggableTrait;

    protected $table = 'demand';

    protected $sluggable = [
        'build_from' => 'full_name',
        'save_to' => 'slug',
    ];


     protected $fillable = ['job_position', 'salary','type', 'request_number', 'fooding','accomodation','created_at'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [ 'updated_at', 'deleted_at'];



}
