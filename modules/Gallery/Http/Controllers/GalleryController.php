<?php namespace Modules\Gallery\Http\Controllers;

use Pingpong\Modules\Routing\Controller;
use Modules\Gallery\Entities\Album;
use Modules\Gallery\Entities\Images;

class GalleryController extends Controller {
	
	public function index(){
        $data['gallery'] = Album::where('is_active',1)->paginate(6);
        foreach ($data['gallery'] as $gal){
            $gal->cover_image = Images::where('album_id',$gal->id)->take(1)->pluck('image');
        }
        return view('gallery::v_gallery',$data);
    }

    public function all($id){
	    $data['images'] = Images::where('album_id',$id)->paginate(9);
	    return view('gallery::v_all',$data);
    }
	
}