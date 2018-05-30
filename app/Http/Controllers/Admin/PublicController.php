<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;

//引入核心控制器
use App\Http\Controllers\Controller;

//引入验证码类
require_once 'resources/org/code/Code.class.php';

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class PublicController extends Controller
{
    //login载入视图
    public function login()
    {
        return view('public.login');
    }

    public function code()
    {
        //实例化验证码
        $code = new \Code();
        $code->make();
    }

    public function check()
    {
        //获取所有数据
        $input = Input::all();
        //判断是否为空
        $username = $input['username'];
        $password = $input['password'];
        $code = $input['code'];

        //判断验证码是否为空
        if(empty($code))
            return back()->with('msg', '验证码为空！');

        //判断验证码是否正确
        $ver = new \Code();
        if(strtoupper($code) != $ver->get())
        {
            return back()->with('msg', '验证码错误！');
        }

        if(empty($username) || empty($password))
        {
            return back()->with('msg', "用户名或密码为空！");
        }

        $row = DB::table('admin')->where(['name'=>$username, 'password' => $password])->first();

        //登陆成功！存储数据
        if($row)
        {
            //保存在session里
            session(['admin'=>$row]);
            return redirect('admin/index');
        }
        else
        {
            return back()->with('msg', '用户名或密码错误！');
        }
    }

    public function logout()
    {
        session(['admin' => null]);

        return redirect('admin/login');
    }
}
