<?php namespace Modules\Downloads\Http\Controllers\Admin;

use Auth;
use Input;
use Modules\Downloads\Entities\DownloadCategory;
use Pingpong\Modules\Routing\Controller;
use Validator;

class DownloadCategoryController extends Controller
{

    public function index()
    {
        $paginate = 10;
        $categories = DownloadCategory::paginate($paginate);
        $categories->setPath('');
        return view('downloads::admin.category_list')->with(array('categories' => $categories));

    }

    public function add()
    {
        return view('downloads::admin.add_category');

    }

    public function create()
    {
        $rules = array(
            'name' => 'required',

        );
        $messages = [
            'name.required' => 'The name is required.',
        ];

        $validator = Validator::make(Input::all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {

            $objectCategory = new DownloadCategory();
            $objectCategory->name = Input::get('name');
            $objectCategory->description = Input::get('description');
            $objectCategory->is_active = Input::get('is_active');
            $objectCategory->created_by = Auth::user()->id;
            $objectCategory->save();
            return redirect()->route('admin.download.category.index')->withInput()->with('success', 'Category created successfully.');
        }

    }


    public function edit($id)
    {
        $category = DownloadCategory::findOrFail($id);
        return view('downloads::admin.category_edit')->with(array('category' => $category));

    }

    public function update($id)
    {
        $rules = array(
            'name' => 'required',
        );
        $messages = [
            'name.required' => 'The name is required.',
        ];

        $validator = Validator::make(Input::all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {

            $objectCategory = DownloadCategory::findOrFail($id);
            $objectCategory->name = Input::get('name');
            $objectCategory->description = Input::get('description');
            $objectCategory->is_active = Input::get('is_active');
            $objectCategory->updated_by = Auth::user()->id;
            $objectCategory->save();
            return redirect()->route('admin.download.category.index')->withInput()->with('success', 'Category updated successfully.');
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
            $objectCategory = DownloadCategory::findOrFail(Input::get('id'));
            if ($objectCategory->is_active == 1) {
                $objectCategory->is_active = 0;
                $message = 'Category unpublished successfully.';
            } else {
                $objectCategory->is_active = 1;
                $message = 'Category published successfully.';
            }
            $objectCategory->save();

            return response()->json(['status' => true, 'message' => $message, 'is_active' => $objectCategory->is_active]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['status' => false, 'message' => 'Oops something went wrong.']);
        }
    }

    public function delete()
    {
        $rules = ['id' => 'required'];
        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails())
            return response()->json(['status' => false, 'message' => $validator->errors()->all()]);

        try {
            DownloadCategory::findOrFail(Input::get('id'))->delete();
            return response()->json(['status' => true, 'message' => 'Category deleted successfully.']);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['status' => false, 'message' => 'Access denied.']);
        }
    }

}