<?php namespace Modules\Testimonial\Http\Controllers\Admin;

use Pingpong\Modules\Routing\Controller;
use Modules\Testimonial\Entities\Testimonial;
use Modules\Media\Entities\Media;
use Modules\Media\Entities\MediaType;
use Modules\Testimonial\Entities\MenuLocation;
use Input;
use Validator;
use Auth;

/**
 * Controller used to manage Testimonials in admin part.
 *
 * @author Kokil Thapa <thapa.kokil@gmail.com>
 */
class AdminTestimonialController extends Controller
{


    public function testMethod(){
        //$paginate = 11;
      //    $menuItems = MenuLocation::where('is_active', 1)->lists('name', 'id');
      //   $testimonials = Testimonial::with('parent')
      // //   $testimonials->setPath('');
      //   return view('testimonial::admin.testMethod')->with(array('testimonials' => $testimonials, 'menu_array' => $menuItems));
       dd("here");
    }



    public function index()
    {

        $menuItems = MenuLocation::where('is_active', 1)->lists('name', 'id');

        $paginate = 10;
// //        $contents = Content::with('children.children')->where('parent_id',0)->paginate($paginate);
// //        $contents = Content::with('children.children')->paginate($paginate);
        $testimonials = Testimonial::with('parent')->paginate($paginate);
         die("here");
        // $testimonials->setPath('');
        // print_r($testimonials); die;
        // return view('testimonial::admin.index')->with(array('testimonials' => $testimonials, 'menu_array' => $menuItems));
    }

    public function add()
    {
        $testimonial = Testimonial::where('status','active')->get();
        $menu_location = MenuLocation::where('is_active', 1)->lists('name', 'id');
        return view('testimonial::admin.add')->with(array('parents_select' => Testimonial::testimonial_list_for_testimonialEntry(0, 0, ''), 'menu_location' => $menu_location->toArray()));
    }

    public function create()
    {
        $rules = array(
            'name' => 'required',
            'company_name' => 'required',
            'description' => 'required',
            'image' => 'required',
        );
        $messages = [
            'name.required' => 'The name is required.',
            'company_name.required' => 'The company_name is required.',
            'description.required' => 'The description name is required.',
            'image.required' => 'The image is required.',
        ];

        $validator = Validator::make(Input::all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {

            $objectTestimonial = new Testimonial();
            $objectTestimonial->name = Input::get('name');
            $objectTestimonial->company_name = Input::get('company_name');
            $objectTestimonial->description = Input::get('description');
            // $objectTestimonial->rating = Input::get('rating');
            $objectTestimonial->created_at = date('Y-m-d');
            $objectTestimonial->updated_at = date('Y-m-d');
            $objectTestimonial->save();
            if ($objectTestimonial->id) {

                if(Input::file('image') != ""){
            $image = Input::file('image');
            $image_name=time()."_".$image->getClientOriginalName();
            $path = public_path('uploads/testimonials')."/".$image_name;
            Image::make($image->getRealPath())->save($path);
            $tesimonial_data['image'] = $image_name;
            News::where('id',$testimonials->id)->update($testimonials_data);
        
        }

        Session::flash('add_success','Testimonial has been successfully added.');
        return redirect('admin/testimonials');
}
    }
}

    public function edit($id)
    {
        $menu_location = MenuLocation::where('is_active', 1)->lists('name', 'id');
        $testimonial = Testimonial::findOrFail($id);
        return view('testimonial::admin.edit_testimonial')->with(array('testimonial'=>$testimonial,'menu_location' => $menu_location->toArray(),'parents_select' => Content::testimonial_list_for_testimonialEntry(0, 0, $testimonial->id)));
    }

    public function update($id)
    {
         $rules = array(
            'name' => 'required',
            'company_name' => 'required',
            'description' => 'required',
            'image' => 'required',
        );
        $messages = [
            'name.required' => 'The name is required.',
            'company_name.required' => 'The company_name is required.',
            'description.required' => 'The description name is required.',
            'image.required' => 'The image is required.',
        ];

        $validator = Validator::make(Input::all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            $objectTestimonial = new Testimonial();
            $objectTestimonial->name = Input::get('name');
            $objectTestimonial->company_name = Input::get('company_name');
            $objectTestimonial->description = Input::get('description');
            // $objectTestimonial->rating = Input::get('rating');
            $objectTestimonial->created_at = date('Y-m-d');
            $objectTestimonial->updated_at = date('Y-m-d');
            $objectTestimonial->save();
            if ($objectTestimonial->id) {

                if(Input::file('image') != ""){
            $image = Input::file('image');
            $image_name=time()."_".$image->getClientOriginalName();
            $path = public_path('uploads/testimonials')."/".$image_name;
            Image::make($image->getRealPath())->save($path);
            $tesimonial_data['image'] = $image_name;
            News::where('id',$testimonials->id)->update($testimonials_data);
        
        }

                }

                Session::flash('add_success','Testimonial has been successfully added.');
        return redirect('admin/testimonials');
        }
    }

    public function changeStatus()
    {
        $rules = ['id' => 'required'];
        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'message' => $validator->errors()->all()]);
        }

        try {
            $objectTestimonial = Testimonial::findOrFail(Input::get('id'));
            if ($objectTestimonial->is_active == 1) {
                $objectTestimonial->is_active = 0;
                $message = 'Testimonial unpublished successfully.';
            } else {
                $objectTestimonialt->is_active = 1;
                $message = 'Testimonial published successfully.';
            }
            $objectTestimonial->save();

            return response()->json(['status' => true, 'message' => $message, 'is_active' => $objectTestimonial->is_active]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['status' => false, 'message' => Input::get('id')]);
        }
    }

    public function delete()
    {
        $rules = ['id' => 'required'];
        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails())
            return response()->json(['status' => false, 'message' => $validator->errors()->all()]);

        try {
            $objectTestimonial = Testimonial::findOrFail(Input::get('id'))->delete();
            return response()->json(['status' => true, 'message' => 'Testimonial deleted successfully.']);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['status' => false, 'message' => 'Access denied.']);
        }
    }

}


