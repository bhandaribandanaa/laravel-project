<?php namespace Modules\Testimonial\Http\Controllers\Admin;

use Pingpong\Modules\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Input;
use Redirect;

use Session;
use Image;
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
      
          
        return view('testimonial::admin.index')->with(array('testimonials' => $testimonials));

    }

    public function add()
    {
        $testimonials = Testimonial::where('status','active')->get();
        return view('testimonial::admin.add')->with(array('testimonials' => $testimonials));

        // $menu_location = MenuLocation::where('is_active', 1)->lists('name', 'id');
        // return view('testimonial::admin.add')->with(array('parents_select' => Testimonial::testimonial_list_for_testimonialEntry(0, 0, ''), 'menu_location' => $menu_location->toArray()));
    }

   
        public function addSubmit(Request $request){
       $this->validate($request,['name' => 'required',
           'company_name' => 'required',
           'rating' => 'required',
           'description' => 'required']);


       $testimonials = new Testimonial;

           $testimonials = new Testimonial();
           $testimonials->name = Input::get('name');
           $testimonials->company_name = Input::get('company_name');
           $testimonials->rating = Input::get('rating');
           $testimonials->description = Input::get('description');
           $testimonials->status = Input::get('status');
           $testimonials->created_at = date('Y-m-d');
            $testimonials->updated_at = date('Y-m-d');
            $testimonials->deleted_at = date('Y-m-d');
           $testimonials->save();
         

               if(Input::file('image') != ""){
           $image = Input::file('image');
           $image_name=time()."_".$image->getClientOriginalName();
           $path = public_path('uploads/testimonials')."/".$image_name;
           Image::make($image->getRealPath())->save($path);
           $testimonials_data['image'] = $image_name;
           Testimonial::where('id',$testimonials->id)->update($testimonials_data);
       
       }

       Session::flash('add_success','Testimonial has been successfully added.');
       return redirect('admin/testimonials');
   }


 public function edit()
    {

         $testimonials = Testimonial::where('status', 'active')->get();
       
            return view('testimonials::admin.edit_testimonials', $testimonials);
    }
  public function editSubmit(Request $request){

        $this->validate($request,['name' => 'required',
            'company_name' => 'required',
            'rating' => 'required',
            'description' => 'required']);

        $testimonials = Testimonial::find(Input::get('id'));

        $testimonials = new Testimonial();
            $testimonials->name = Input::get('name');
            $testimonials->company_name = Input::get('company_name');
            $testimonials->rating = Input::get('rating');
            $testimonials->description = Input::get('description');
            $testimonials->status = Input::get('status');
            $testimonials->created_at = date('Y-m-d');
            $testimonials->updated_at = date('Y-m-d');
            $testimonials->deleted_at = date('Y-m-d');
            $testimonials->save();

        if(Input::file('image')!=""){
            $image = Input::file('image');
            $image_name=time()."_".$image->getClientOriginalName();
            $path = public_path('uploads/testimonials')."/".$image_name;
            Image::make($image->getRealPath())->save($path);
            $testimonials_data['image'] = $image_name;
            Testimonial::where('id',Input::get('id'))->update($testimonials_data);
        }
        Session::flash('edit_success','Testimonial has been successfully added.');
        return redirect('admin/testimonials');
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


