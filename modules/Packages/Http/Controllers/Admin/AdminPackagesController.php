<?php namespace Modules\Packages\Http\Controllers\Admin;

use Illuminate\Workbench\Package;
use Pingpong\Modules\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Input;
use Session;
use Redirect;
use DB;

use App\Packages;
use App\Doctors;
use App\PackagesDoctors;
use App\Treatments;
use App\PackagesTreatments;

class AdminPackagesController extends Controller {
	
	public function index(){
        $data['packages'] = Packages::paginate(5);
        return view('packages::admin.v_packages',$data);
	}

	public function add(){
        return view('packages::admin.v_add_package');
    }

    public function addSubmit(Request $request){
        $this->validate($request,['title' => 'required',
                                    'price' => 'required',
                                    'status' => 'required'
                                    ]);

        $package = new Packages;

        $package->title = Input::get('title');
        $package->slug = str_slug(Input::get('title'));
        $package->description = Input::get('description');
        $package->price = Input::get('price');
        $package->status = Input::get('status');


        if($package->save()){
            Session::flash('success','Package has been added.');
            return redirect('admin/packages');
        }
        else{
            Session::flash('error','Something went wrong.');
            return Redirect::back();
        }

    }

    public function edit($id){
        $data['package'] = Packages::find($id);
        return view('packages::admin.v_edit_package',$data);
    }

    public function editSubmit(Request $request){
        $this->validate($request,['title' => 'required',
                                    'price' => 'required',
                                    'status' => 'required']);

        $package = Packages::find(Input::get('id'));

        $package->title = Input::get('title');
        $package->slug = str_slug(Input::get('title'));
        $package->description = Input::get('description');
        $package->price = Input::get('price');
        $package->status = Input::get('status');

        if($package->save()){
            Session::flash('success','Package has been updated.');
            return redirect('admin/packages');
        }
        else{
            Session::flash('error','Something went wrong.');
            return Redirect::back();
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
            $objectContent = Packages::findOrFail(Input::get('id'));
            if ($objectContent->status == 1) {
                $objectContent->status = 0;
                $message = 'Record unpublished successfully.';
            } else {
                $objectContent->status = 1;
                $message = 'Record published successfully.';
            }
            $objectContent->save();

            return response()->json(['status' => true, 'message' => $message, 'status' => $objectContent->status]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['status' => false, 'message' => Input::get('id')]);
        }
    }

    public function delete(){
        $rules = ['id' => 'required'];
        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails())
            return response()->json(['status' => false, 'message' => $validator->errors()->all()]);

        try {
            $objectContent = Packages::findOrFail(Input::get('id'))->delete();
            return response()->json(['status' => true, 'message' => 'Package deleted successfully.']);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['status' => false, 'message' => 'Access denied.']);
        }
    }

    public function assignDoctor($id){
        $data['doctors'] = Doctors::all();
        foreach ($data['doctors'] as $value) {
            if((PackagesDoctors::where('package_id',$id)->where('doctor_id',$value->id)->count())>0)
                $value->is_assigned = 'yes';
            else
                $value->is_assigned = 'no';
        }
        $data['package_id'] = $id;
        return view('packages::admin.v_assign_doctors',$data);
    }

    public function assign_doctors($p_id,$d_id,$op){
        if($op == "add"){
            $pd = new PackagesDoctors;
            $pd->package_id = $p_id;
            $pd->doctor_id = $d_id;
            $pd->save();
            print_r(json_encode(['status' => 'success','value' =>'Doctor added to package.']));
        }else{
            $pd = PackagesDoctors::where('package_id',$p_id)->where('doctor_id',$d_id)->delete();
            print_r(json_encode(['status' => 'success','value' =>'Doctor removed from package.']));
        }

    }

    public function viewTreatments(){
        $data['treatments'] = Treatments::paginate(50);
        return view('packages::admin.v_treatments',$data);
    }

    public function addTreatment(){
        $data['packages'] = Packages::select('id','title')->get();
        return view('packages::admin.v_add_treatment',$data);
    }

    public function addTreatmentSubmit(Request $request){
        $this->validate($request,['title' => 'required',
                                    'status' => 'required']);

        $treat = new Treatments;

        $treat->title = Input::get('title');
        $treat->description = Input::get('description');
        $treat->status = Input::get('status');

        if($treat->save()){
            if(Input::get('packages') != '') {
                $packages = Input::get('packages');
                for ($i = 0; $i < count($packages); $i++) {
                    $pt = new PackagesTreatments;
                    $pt->package_id = $packages[$i];
                    $pt->treatment_id = $treat->id;
                    $pt->save();
                }
            }
            Session::flash('success','Treatments has been added.');
            return redirect('admin/packages/viewTreatments');
        }
        else{
            Session::flash('error','Something went wrong.');
            return Redirect::back();
        }

    }

    public function changeStatusTreatment()
    {
        $rules = ['id' => 'required'];
        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'message' => $validator->errors()->all()]);
        }

        try {
            $objectContent = Treatments::findOrFail(Input::get('id'));
            if ($objectContent->status == 1) {
                $objectContent->status = 0;
                $message = 'Record unpublished successfully.';
            } else {
                $objectContent->status = 1;
                $message = 'Record published successfully.';
            }
            $objectContent->save();

            return response()->json(['status' => true, 'message' => $message, 'status' => $objectContent->status]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['status' => false, 'message' => Input::get('id')]);
        }
    }

    public function deleteTreatment(){
        $rules = ['id' => 'required'];
        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails())
            return response()->json(['status' => false, 'message' => $validator->errors()->all()]);

        try {
            $objectContent = Treatments::findOrFail(Input::get('id'))->delete();
            return response()->json(['status' => true, 'message' => 'Package deleted successfully.']);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['status' => false, 'message' => 'Access denied.']);
        }
    }

    public function editTreatment($id){
        $data['treatment'] = Treatments::find($id);

        $data['selected'] = DB::table('packages as P')
                                ->join('packages_treatments as PT','P.id','=','PT.package_id')
                                ->where('PT.treatment_id',$id)
                                ->get();


        if(count($data['selected']) > 0){
            foreach ($data['selected'] as $sel){
                $selected_ids[] = $sel->package_id;
            }

            $all = Packages::where('status',1)->lists('id')->toArray();
            $not_selected = array_diff($all,$selected_ids);
            $not_selected = array_values($not_selected);


            if(count($not_selected) >0){
                for($i=0; $i<count($not_selected); $i++){
                    $data['not_selected'][] = Packages::where('id',$not_selected[$i])->first();
                }
            }else{
                $data['not_selected'] = 'Empty';
            }

        }else{
            $data['all'] = Packages::where('status',1)->get();
        }
        return view('packages::admin.v_edit_treatment',$data);
    }

    public function editTreatmentSubmit(Request $request){
        $this->validate($request,['title' => 'required',
                                    'status' => 'required']);

        $treat = Treatments::find(Input::get('id'));

        $packages = Input::get('packages');
        if(count($packages) > 0) {
            PackagesTreatments::where('treatment_id', $treat->id)->delete();
            for ($i = 0; $i < count($packages); $i++) {
                $pt = new PackagesTreatments;
                $pt->package_id = $packages[$i];
                $pt->treatment_id = $treat->id;
                $pt->save();
            }
        }else{
            PackagesTreatments::where('treatment_id',$treat->id)->delete();
        }

        $treat->title = Input::get('title');
        $treat->description = Input::get('description');
        $treat->status = Input::get('status');

        if($treat->save()){
            Session::flash('success','Treatment has been updated.');
            return redirect('admin/packages/viewTreatments');
        }
        else{
            Session::flash('error','Something went wrong.');
            return Redirect::back();
        }
    }

    public function assignTreatment(){
        $data['packages'] = Packages::where('status',1)->get();
        $data['treatments'] = Treatments::where('status',1)->get();
        foreach($data['treatments'] as $tr){
            $packages[] = PackagesTreatments::where('treatment_id',$tr->id)->pluck('package_id');
            $tr->packages = $packages;
        }

        return view('packages::admin.v_assign_treatments',$data);
    }

    public function setTreatment($value){

        $value = explode('_',$value);
        $treatment_id = $value[0];
        $package_id = $value[1];

        if(PackagesTreatments::where('package_id',$package_id)->where('treatment_id',$treatment_id)->count() > 0){
            PackagesTreatments::where('package_id',$package_id)->where('treatment_id',$treatment_id)->delete();
            print_r(json_encode(['status' => 'success', 'value' => 'Treatment has been removed from Package.']));
        }else{
            $pt = new PackagesTreatments;
            $pt->package_id = $package_id;
            $pt->treatment_id = $treatment_id;
            $pt->save();
            print_r(json_encode(['status' => 'success', 'value' => 'Treatment has been linked to Package.']));
        }

    }

}