<?php

namespace App\Http\Controllers;

use App\Post;
use App\V2ex;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function search(Request $request)
    {
        $q = $request->get('query');
        $type = $request->get('s_type');
        $paginator = [];
        if ($q) {
            if ($type == "wx") {
                $paginator = Post::search($q)->paginate(3);
            }
            else{
                $paginator = V2ex::search($q)->paginate(3);
            }
        }

        return view('search', compact('paginator', 'q'));
    }

    public function rmrb_index()
    {
        $paginator = [];
        $paginator = Post::orderBy('created_at', 'desc')->where('wxname', '人民日报')->paginate(3);
        return view('posts/rmrb', compact('paginator'));
    }

}
