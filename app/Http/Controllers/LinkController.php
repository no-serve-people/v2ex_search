<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Link;
use App\Http\Requests;
Use Illuminate\Support\Facades\Input;
use Gate;

class LinkController extends Controller
{
    public function index()
    {
        //是否有操作权限
        if (Gate::denies('admin', 4)) {
            abort(403);
        }
        $links = Link::all();
        return view('admin/links/link', ['links' => $links]);
    }

    public function edit($id)
    {
        //是否有操作权限
        if (Gate::denies('admin', 4)) {
            abort(403);
        }
        $link = Link::find($id);
        return view('admin/links/linkEdit', ['link' => $link]);
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
            $model_link = Link::find($request->input('id'));
            $model_link->update($input);
        } else {
            $model_link = new Link();
            $model_link->create($input);
        }

        return redirect('admin/link');
    }

    //ajax删除
    public function deleteLink()
    {
        //是否有操作权限
        if (Gate::denies('admin', 4)) {
            abort(403);
        }
        $id = Input::get('id');
        $result = Link::destroy($id);
        if ($result) {
            echo true;
        } else {
            echo false;
        }
    }
}
