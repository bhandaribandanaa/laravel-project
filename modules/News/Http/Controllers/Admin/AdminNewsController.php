<?php namespace Modules\News\Http\Controllers\Admin;

use Pingpong\Modules\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Auth;
use Session;
use Input;
use Redirect;
use Image;

use App\News;
use App\NewsCategory;

class AdminNewsController extends Controller {

    public function index()
    {
        $data['news'] = News::paginate(5);
        foreach ($data['news'] as $value) {
            $value->category = NewsCategory::where('id',$value->category_id)->pluck('category');
        }
        return view('news::admin.v_news',$data);
    }

    public function add(){
        $data['category'] = NewsCategory::where('status','active')->get();
        return view('news::admin.v_add_news',$data);
    }

    public function addSubmit(Request $request){

        $this->validate($request,['title' => 'required',
            'image' => 'required|mimes:jpeg,bmp,png',
            'category' => 'required',
            'description' => 'required',
            'status' => 'required']);


        $news = new News;

        $news->title = Input::get('title');
        $news->slug = str_slug(Input::get('title'));
        $news->category_id = Input::get('category');
        $news->description = Input::get('description');
        $news->status = Input::get('status');
        $news->published_date = Input::get('published_date');
        $news->created_at = date('Y-m-d');

        $news->save();

        if(Input::file('image') != ""){
            $image = Input::file('image');
            $image_name=time()."_".$image->getClientOriginalName();
            $path = public_path('uploads/news')."/".$image_name;
            Image::make($image->getRealPath())->save($path);
            $news_data['image'] = $image_name;
            News::where('id',$news->id)->update($news_data);
		
        }

        Session::flash('add_success','News has been successfully added.');
        return redirect('admin/news');

    }

    public function edit($id){
        $data['news'] = News::where('id',$id)->first();
        $data['category'] = NewsCategory::where('status', 'active')->get();
        return view('news::admin.v_edit_news',$data);
    }

    public function editSubmit(Request $request){

        $this->validate($request,['title' => 'required',
            'image' => 'mimes:jpeg,bmp,png',
            'category' => 'required',
            'description' => 'required',
            'status' => 'required']);

        $news = News::find(Input::get('id'));

        $news->title = Input::get('title');
        $news->slug = str_slug(Input::get('title'));
        $news->category_id = Input::get('category');
        $news->description = Input::get('description');
        $news->status = Input::get('status');
        $news->published_date = Input::get('published_date');
        $news->save();

        if(Input::file('image')!=""){
            $image = Input::file('image');
            $image_name=time()."_".$image->getClientOriginalName();
            $path = public_path('uploads/news')."/".$image_name;
            Image::make($image->getRealPath())->save($path);
            $news_data['image'] = $image_name;
            News::where('id',Input::get('id'))->update($news_data);
        }
        Session::flash('edit_success','News has been successfully added.');
        return redirect('admin/news');
    }

    public function changeStatus($id,$option){
        News::where('id',$id)->update(['status' => $option]);
        Session::flash('status_success','News has been changed');
        return redirect('admin/news');
    }

    public function delete($id){
        News::where('id',$id)->delete();
        print_r(json_encode(['status' => 'success', 'value' => 'News has been deleted.']));
    }

    public function category(){
        $data['categories'] = NewsCategory::paginate(5);
        return view('news::admin.v_categories',$data);
    }

    public function addCategory(){
        return view('news::admin.v_add_category');
    }

    public function editCategory($id){
        $data['category'] = NewsCategory::where('id',$id)->first();
        return view('news::admin.v_edit_category',$data);
    }

    public function changeCategoryStatus($id,$option){
        NewsCategory::where('id',$id)->update(['status' => $option]);
        Session::flash('status_success','Status has been changed');
        return redirect('admin/news/categories');
    }

    public function deleteCategory($id){
        NewsCategory::where('id',$id)->delete();
        News::where('category_id',$id)->delete();
        print_r(json_encode(['status' => 'success', 'value' => 'Category has been deleted.']));
    }

    public function addCategorySubmit(Request $request){
        $this->validate($request,['category' => 'required',
            'image' => 'mimes:jpeg,bmp,png',
            'status' => 'required']);


        $cat = new NewsCategory;

        $cat->category = Input::get('category');
        $cat->slug = str_slug(Input::get('category'));
        $cat->status = Input::get('status');
        $cat->created_at = date('Y-m-d');

        $cat->save();

        if(Input::file('image') != ""){
            $image = Input::file('image');
            $image_name=time()."_".$image->getClientOriginalName();
            $path = public_path('uploads/news')."/".$image_name;
            Image::make($image->getRealPath())->save($path);
            $news_data['image'] = $image_name;
            NewsCategory::where('id',$cat->id)->update($news_data);
        }

        Session::flash('add_success','Category has been successfully added.');
        return redirect('admin/news/categories');
    }

    public function editCategorySubmit(Request $request){
        $this->validate($request,['category' => 'required',
            'image' => 'mimes:jpeg,bmp,png',
            'status' => 'required']);


        $cat = NewsCategory::find(Input::get('id'));

        $cat->category = Input::get('category');
        $cat->slug = str_slug(Input::get('category'));
        $cat->status = Input::get('status');
        $cat->created_at = date('Y-m-d');

        $cat->save();

        if(Input::file('image') != ""){
            $image = Input::file('image');
            $image_name=time()."_".$image->getClientOriginalName();
            $path = public_path('uploads/news')."/".$image_name;
            Image::make($image->getRealPath())->save($path);
            $news_data['image'] = $image_name;
            NewsCategory::where('id',Input::get('id'))->update($news_data);
        }

        Session::flash('add_success','Category has been successfully updated.');
        return redirect('admin/news/categories');
    }

    public function removeImage($id){
        if(News::where('id',$id)->update(['image' => '']))
            print_r(json_encode(['status' => 'success', 'value' => 'Image successfully removed.']));
        else
            print_r(json_encode(['status' => 'error','value' => 'Something went wrong.']));
    }

}