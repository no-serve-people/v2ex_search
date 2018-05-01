<?php

namespace App\Http\Controllers;

use App\Searchistory;
use App\User;
use App\Post;
use App\V2ex;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;
Use Illuminate\Support\Facades\Input;
use App\Http\Requests;
use Gate;
use App\Ip;


class AdminController extends Controller
{

    //仪表盘
    public function getDashboard()
    {
        $user_count = User::all()->count();
        $post_count = Post::all()->count();
        //获取微信公众号类别数
        $cate_count = Post::distinct('wxname')->count('wxname');
        $v2ex_count = V2ex::count('id');
        return view('admin.dashboard', ['user_count' => $user_count, 'post_count' => $post_count, 'cate_count' => $cate_count, 'v2ex_count' => $v2ex_count]);
    }

    //用户列表
    public function getUser()
    {
        //是否有操作权限
        if (Gate::denies('admin', 5)) {
            abort(403);
        }
        $userList = User::all();
        return view('admin.user', ['userList' => $userList]);
    }

    //编辑用户权限信息
    public function getUserEdit($id)
    {
        //是否有操作权限
        if (Gate::denies('admin', 5)) {
            abort(403);
        }
        //调用模型查
        $userInfo = User::find($id);
        return view('admin.userEdit', ['userInfo' => $userInfo]);
    }

    //保存用户角色
    public function setUserAuth(Request $request)
    {
        //是否有操作权限
        if (Gate::denies('admin', 5)) {
            abort(403);
        }
        $id = $request->input('id');
        $auth = $request->input('auth');
        $user = User::find($id);
        $user->auth = $auth;
        $user->save();
        return redirect('admin/user');
    }

    public function ips(Request $request)
    {
        //todo:
        $ips = Ip::withoutGlobalScopes()->with(['user'])->orderBy('user_id', 'id')->paginate(5);
        return view('admin.ips', compact('ips'));
    }

    //获取搜索记录
    public function history()
    {
        //是否有操作权限
        if (Gate::denies('admin', 4)) {
            abort(403);
        }
        $historys = Searchistory::paginate(4);
        return view('admin.history', ['historys' => $historys]);
    }

    //删除搜索记录
    public function historydel()
    {
        //是否有操作权限
        if (Gate::denies('admin', 4)) {
            abort(403);
        }
        $id = Input::get('id');
        $result = Searchistory::destroy($id);
        if ($result) {
            echo true;
        } else {
            echo false;
        }
    }


}
