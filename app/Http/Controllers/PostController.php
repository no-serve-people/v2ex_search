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
            //保存搜索记录
            $user_id=\Auth::id();
            $type=$type;
            \DB::table('searchistory')->insert(
                ['history' => $q, 'user_id' => $user_id,'type' => $type,'created_at'=>now()]
            );
            if ($type == "wx") {
                //微信公众号
                $paginator = Post::search($q)->paginate(3);
            }
            else{
                //V2ex按照时间排序
                $paginator = V2ex::search($q)->paginate(3);
            }
        }

        return view('search', compact('paginator', 'q','type'));
    }

    public function rmrb_index()
    {
        $paginator = [];
        $paginator = Post::orderBy('created_at', 'desc')->where('wxname', '人民日报')->paginate(3);
        return view('posts/rmrb', compact('paginator'));
    }

}
