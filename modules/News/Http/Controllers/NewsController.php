<?php namespace Modules\News\Http\Controllers;

use Pingpong\Modules\Routing\Controller;
use App\News;
use App\NewsCategory;

class NewsController extends Controller {
	
	public function index()
	{
	    $data['category'] = NewsCategory::where('status','active')->get();
        $data['all_news'] = News::where('status','active')->orderBy('id','desc')->paginate(6);
		return view('news::v_news',$data);
	}

	public function detail($slug){
	    $data['news'] = News::where('slug',$slug)->first();
	    return view('news::v_news_detail',$data);
    }

    public function category($slug){
        $data['category'] = NewsCategory::where('slug',$slug)->select('id','category')->first();
        $data['categories'] = NewsCategory::where('status','active')->get();
        $data['cat_news'] = News::where('category_id',$data['category']->id)->where('status','active')->paginate(6);
        return view('news::v_by_category',$data);
    }
	
}