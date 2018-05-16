<?php namespace Modules\Content\Entities;

use Illuminate\Database\Eloquent\Model;

class MenuLocation extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'menu_location';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'description', 'is_active', 'created_by', 'updated_by', 'created_at', 'updated_at'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['created_at', 'updated_at'];


}