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
      
              $image = $request->image;
                $maximum_filesize = 1 * 1024 * 1024;                
                    if($image!= "") {
                        $size = $image->getSize();                
                        $extension = time().'.'.$image->getClientOriginalExtension();
                        $new_image_name='testimonials_'.$extension;
                        // dd($new_image_name);
                        $destinationPath =public_path('uploads/testimonials')."/".$new_image_name;
                        // dd($destinationPath);
                        
                    if ($size <= $maximum_filesize) {          
                        $attachment = Image::make($image->getRealPath());
                          // dd($attachment);
                                $height = $attachment->height();
                                $width = $attachment->width();
                                $thumb_height=86;
                                $thumb_width= 86;

                                if($width > $height){
                                    $ratio = $width/$height;
                                    $thumb_width = $thumb_height * $ratio;
                                } else {
                                    $ratio = $height/$width;
                                    $thumb_height = $thumb_width * $ratio;
                                }
    
                                $attachment->resize( $thumb_width, $thumb_height,function ($constraint) {
                                $constraint->aspectRatio();
                                $constraint->upsize();
                                });
                                $attachment->crop(86,86);
                                $attachment = $attachment->save($destinationPath );          
                        }   
                             $testimonials->image = $new_image_name; 
                    }
       $testimonials->save();

       Session::flash('add_success','Testimonial has been successfully added.');
       return redirect('admin/testimonials');
   }

 public function edit($id)
   {
        $data['testimonials'] = Testimonial::where('id',$id)->first();
        return view('testimonial::admin.edit_testimonials',$data);
   }

public function editSubmit(Request $request){

        $this->validate($request,['name' => 'required',
                                  'company_name' => 'required',
                                  'rating' => 'required',
                                  'description' => 'required']);

        $testimonial = Testimonial::find(Input::get('id'));

        $testimonial->name = Input::get('name');
        $testimonial->company_name = Input::get('company_name');
        $testimonial->rating = Input::get('rating');
        $testimonial->description = Input::get('description');
        $testimonial->status = Input::get('status');
        $testimonial->created_at = date('Y-m-d');
       

          $image = $request->image;
                $maximum_filesize = 1 * 1024 * 1024;                
                    if($image!= "") {
                        $size = $image->getSize();                
                        $extension = time().'.'.$image->getClientOriginalExtension();
                        $new_image_name='testimonials_'.$extension;
                        // dd($new_image_name);
                        $destinationPath =public_path('uploads/testimonials')."/".$new_image_name;
                        // dd($destinationPath);       
                    if ($size <= $maximum_filesize) {          
                        $attachment = Image::make($image->getRealPath());
                          // dd($attachment);
                                $height = $attachment->height();
                                $width = $attachment->width();
                                $thumb_height=70;
                                $thumb_width= 70;

                                if($width > $height){
                                    $ratio = $width/$height;
                                    $thumb_width = $thumb_height * $ratio;
                                } else {
                                    $ratio = $height/$width;
                                    $thumb_height = $thumb_width * $ratio;
                                }
    
                                $attachment->resize( $thumb_width, $thumb_height,function ($constraint) {
                                $constraint->aspectRatio();
                                $constraint->upsize();
                                });
                                $attachment->crop(70,70);
                                $attachment = $attachment->save($destinationPath );          
                        }   
                                

                             $testimonial->image = $new_image_name; 
                    }
                     $testimonial->save();
                    Session::flash('edit_success','Testimonial has been successfully edited.');
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


