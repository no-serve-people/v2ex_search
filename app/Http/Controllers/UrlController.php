<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Gate;
use App\Url;
use Illuminate\Support\Facades\Input;

class UrlController extends Controller
{
    public function index()
    {
        //是否有操作权限
        if (Gate::denies('admin', 4)) {
            abort(403);
        }
//        $urls = \DB::table('wxurls')->pluck('url');
        $urls = Url::all();
        return view('admin/urls/urllist', ['urls' => $urls]);
    }

    public function add(Request $request)
    {
        //是否有操作权限
        if (Gate::denies('admin', 4)) {
            abort(403);
        }
        //如果传入ID就更新
        $input = $request->all();
        unset($input['_token']);
        if ($request->input('id') != null) {
            $model_url = Url::find($request->input('id'));
            $model_url->update($input);
        } else {
            $model_url = new Url();
            $model_url->create($input);
        }

        return redirect('admin/urllist');

    }

    public function edit($id)
    {
        //是否有操作权限
        if (Gate::denies('admin', 4)) {
            abort(403);
        }
        $url = Url::find($id);
        return view('admin.urls/urledit', ['url' => $url]);
    }

    public function delete()
    {
        //是否有操作权限
        if (Gate::denies('admin', 4)) {
            abort(403);
        }
        $id = Input::get('id');
        $result = Url::destroy($id);
        if ($result) {
            echo true;
        } else {
            echo false;
        }
    }

}