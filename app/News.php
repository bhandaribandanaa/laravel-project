<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;

class News extends Model
{
	use SluggableTrait;

    protected $table = 'news';

    protected $sluggable = [
        'build_from' => 'full_name',
        'save_to' => 'slug',
    ];
}
