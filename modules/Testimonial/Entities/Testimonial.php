<?php namespace Modules\Testimonial\Entities;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class Testimonial extends Model implements SluggableInterface
{

    use SoftDeletes;
    use SluggableTrait;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'testimonials';

   
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'company_name', 'image', 'description', 'created_at'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['updated_at', 'deleted_at'];

    public static function listFooterMenus()
    {
        return Testimonial::where('display_in', 'LIKE', '%2%')->where('is_active', '1')->get();
    }

    /**
     * Get all of the testimonial photos.
     */
   

    public static function testimonial_list_for_testimonialEntry($id, $level, $selected)
    {
        $testimonials = DB::table('testimonials')
            ->where('id', $id)
            ->get();

        $returnList = '<select class="selectpicker" name="id" data-live-search="true" id="id">';
        $returnList .= '<option value="0" selected>Parent Itself</option>';
        foreach ($testimonials as $testimonial) {
            if ($selected > 0 && $selected == $testimonial->id) {
                $selected_option = 'selected="selected"';
            } else {
                $selected_option = "";
            }

            $returnList .= '<option value="' . $testimonial->id . '" ' . $selected_option . '>' .
                str_repeat('&nbsp;>>&nbsp;', $level) . $testimonial->name . '</option>';
            $returnList .= self::subtestimonial_list_for_testimonialEntry($testimonial->id, $level + 1, $selected);

        }
        $returnList .= '</select>';

        return $returnList;
    }

    public static function subtestimonial_list_for_testimonialEntry($parentId, $level, $selected = 0)
    {
        $subtestimonials = DB::table('testimonials')
            ->where('id', $id)
            
            ->get();
        $returnList = '';
        foreach ($subtestimonials as $subtestimonial) {
            if ($selected > 0 && $selected == $subtestimonial->id) {
                $selected_option = 'selected="selected"';
            } else {
                $selected_option = "";
            }
            $returnList .= '<option value="' . $subtestimonial->id . '" ' . $selected_option . '>' .
                str_repeat('&nbsp;>>&nbsp;', $level) . $subtestimonial->heading . '</option>';
            $returnList .= self::subtestimonial_list_for_testimonialEntry($subtestimonial->id, $level + 1, $selected);
        }
        return $returnList;
    }


}