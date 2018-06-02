<?php namespace Modules\CompanyDocument\Http\Controllers;

use Pingpong\Modules\Routing\Controller;
use Modules\CompanyDocument\Entities\Album;
use Modules\CompanyDocument\Entities\Images;


class CompanyDocumentController extends Controller {

	public function index(){
        $data['companydocument'] = Album::where('is_active',1)->paginate(6);
        foreach ($data['companydocument'] as $cd){
            $cd->cover_image = Images::where('album_id',$cd->id)->take(1)->pluck('image');
        }
        return view('companydocument::v_companydocument',$data);
    }

    public function all($id){
	    $data['images'] = Images::where('album_id',$id)->paginate(9);
	    return view('companydocument::v_all',$data);
    }
	
}