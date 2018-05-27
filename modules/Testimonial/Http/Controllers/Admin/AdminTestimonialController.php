<?php namespace Modules\Testimonial\Http\Controllers\Admin;

use Pingpong\Modules\Routing\Controller;
use Illuminate\Http\Request;
use Modules\Media\Entities\Media;
use Modules\Media\Entities\MediaType;
use Modules\Testimonial\Entities\MenuLocation;
use Input;
use Validator;
use Auth;
use App\Testimonial;

/**
 * Controller used to manage Testimonials in admin part.
 *
 * @author Kokil Thapa <thapa.kokil@gmail.com>
 */
class AdminTestimonialController extends Controller
{


    public function testMethod(){
        
       dd("here");
    }



    public function index()
    {

       $testimonials = Testimonial::paginate(5);
       // dd("here");
      
          
        return view('testimonial::admin.index')->with(array('testimonials'=> $testimonials));

    }

    public function add()
    {
        $testimonials = Testimonial::where('status','active')->get();
        return view('testimonial::admin.add',$testimonials);

        // $menu_location = MenuLocation::where('is_active', 1)->lists('name', 'id');
        // return view('testimonial::admin.add')->with(array('parents_select' => Testimonial::testimonial_list_for_testimonialEntry(0, 0, ''), 'menu_location' => $menu_location->toArray()));
    }

    public function addSubmit(Request $request){

        $this->validate($request,['name' => 'required',
            'company_name' => 'required',
            'rating' => 'required',
            'mimes:jpeg,bmp,png',
            'description' => 'required']);


        $testimonials = new Testimonial;

            $objectTestimonial = new Testimonial();
            $objectTestimonial->name = Input::get('name');
            $objectTestimonial->company_name = Input::get('company_name');
            $objectTestimonial->rating = Input::get('rating');
            $objectTestimonial->description = Input::get('description');
            $objectTestimonial->created_at = date('Y-m-d');
            $objectTestimonial->updated_at = date('Y-m-d');
            $objectTestimonial->deleted_at = date('Y-m-d');
            $objectTestimonial->save();
            if ($objectTestimonial->id) {

                if(Input::file('image') != ""){
            $image = Input::file('image');
            $image_name=time()."_".$image->getClientOriginalName();
            $path = public_path('uploads/testimonials')."/".$image_name;
            Image::make($image->getRealPath())->save($path);
            $tesimonial_data['image'] = $image_name;
            Testimonial::where('id',$testimonials->id)->update($testimonials_data);
        
        }

        Session::flash('add_success','Testimonial has been successfully added.');
        return redirect('admin/testimonials');
    }
}
 public function edit($id)
    {

        $testimonials = Testimonial::where('id',$id)->first();
       
        return view('testimonials::admin.edit_testimonial',$testimonials);
    }
  public function editSubmit(Request $request){

        $this->validate($request,['name' => 'required',
            'company_name' => 'required',
            'rating' => 'required',
            'image'=> 'mimes:jpeg,bmp,png',
            'description' => 'required']);

        $testimonials = Testimonial::find(Input::get('id'));

        $objectTestimonial = new Testimonial();
            $objectTestimonial->name = Input::get('name');
            $objectTestimonial->company_name = Input::get('company_name');
            $objectTestimonial->rating = Input::get('rating');
            $objectTestimonial->description = Input::get('description');
            $objectTestimonial->created_at = date('Y-m-d');
            $objectTestimonial->updated_at = date('Y-m-d');
            $objectTestimonial->deleted_at = date('Y-m-d');
            $objectTestimonial->save();

        if(Input::file('image')!=""){
            $image = Input::file('image');
            $image_name=time()."_".$image->getClientOriginalName();
            $path = public_path('uploads/testimonials')."/".$image_name;
            Image::make($image->getRealPath())->save($path);
            $news_data['image'] = $image_name;
            Testimonial::where('id',Input::get('id'))->update($testimonials_data);
        }
        Session::flash('edit_success','Testimonial has been successfully added.');
        return redirect('admin/news');
    }

    public function changeStatus($id,$option){
        Testimonial::where('id',$id)->update(['status' => $option]);
        Session::flash('status_success','Testimonial has been changed');
        return redirect('admin/testimonials');
    }

    public function delete($id){
        Testimonial::where('id',$id)->delete();
        print_r(json_encode(['status' => 'success', 'value' => 'Testimonial has been deleted.']));
    }

}


