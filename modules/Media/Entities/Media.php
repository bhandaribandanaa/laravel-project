<?php namespace Modules\Media\Entities;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'media';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['file_name', 'caption', 'type_id', 'imageable_id', 'imageable_type', 'mime_type', 'size_width', 'size_height', 'is_active', 'created_by', 'updated_by'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['created_at', 'updated_at'];

    /**
     * Get all of the owning imageable models.
     */
    public function imageable()
    {
        return $this->morphTo();
    }

}