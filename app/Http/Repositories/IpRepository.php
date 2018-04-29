<?php
namespace App\Http\Repositories;

use App\Ip;
use Illuminate\Http\Request;


class IpRepository extends Repository
{
    static $tag = 'ip';

    /**
     * @param Request $request
     * @return void
     */
    public function createIfNotExisted($request)
    {
        //todo:思考如何保存IP
        $ip = Ip::find($request->ip());
        $user_id = auth()->id();
        if ($ip == null) {
            $ip = new Ip(['id' => $request->ip(), 'user_id' => $user_id]);
            $ip->save();
        } else if ($user_id && $user_id != $ip->user_id) {
            $ip->user_id = $user_id;
            $ip->save();
        }
    }

    public function toggleBlock($ip_address)
    {
        $ip = Ip::findOrFail($ip_address);
        $ip->blocked = !$ip->blocked;
        return $ip->save();
    }


    public function isBlocked($ip_address)
    {
        $ip = Ip::find($ip_address);
        return $ip != null && $ip->blocked;
    }

    public function getOne($ip_address)
    {
        return Ip::findOrFail($ip_address);
    }

    public function model()
    {
        return app(IpRepository::class);
    }

    public function tag()
    {
        return IpRepository::$tag;
    }
}