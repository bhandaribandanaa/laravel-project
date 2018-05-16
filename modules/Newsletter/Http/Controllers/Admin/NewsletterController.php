<?php namespace Modules\Newsletter\Http\Controllers\Admin;

use App\Newsletter;
use Pingpong\Modules\Routing\Controller;

class NewsletterController extends Controller
{

    public function index()
    {
        $paginate = 10;
        $newsletters = Newsletter::paginate($paginate);
        $newsletters->setPath('');
        return view('newsletter::admin.index')->with(array('newsletters' => $newsletters));
    }

}