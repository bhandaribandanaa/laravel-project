<?php namespace Modules\Banner\Http\Controllers\Admin;

use Auth;
use Input;
use Modules\Banner\Entities\Banner;
use Pingpong\Modules\Routing\Controller;
use Validator;

class BannerController extends Controller
{
    public function index()
    {
        $banners = Banner::orderBy('id', 'DESC')->get();
        return view('banner::admin.index')->with(array('banners' => $banners));
    }

    public function add()
    {
        return view('banner::admin.banner_add');
    }

    public function create()
    {
        $rules = array(
            'title' => 'required',
            'subtitle' => 'required',
            'heading' => 'required',
            'subheading' => 'required',
            'banner' => 'required|mimes:jpeg,jpg,png|max:2000',
        );
        $messages = [
            'title.required' => 'The title is required.',
            'subtitle.required' => 'The sub-title is required.',
            'heading.required' => 'The heading is required.',
            'subheading.required' => 'The sub-heading is required.',
            'banner.required' => 'The Banner is required.',
        ];

        $validator = Validator::make(Input::all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {

            if (Input::file('banner')) {
                $destinationPath = 'uploads/banner';
                $extension = Input::file('banner')->getClientOriginalExtension();
                $fileName = 'banner_' . str_random(20) . '.' . $extension;
                Input::file('banner')->move($destinationPath, $fileName);
                $objectBanner = new Banner();
                $objectBanner->title = Input::get('title');
                $objectBanner->sub_title = Input::get('subtitle');
                $objectBanner->heading = Input::get('heading');
                $objectBanner->sub_heading = Input::get('subheading');
                $objectBanner->image = $fileName;
                $objectBanner->url = Input::get('url');
                $objectBanner->button_label = Input::get('button_label');
                $objectBanner->is_active = Input::get('is_active');
                $objectBanner->added_by = Auth::user()->id;
                $objectBanner->save();
                return redirect()->route('admin.banner.index')->withInput()->with('success', 'Banner added successfully.');
            } else {
                return redirect()->back()->withInput();
            }

            return redirect()->back()->withInput();
        }
    }

    public function delete()
    {
        $rules = ['id' => 'required'];
        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails())
            return response()->json(['status' => false, 'message' => $validator->errors()->all()]);

        try {
            Banner::findOrFail(Input::get('id'))->delete();
            return response()->json(['status' => true, 'message' => 'Banner deleted successfully.']);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['status' => false, 'message' => 'Access denied.']);
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
            $objectBanner = Banner::findOrFail(Input::get('id'));
            if ($objectBanner->is_active == 1) {
                $objectBanner->is_active = 0;
                $message = 'Banner unpublished successfully.';
            } else {
                $objectBanner->is_active = 1;
                $message = 'Banner published successfully.';
            }
            $objectBanner->save();

            return response()->json(['status' => true, 'message' => $message, 'is_active' => $objectBanner->is_active]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['status' => false, 'message' => Input::get('id')]);
        }
    }

    public function edit($id)
    {
        $banner = Banner::find($id);
        return view('banner::admin.edit_banner')->with('banner', $banner);

    }

    public function update($id)
    {
        $rules = array(
            'title' => 'required',
            'subtitle' => 'required',
            'heading' => 'required',
            'subheading' => 'required',
            'banner' => 'mimes:jpeg,jpg,png|max:2000',
        );
        $messages = [
            'title.required' => 'The title is required.',
            'subtitle.required' => 'The sub-title is required.',
            'heading.required' => 'The heading is required.',
            'subheading.required' => 'The sub-heading is required.',
        ];

        $validator = Validator::make(Input::all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {

            $objectBanner = Banner::find($id);
            $objectBanner->title = Input::get('title');
            $objectBanner->sub_title = Input::get('subtitle');
            $objectBanner->heading = Input::get('heading');
            $objectBanner->sub_heading = Input::get('subheading');
            $objectBanner->url = Input::get('url');
            $objectBanner->button_label = Input::get('button_label');
            $objectBanner->is_active = Input::get('is_active');
            $objectBanner->updated_by = Auth::user()->id;

            if (Input::file('banner')) {
                $destinationPath = 'uploads/banner';
                $extension = Input::file('banner')->getClientOriginalExtension();
                $fileName = 'banner_' . str_random(20) . '.' . $extension;
                Input::file('banner')->move($destinationPath, $fileName);
                $objectBanner->image = $fileName;
            }
            $objectBanner->save();
            return redirect()->route('admin.banner.index')->withInput()->with('success', 'Banner updated successfully.');
        }

    }
}