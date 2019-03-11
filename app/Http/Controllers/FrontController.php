<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Modules\Banner\entities\Banner;
use Modules\Gallery\Entities\Images;
use Modules\Content\Entities\Content;
use Modules\Setting\Entities\Setting;
use Modules\Media\Entities\Media;
use App\Countries;
use App\Testimonial;
use App\News;

class FrontController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return view('frontend.partials.content');
        $banners = Banner::all();
        // $banners = Banner::where('is_active',1)->get();
        // dd($banners);
        $visions = Countries::all();
         // dd($countries);
        $testimonials = Testimonial::all();
        $albums = Images::all();
        $news= News::all();
        $contents=Content::all();
        $settings=Setting::all();
        $media=Media::all();
        // dd($media);
        return view('frontend.partials.content')->with('banners',$banners)->with('visions',$visions)->with('testimonials',$testimonials)->with('news',$news)->with('albums',$albums)->with('contents',$contents)->with('settings',$settings)->with('media',$media);
       
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getPageBySlug($slug)
   {

       $content= Content::with('photo')->where('slug',$slug)->firstOrFail();
      
       $parent = Content::findBySlug($slug);
       $id =Content::findBySlug($slug);

      
        $ids = $id -> id;

        $parent_id = $parent->parent_id;

       if ($parent_id == 20) {
          $all_jobs = Content::where('parent_id',20)->get();
          $image_name = $content['photo']->file_name;
            return view('content::viewpage')->with('all_jobs', $all_jobs)->with(array('content'=>$content, 'image_name' => $image_name));
       } 
       elseif($parent_id == 1){
          $all_jobs = Content::where('parent_id',1)->get();
         
        if($ids == 29)
        {
           $all_jobs = Content::where('parent_id',29)->get();
          // $image_name = $content['photo']->file_name;
           $data= Images::where('is_active', 1)->where('album_id', 12)->get();

            return view('companydocument::v_all')->with(array('data'=>$data))->with('all_jobs', $all_jobs)->with(array('content'=>$content));
        }
        else{ 

          
        return view('content::content_detail')->with('all_jobs', $all_jobs)->with(array('content'=>$content));

       }}

         else
           return view('content::content_detail')->with(array('content'=>$content));

       } 
         
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
