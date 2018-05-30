<?php

namespace App\Http\Controllers\Articale;

use Request;
use Hash;

//use App\Http\Requests;

//引入核心控制器
use App\Http\Controllers\Controller;

//引入Response方法
use Illuminate\Support\Facades\Response;

//引入操作模型
use APP\Http\Models\articale;

class ArticaleController extends Controller
{
    public function api()
    {
        //获得数据
        $data = \App\Http\Models\articale::orderBy('id', 'asc')->get();

        return Response::json($data);
    }

    //注册
    public function signUp()
    {
        //或取资源列表
        $phone    = Request::any('phone');
        $username = Request::any('username') ;
        $carNUm   = Request::any('carNUm');
        $age      = Request::any('age');
        $sex      = Request::any('sex');
        $email    = Request::any('email');
        $password = Request::any('password');
        $image    = Request::any('image');

        /*检测用户名和密码是否为空*/
        if(!$username || !$password) {
            return ['status' => 0, 'msg' => '用户名和密码不为空'];
        }

        //创建操作用户表的Model
        $data = new \App\Http\Models\articale;

        /*查看用户名是否存在*/
        if($data->user_exist($username)) {
            return ['status' => 1, 'msg' => '用户名已存在！'];
        }

        /*加密密码*/
        $hash_password = Hash::make($password);


        //处理文件上传
        if($_FILES['image']['size'] > 0)
        {
            $file = Request::file('image');

            $allow_extensions = ['jpg', 'gif', 'png'];

            if($file->getClientOriginalName() && !in_array($file->getClientOriginalExtension(),@$allow_extensions))
                return back()->with('msg', '上传文件格式错误!');

            //文件格式
            $extension = $file->getClientOriginalExtension();

            //生成随机名
            $filename = str_random(10).'.'.$extension;

            //指定目录
            $Path = 'uploads/news';

            //移动！
            $file->move($Path, $filename);

            //将图片替换为文件名保存到数据库中
            $image = $Path.'/'.$filename;
        }

        /*存入数据库*/
        $bool = $data->signUp($username,$hash_password,$phone,$carNUm,
            $age,$sex,$email,$image);

        if($bool)
            return ['status' => 2, 'msg'=>'注册成功！'];
    }

    //登录
    public function login()
    {
        $username = Request::get('username') ;
        $password = Request::get('password');

        /*检测用户名和密码是否为空*/
        if(!$username || !$password) {
            return ['status' => 0, 'msg' => '用户名和密码不为空'];
        }
        //创建操作用户表的Model
        $data = new \App\Http\Models\articale;

        $user = $data->where('name',$username)->first();

        if(!$user)
            return ['status' => 1, 'msg' =>'用户名不存在!'];

        //检查密码是否正确
        $hash_password = $user->password;


        if(!Hash::check($password, $hash_password))
            return ['status' => 2, 'msg' =>'用户名或密码错误!'];

        //返回图片地址
        $image = $data->where('name','username')->pluck('image');

        //返回信息以及图片
        return Response::json(['status' => 3, 'msg' =>'登录成功!','iamge'=>$image]);

    }
}