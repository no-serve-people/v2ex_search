<?php

namespace App\Http\Controllers;

use App\Post;
use App\V2ex;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function search(Request $request)
    {
        //todo:加入索引判断功能
        $q = $request->get('query');
        $paginator = [];
        if ($q) {
            $paginator = Post::search($q)->paginate(3);
            $paginator = V2ex::search($q)->paginate(3);
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
