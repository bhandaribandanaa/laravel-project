<?php
/**
 * Created by PhpStorm.
 * User: kokil
 * Date: 1/31/16
 * Time: 11:29 AM
 */

namespace modules\Gallery\Http\Controllers\Admin;

use Pingpong\Modules\Routing\Controller;
use Modules\Gallery\Entities\Album;
use Modules\Gallery\Entities\Images;
use Illuminate\Http\Request;
use Input;
use Validator;
use Auth;
use Image;


class GalleryController extends Controller
{
    public function index()
    {
        $pagination = 10;
        $albums =Album::with('images')->paginate($pagination);
        $albums->setPath('');
        return view('gallery::admin.index')->with(array('albums'=>$albums));
    }

    public function addGallery()
    {
        return view('gallery::admin.gallery_add')->with(array());
    }

    public function createGallery()
    {
        $rules = array(
            'name' => 'required',
        );
        $messages = [
            'name.required' => 'The Album name is required.',
        ];

        $validator = Validator::make(Input::all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            $objectAlbum = new Album();

            $objectAlbum->name = Input::get('name');
            $objectAlbum->description = Input::get('description');
            $objectAlbum->is_active = Input::get('is_active');
            $objectAlbum->created_by = Auth::user()->id;
            $objectAlbum->save();
            if ($objectAlbum->id) {
                return redirect()->route('admin.gallery.photo.add', $objectAlbum->id)->withInput()->with('success', 'Album added successfully.');
            } else {
                return redirect()->back()->withInput();
            }
        }
    }

    public function editGallery($id)
    {
        $album = Album::findOrFail($id);
        return view('gallery::admin.edit_gallery')->with(array('album'=>$album));

    }

    public function updateGallery($id)
    {
        $rules = array(
            'name' => 'required',
        );
        $messages = [
            'name.required' => 'The Album name is required.',
        ];

        $validator = Validator::make(Input::all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            $objectAlbum = Album::findOrFail($id);

            $objectAlbum->name = Input::get('name');
            $objectAlbum->description = Input::get('description');
            $objectAlbum->is_active = Input::get('is_active');
            $objectAlbum->updated_by = Auth::user()->id;
            $objectAlbum->save();
            if ($objectAlbum->id) {
                return redirect()->route('admin.gallery.index')->withInput()->with('success', 'Album Updated successfully.');
            } else {
                return redirect()->back()->withInput();
            }
        }

    }

    public function addGalleryImages($id)
    {
        $album = Album::findOrFail($id);
        return view('gallery::admin.add_gallery_image')->with(array('album' => $album));

    }

    public function createGalleryImages($id)
    {

        $rules = array(
            'images' => 'required|array',
        );
        $messages = [
            'images.required' => 'The Please select image.',
        ];

        $validator = Validator::make(Input::all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            $images = Input::file('images');
            $file_count = count($images);
            $uploadcount = 0;
            foreach ($images as $image) {
                $maximum_filesize = 1 * 1024 * 1024;   
                $rules = array('image' => 'required|mimes:png,gif,jpeg,jpg'); //'required|mimes:png,gif,jpeg,txt,pdf,doc'
                $validator = Validator::make(array('image' => $image), $rules);
                if ($validator->passes()) {
                    if($image!= "") {
                        $size = $image->getSize();  
                        $filename = 'gallery_' . str_random(10) . '.' . $image->getClientOriginalExtension(); 
                        $destinationPath = public_path('uploads/gallery')."/".$filename;
                        // dd($destinationPath);
                        // renameing image
                            // $file->move($destinationPath, $filename);
                        if ($size <= $maximum_filesize) {          
                            $attachment = Image::make($image->getRealPath());
                              // dd($attachment);
                                    $height = $attachment->height();
                                    $width = $attachment->width();
                                    $thumb_height=80;
                                    $thumb_width= 180;

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
                                    $attachment->crop(180,80);
                                    $attachment = $attachment->save($destinationPath ); 
                                    // dd($attachment);         
                            }     
                    $objectImages = new Images();
                    $objectImages->album_id = $id;
                    $objectImages->image = $filename;
                    $objectImages->description = '';
                    $objectImages->created_by = Auth::user()->id;
                    $objectImages->image = $filename; 
                    // dd($filename);
                    $objectImages->save();

                    $uploadcount++;
                }
            }
            }
            return redirect()->route('admin.gallery.photo.edit', $id)->withInput()->with('success', 'Image added successfully.');

        }
    }

    public function editGalleryImages($id)
    {
        $album = Album::with('images')->findOrFail($id);
        return view('gallery::admin.edit_gallery_image')->with(array('album' => $album));
    }

    public function deletePhoto()
    {
        $rules = ['id' => 'required'];
        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails())
            return response()->json(['status' => false, 'message' => $validator->errors()->all()]);

        try {
            $objectImage = Images::findOrFail(Input::get('id'))->delete();
            return response()->json(['status' => true, 'message' => 'Image deleted successfully.']);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['status' => false, 'message' => 'Access denied.']);
        }
    }

    public function changeGalleryStatus()
    {
        $rules = ['id' => 'required'];
        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'message' => $validator->errors()->all()]);
        }

        try {
            $objectGallery = Album::findOrFail(Input::get('id'));
            if ($objectGallery->is_active == 1) {
                $objectGallery->is_active = 0;
                $message = 'Album unpublished successfully.';
            } else {
                $objectGallery->is_active = 1;
                $message = 'Album published successfully.';
            }
            $objectGallery->save();

            return response()->json(['status' => true, 'message' => $message, 'is_active' => $objectGallery->is_active]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['status' => false, 'message' => Input::get('id')]);
        }
    }

    public function deleteGallery()
    {
        $rules = ['id' => 'required'];
        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails())
            return response()->json(['status' => false, 'message' => $validator->errors()->all()]);

        try {
            $objectAlbum = Album::findOrFail(Input::get('id'))->delete();
            return response()->json(['status' => true, 'message' => 'Album deleted successfully.']);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['status' => false, 'message' => 'Access denied.']);
        }
    }


}