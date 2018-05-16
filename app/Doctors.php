<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;

class Doctors extends Model
{
    use SluggableTrait;

    protected $table = 'doctors';

    protected $sluggable = [
        'build_from' => 'full_name',
        'save_to' => 'slug',
    ];
    

}
