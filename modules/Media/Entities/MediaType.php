<?php namespace Modules\Media\Entities;

use Illuminate\Database\Eloquent\Model;

class MediaType extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'media_type';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['type_name', 'type_description', 'is_active', 'created_by', 'updated_by'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['created_at', 'updated_at'];

}