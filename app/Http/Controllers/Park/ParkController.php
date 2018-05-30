<?php

namespace App\Http\Controllers\Park;

use Illuminate\Http\Request;

use App\Http\Requests;

//引入核心控制器
use App\Http\Controllers\Controller;

//引入Response方法
use Illuminate\Support\Facades\Response;

class ParkController extends Controller
{
    public function api()
    {
        //获得全部数据
        $data = \App\Http\Models\news::orderBy('id', 'asc')->get();

        return Response::json($data);
    }

    public function getOne(Request $request)
    {
        $id = $request->input('id');

        $data = new \App\Http\Models\news;

        $info = $data->where('id',$id)->first();

        return Response::json($info);
    }
}