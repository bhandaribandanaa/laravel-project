<?php namespace Modules\Downloads\Http\Controllers;

use Pingpong\Modules\Routing\Controller;
use Modules\Downloads\Entities\Downloads;
use Modules\Downloads\Entities\DownloadCategory;
use Auth;

class DownloadsController extends Controller
{

    public function getFiles()
    {
        $paginate = 10;
        $files = Downloads::with('event')->where('download_type','File')->where('is_active',1)->orderBy('id', 'DESC')->paginate($paginate);
        $files->setPath('');
        $categories = DownloadCategory::lists('name', 'id');
        return view('downloads::download_file_list')->with(array('files' => $files,'categories'=>$categories->toArray()));
    }

    public function getVideos()
    {
        $paginate = 10;
        $video = Downloads::with('event')->where('download_type','Video')->where('is_active',1)->orderBy('id', 'DESC')->paginate($paginate);
        $video->setPath('');
        $categories = DownloadCategory::lists('name', 'id');
        return view('downloads::download_video_list')->with(array('videos' => $video,'categories'=>$categories->toArray()));

    }

}