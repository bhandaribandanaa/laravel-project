<?php namespace Modules\Countries\Http\Controllers\Admin;

use Pingpong\Modules\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Input;
use Redirect;

use Session;
use Image;
use Auth;
use App\Countries;

/**
 * Controller used to manage Testimonials in admin part.
 *
 * @author Kokil Thapa <thapa.kokil@gmail.com>
 */
class AdminCountriesController extends Controller
{


    public function testMethod(){
        
       dd("here");
    }



    public function index()
    {

       $countries = Countries::paginate(5);
       // dd("here");
      
          
        return view('countries::admin.index')->with(array('countries' => $countries));

    }

    public function add()
    {
        $countries = Countries::where('is_active',1)->get();
        return view('countries::admin.add')->with(array('countries' => $countries));

        // $menu_location = MenuLocation::where('is_active', 1)->lists('name', 'id');
        // return view('testimonial::admin.add')->with(array('parents_select' => Testimonial::testimonial_list_for_testimonialEntry(0, 0, ''), 'menu_location' => $menu_location->toArray()));
    }

   
        public function addSubmit(Request $request){
       $this->validate($request,['name' => 'required',
           'image' => 'required',
           'description' => 'required']);


       $countries = new Countries;

           $countries = new Countries();
           $countries->name = Input::get('name');
            $countries->slug = str_slug(Input::get('name'));
           $countries->description = Input::get('description');
           $countries->is_active = Input::get('is_active');
           $countries->save();
         

               if(Input::file('image') != ""){
           $image = Input::file('image');
           $image_name=time()."_".$image->getClientOriginalName();
           $path = public_path('uploads/countries')."/".$image_name;
           Image::make($image->getRealPath())->save($path);
           $countries_data['image'] = $image_name;
           Countries::where('id',$countries->id)->update($countries_data);
       
       }

       Session::flash('add_success','Countries has been successfully added.');
       return redirect('admin/countries');
   }

 public function edit($id)
   {
        $countries = Countries::where('id',$id)->first();
        return view('countries::admin.edit')->with('countries',$countries);
   }

public function editSubmit(Request $request){

        $this->validate($request,['name' => 'required',
                                  'description' => 'required']);

        $countries = Countries::find(Input::get('id'));

        $countries->name = Input::get('name');
         $countries->slug = str_slug(Input::get('name'));
        $countries->description = Input::get('description');
        $countries->is_active = Input::get('is_active');
        $countries->save();

        if(Input::file('image')!=""){
            $image = Input::file('image');
            $image_name=time()."_".$image->getClientOriginalName();
            $path = public_path('uploads/countries')."/".$image_name;
            Image::make($image->getRealPath())->save($path);
            $countries_data['image'] = $image_name;
            Countries::where('id',Input::get('id'))->update($countries_data);
        }
        Session::flash('edit_success','Countries has been successfully edited.');
        return redirect('admin/countries');
    }

    public function changeStatus($id,$option){
        Countries::where('id',$id)->update(['is_active' => $option]);
        Session::flash('status_success','Countries has been changed');
        return redirect('admin/countries');
    }

    public function delete($id){
        Countries::where('id',$id)->delete();
        print_r(json_encode(['status' => 'success', 'value' => 'Countries has been deleted.']));
    }

}


