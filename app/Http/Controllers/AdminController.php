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
        //todo:  ip  待做
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

    //图片上传
    public function upload(Request $request)
    {

        file_put_contents('adki', var_export('222222', true), FILE_APPEND);
        $maxFileAge = 5 * 3600; // Temp file age in seconds
        //临时文件夹
        $targetDir = asset('upload_tmp');;
        //保存文件夹
        $uploadDir = asset('upload');
        //清除缓存
        $cleanupTargetDir = true;
        file_put_contents('debug', var_export($uploadDir, true), FILE_APPEND);

        if (!file_exists($targetDir)) {
            @mkdir($targetDir);
        }

        if (!file_exists($uploadDir)) {
            @mkdir($uploadDir);
        }

        if (isset($_REQUEST["name"])) {
            $fileName = $_REQUEST["name"];
        } elseif (!empty($_FILES)) {
            $fileName = $_FILES["file"]["name"];
        } else {
            $fileName = uniqid("file_");
        }
        $fileName = iconv('UTF-8', 'GB2312', $fileName);
        $filePath = $targetDir . DIRECTORY_SEPARATOR . $fileName;
        $uploadPath = $uploadDir . DIRECTORY_SEPARATOR . $fileName;


        $imgUrl = $uploadDir . "/" . $fileName;
        echo $imgUrl;
        file_put_contents('debug', var_export($imgUrl, true), FILE_APPEND);

        $chunk = isset($_REQUEST["chunk"]) ? intval($_REQUEST["chunk"]) : 0;
        $chunks = isset($_REQUEST["chunks"]) ? intval($_REQUEST["chunks"]) : 1;


        if ($cleanupTargetDir) {
            if (!is_dir($targetDir) || !$dir = opendir($targetDir)) {
                die('{"jsonrpc" : "2.0", "error" : {"code": 100, "message": "Failed to open temp directory."}, "id" : "id"}');
            }

            while (($file = readdir($dir)) !== false) {
                $tmpfilePath = $targetDir . DIRECTORY_SEPARATOR . $file;

                if ($tmpfilePath == "{$filePath}_{$chunk}.part" || $tmpfilePath == "{$filePath}_{$chunk}.parttmp") {
                    continue;
                }

                if (preg_match('/\.(part|parttmp)$/', $file) && (@filemtime($tmpfilePath) < time() - $maxFileAge)) {
                    @unlink($tmpfilePath);
                }
            }
            closedir($dir);
        }


        if (!$out = @fopen("{$filePath}_{$chunk}.parttmp", "wb")) {
            die('{"jsonrpc" : "2.0", "error" : {"code": 102, "message": "Failed to open output stream."}, "id" : "id"}');
        }

        if (!empty($_FILES)) {
            if ($_FILES["file"]["error"] || !is_uploaded_file($_FILES["file"]["tmp_name"])) {
                die('{"jsonrpc" : "2.0", "error" : {"code": 103, "message": "Failed to move uploaded file."}, "id" : "id"}');
            }

            if (!$in = @fopen($_FILES["file"]["tmp_name"], "rb")) {
                die('{"jsonrpc" : "2.0", "error" : {"code": 101, "message": "Failed to open input stream."}, "id" : "id"}');
            }
        } else {
            if (!$in = @fopen("php://input", "rb")) {
                die('{"jsonrpc" : "2.0", "error" : {"code": 101, "message": "Failed to open input stream."}, "id" : "id"}');
            }
        }

        while ($buff = fread($in, 4096)) {
            fwrite($out, $buff);
        }

        @fclose($out);
        @fclose($in);

        rename("{$filePath}_{$chunk}.parttmp", "{$filePath}_{$chunk}.part");

        $index = 0;
        $done = true;
        for ($index = 0; $index < $chunks; $index++) {
            if (!file_exists("{$filePath}_{$index}.part")) {
                $done = false;
                break;
            }
        }
        if ($done) {
            if (!$out = @fopen($uploadPath, "wb")) {
                die('{"jsonrpc" : "2.0", "error" : {"code": 102, "message": "Failed to open output stream."}, "id" : "id"}');
            }

            if (flock($out, LOCK_EX)) {
                for ($index = 0; $index < $chunks; $index++) {
                    if (!$in = @fopen("{$filePath}_{$index}.part", "rb")) {
                        break;
                    }

                    while ($buff = fread($in, 4096)) {
                        fwrite($out, $buff);
                    }

                    @fclose($in);
                    @unlink("{$filePath}_{$index}.part");
                }

                flock($out, LOCK_UN);
            }
            @fclose($out);
        }
    }

}
