<?php namespace Modules\Content\Http\Controllers\Admin;

use Pingpong\Modules\Routing\Controller;
use Modules\Content\Entities\Content;
use Modules\Media\Entities\Media;
use Modules\Media\Entities\MediaType;
use Modules\Content\Entities\MenuLocation;
use Input;
use Validator;
use Auth;

/**
 * Controller used to manage contents in admin part.
 *
 * @author Kokil Thapa <thapa.kokil@gmail.com>
 */
class AdminContentController extends Controller
{

    public function index()
    {
        $menuItems = MenuLocation::where('is_active', 1)->lists('name', 'id');
        $paginate = 10;
//        $contents = Content::with('children.children')->where('parent_id',0)->paginate($paginate);
//        $contents = Content::with('children.children')->paginate($paginate);
        $contents = Content::with('parent')->paginate($paginate);
        $contents->setPath('');
        return view('content::admin.index')->with(array('contents' => $contents, 'menu_array' => $menuItems));
    }

    public function add()
    {
        $menu_location = MenuLocation::where('is_active', 1)->lists('name', 'id');
        return view('content::admin.add')->with(array('parents_select' => Content::content_list_for_contentEntry(0, 0, ''), 'menu_location' => $menu_location->toArray()));
    }

    public function create()
    {
        $rules = array(
            'heading' => 'required',
            'page_title' => 'required',
            'short_description' => 'required',
            'content' => 'required',
        );
        $messages = [
            'heading.required' => 'The heading is required.',
            'page_title.required' => 'The title name is required.',
            'short_description.required' => 'The short description name is required.',
            'content.required' => 'The content is required.',
        ];

        $validator = Validator::make(Input::all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {

            $objectContent = new Content();
            $objectContent->heading = Input::get('heading');
            $objectContent->page_title = Input::get('page_title');
            $objectContent->meta_tags = Input::get('meta_tags');
            $objectContent->meta_description = Input::get('meta_description');
            $objectContent->parent_id = Input::get('parent_id');
            $objectContent->display_in = implode(", ", (array)Input::get('display_in'));
            $objectContent->short_description = Input::get('short_description');
            $objectContent->description = Input::get('content');
            $objectContent->order_postition = Input::get('display_order');
            $objectContent->is_active = Input::get('is_active');
            $objectContent->created_by = Auth::user()->id;
            $objectContent->save();
            if ($objectContent->id) {

                if (Input::file('banner')) {
                    $destinationPath = 'uploads/media'; // upload path
                    $extension = Input::file('banner')->getClientOriginalExtension(); // getting image extension
                    $fileName = 'content_' . str_random(20) . '.' . $extension; // renameing image
                    Input::file('banner')->move($destinationPath, $fileName); // uploading file to given path
                    $photo = $objectContent->photo()->create(
                        array(
                            'type_id' => '1',
                            'caption' => Input::get('heading'),
                            'file_name' => $fileName,
                            'created_by' => Auth::user()->id,
                        )
                    );
                }


                return redirect()->route('admin.content.index')->withInput()->with('success', 'Content added successfully.');
            } else {
                return redirect()->back()->withInput();
            }
        }
    }

    public function edit($id)
    {
        $menu_location = MenuLocation::where('is_active', 1)->lists('name', 'id');
        $content = Content::findOrFail($id);
        return view('content::admin.edit_content')->with(array('content'=>$content,'menu_location' => $menu_location->toArray(),'parents_select' => Content::content_list_for_contentEntry(0, 0, $content->parent_id)));
    }

    public function update($id)
    {
        $rules = array(
            'heading' => 'required',
            'page_title' => 'required',
            'short_description' => 'required',
            'content' => 'required',
        );
        $messages = [
            'heading.required' => 'The heading is required.',
            'page_title.required' => 'The title name is required.',
            'short_description.required' => 'The short description name is required.',
            'content.required' => 'The content is required.',
        ];

        $validator = Validator::make(Input::all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {

            $objectContent = Content::find($id);
            $objectContent->heading = Input::get('heading');
            $objectContent->page_title = Input::get('page_title');
            $objectContent->meta_tags = Input::get('meta_tags');
            $objectContent->meta_description = Input::get('meta_description');
            $objectContent->parent_id = Input::get('parent_id');
            $objectContent->display_in = implode(", ", (array)Input::get('display_in'));
            $objectContent->short_description = Input::get('short_description');
            $objectContent->description = Input::get('content');
            $objectContent->order_postition = Input::get('display_order');
            $objectContent->is_active = Input::get('is_active');
            $objectContent->updated_by = Auth::user()->id;
            $objectContent->save();
            if ($objectContent->id) {

                if (Input::file('banner')) {
                    $destinationPath = 'uploads/media'; // upload path
                    $extension = Input::file('banner')->getClientOriginalExtension(); // getting image extension
                    $fileName = 'content_' . str_random(20) . '.' . $extension; // renameing image
                    Input::file('banner')->move($destinationPath, $fileName); // uploading file to given path

                    if($objectContent->photo){
                        $photo = $objectContent->photo()->update(
                            array(
                                'caption' => Input::get('heading'),
                                'file_name' => $fileName,
                                'updated_by' => Auth::user()->id,
                            )
                        );

                    }else {
                        $photo = $objectContent->photo()->create(
                            array(
                                'type_id' => '1',
                                'caption' => Input::get('heading'),
                                'file_name' => $fileName,
                                'created_by' => Auth::user()->id,
                            )
                        );

                    }

                }

                return redirect()->route('admin.content.index')->withInput()->with('success', 'Content updated successfully.');
            } else {
                return redirect()->back()->withInput();
            }
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
            $objectContent = Content::findOrFail(Input::get('id'));
            if ($objectContent->is_active == 1) {
                $objectContent->is_active = 0;
                $message = 'Content unpublished successfully.';
            } else {
                $objectContent->is_active = 1;
                $message = 'Content published successfully.';
            }
            $objectContent->save();

            return response()->json(['status' => true, 'message' => $message, 'is_active' => $objectContent->is_active]);
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
            $objectContent = Content::findOrFail(Input::get('id'))->delete();
            return response()->json(['status' => true, 'message' => 'Content deleted successfully.']);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['status' => false, 'message' => 'Access denied.']);
        }
    }

}