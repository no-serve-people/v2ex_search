<?php

namespace App\Http\Controllers;

use App\Post;
use App\V2ex;
use Illuminate\Http\Request;
class PostController extends Controller
{
    public function search(Request $request)
    {
        //todo:解决分页问题
        $q = $request->get('query');
        $type = $request->get('s_type');
        $posts = [];
        if ($q) {
            //保存搜索记录
            $user_id=\Auth::id();
            $s_type=$type;
            \DB::table('searchistory')->insert(
                ['history' => $q, 'user_id' => $user_id,'type' => $s_type,'created_at'=>now()]
            );
            if ($type == "wx") {
                //微信公众号
                $posts = Post::search($q)->paginate(5);
            }
            else{
                //V2ex按照时间排序
                $posts = V2ex::search($q)->paginate(5);
            }
        }

        return view('search', compact('posts', 'q','type'));
    }

    public function rmrb_index()
    {
        $posts = [];
        $posts = Post::orderBy('created_at', 'desc')->where('wxname', '人民日报')->paginate(3);
        return view('posts/rmrb', compact('posts'));
    }

}
