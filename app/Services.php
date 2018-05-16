<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;

class Services extends Model
{
    use SluggableTrait;

    protected $table = 'services';

    protected $sluggable = [
        'build_from' => 'title',
        'save_to' => 'slug',
    ];
}
