<?php namespace Modules\Content\Entities;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class Content extends Model implements SluggableInterface
{

    use SoftDeletes;
    use SluggableTrait;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'contents';

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * The attributes that are used by Sluggable.
     *
     * @var array
     */
    protected $sluggable = [
        'build_from' => 'heading',
        'save_to' => 'slug',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['parent_id', 'heading', 'slug', 'short_description', 'description', 'page_title', 'meta_tags', 'meta_description', 'order_postition', 'is_active', 'created_by', 'updated_by'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['created_at', 'updated_at'];

    public static function listFooterMenus()
    {
        return Content::where('display_in', 'LIKE', '%2%')->where('is_active', '1')->get();
    }

    /**
     * Get all of the content photos.
     */
    public function photos()
    {
        return $this->morphMany('Modules\Media\Entities\Media', 'imageable');
    }

    /**
     * Get all of the content photos.
     */
    public function photo()
    {
        return $this->morphOne('Modules\Media\Entities\Media', 'imageable');
    }

    public function parent()
    {
        return $this->belongsTo('Modules\Content\Entities\Content', 'parent_id');
    }

    public function displayIn()
    {
        return $this->belongsTo('Modules\Content\Entities\MenuLocation', '');
    }

    public function children()
    {
        return $this->hasMany('Modules\Content\Entities\Content', 'parent_id', 'id');
    }
    public function SubChildren()
    {
        return $this->hasMany('Modules\Content\Entities\Content', 'parent_id', 'id');
    }

    public static function content_list_for_contentEntry($parentId, $level, $selected)
    {
        $contents = DB::table('contents')
            ->where('parent_id', $parentId)
            ->where('is_active', 1)
            ->whereNull('deleted_at')
            ->orderby('id', 'asc')
            ->get();

        $returnList = '<select class="selectpicker" name="parent_id" data-live-search="true" id="parent_id">';
        $returnList .= '<option value="0" selected>Parent Itself</option>';
        foreach ($contents as $content) {
            if ($selected > 0 && $selected == $content->id) {
                $selected_option = 'selected="selected"';
            } else {
                $selected_option = "";
            }

            $returnList .= '<option value="' . $content->id . '" ' . $selected_option . '>' .
                str_repeat('&nbsp;>>&nbsp;', $level) . $content->heading . '</option>';
            $returnList .= self::subcontent_list_for_contentEntry($content->id, $level + 1, $selected);

        }
        $returnList .= '</select>';

        return $returnList;
    }

    public static function subcontent_list_for_contentEntry($parentId, $level, $selected = 0)
    {
        $subcontents = DB::table('contents')
            ->where('parent_id', $parentId)
            ->where('is_active', 1)
            ->whereNull('deleted_at')
            ->orderby('id', 'desc')
            ->get();
        $returnList = '';
        foreach ($subcontents as $subcontent) {
            if ($selected > 0 && $selected == $subcontent->id) {
                $selected_option = 'selected="selected"';
            } else {
                $selected_option = "";
            }
            $returnList .= '<option value="' . $subcontent->id . '" ' . $selected_option . '>' .
                str_repeat('&nbsp;>>&nbsp;', $level) . $subcontent->heading . '</option>';
            $returnList .= self::subcontent_list_for_contentEntry($subcontent->id, $level + 1, $selected);
        }
        return $returnList;
    }


}