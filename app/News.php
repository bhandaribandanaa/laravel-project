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


     protected $fillable = ['category_id', 'slug','title', 'image', 'description', 'published_date', 'created_at', 'updated_at'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['created_at', 'updated_at'];



}
