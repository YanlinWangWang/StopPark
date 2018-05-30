<?php

namespace App\Http\Controllers\Articale;

use Illuminate\Http\Request;

//引入核心控制器
use App\Http\Controllers\Controller;

//引入Response方法
use Illuminate\Support\Facades\Response;

//引入操作模型
use APP\Http\Models\articale;

//引入api头文件
require_once ('/var/www/html/StopPark/app/taobaoAPI/TopSdk.php');

class ArticaleController extends Controller
{
    public function api()
    {
        //获得数据
        $data = \App\Http\Models\articale::orderBy('id', 'asc')->get();

        return Response::json($data);
    }

    //注册
    public function signUp(Request $request)
    {
        //获取资源列表
        $phone    = $request->input('phone');
        $username = $request->input('username') ;
        $carNUm   = $request->input('carNUm');
        $age      = $request->input('age');
        $sex      = $request->input('sex');
        $email    = $request->input('email');
        $password = $request->input('password');
        $image    = $request->input('image');

        /*检测用户名和密码是否为空*/
        if(!$username || !$password) {
            return ['status' => 0, 'msg' => '用户名和密码不为空'];
        }

        //创建操作用户表的Model
        $data = new \App\Http\Models\articale();

        /*查看用户名是否存在*/
        if($data->user_exist($username)) {
            return ['status' => 1, 'msg' => '用户名已存在！'];
        }

        /*加密密码*/
        $hash_password = $password;

        $filename ="";

        //处理文件上传
        {
            //文件上传
            $file = $request->file('image');

            //判断文件上传过程中是否出错
            if(!$file->isValid()){
                exit('文件上传出错！');
            }

            $Path = realpath(public_path('uploads/Articale'));

            //文件格式
            $extension = $file->getClientOriginalExtension();

            //生成随机名
            $filename = str_random(10).'.'.$extension;

            $file->move($Path,$filename);

        }

        $image = '/public/uploads/Articale'.'/'.$filename;

        /*存入数据库*/
        $bool = $data->signUp($username,$hash_password,$phone,$carNUm,
            $age,$sex,$email,$image);

        if($bool)
            return ['status' => 2, 'msg'=>'注册成功！'];
    }

    //登录
    //返回直为一张名为userImage的用户图片和状态直
    public function login(Request $request)
    {
        $username = $request->input('username') ;
        $password = $request->input('password');

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

        if($password != $hash_password)
            return ['status' => 2, 'msg' =>'用户名或密码错误!'];
/*
        if(!Hash::check($password, $hash_password))
            return ['status' => 2, 'msg' =>'用户名或密码错误!'];
*/

        //得到图片
        $image = $user->image;

        //$image = response()->download($image,'userImage');

        //返回信息以及图片
        return Response::json(['status' => 3, 'msg' =>'登录成功!',
            'image'=> $image]);

    }

    //修改密码
    public function passWord(Request $request)
    {
        $username = $request->input('username') ;
        $password = $request->input('password');
        $passwordNew = $request->input('passwordNew');

        //dd(Request::all());

        //创建操作用户表的Model
        $data = new \App\Http\Models\articale;

        $user = $data->where('name',$username)->first();

        if(!$user)
            return ['status' => 1, 'msg' =>'用户名不存在!'];

        //检查密码是否正确
        $hash_password = $user->password;

        if($password != $hash_password)
            return ['status' => 2, 'msg' =>'用户名或密码错误!'];

        $user->password = $passwordNew;

        $bool = $user->save();

        if($bool)
            return ['status' => 3, 'msg' => '修改成功！'];
        else
            return ['status' => 4, 'msg' => '修改失败！'];

    }

    public function inform(Request $request)
    {
        //用户名保存的是电话号码
        $username = $request->input('username');
        //保存的是用户名
        $phone    = $request->input('name');
        $age      = $request->input('age');
        $sex      = $request->input('sex');
        $email    = $request->input('email');

        //dd(Request::all());

        //创建操作用户表的Model
        $data = new \App\Http\Models\articale;

        $user = $data->where('name',$username)->first();

        if(!$user)
            return ['status' => 1, 'msg' =>'用户名不存在!'];

        if($sex == 'm')
            $sex = 1;
        else if($sex == 'f')
            $sex = 2;
        else
            $sex = 3;

        $user->phone  = $phone;
        $user->sex   = $sex;
        $user->email = $email;
        $user->age   = $age;

        $user->save();

        return Response::json(['status'=>'2', 'msg'=>'修改成功！']);
    }

    public function carNum(Request $request)
    {
        $username = $request->input('username');
        $carNUum  = $request->input('carNum');

        //创建操作用户表的Model
        $data = new \App\Http\Models\articale;

        $user = $data->where('name',$username)->first();

        if(!$user)
            return ['status' => 1, 'msg' =>'用户名不存在!'];

        $user->carNum = $carNUum;

        $user->save();

        return Response::json(['status'=>'2', 'msg'=>'修改成功！']);
    }

    public function getOne(Request $request)
    {
        $phone = $request->input('phone');

        $data = new \App\Http\Models\articale;

        $info = $data->where('name',$phone)->first();

        return Response::json($info);
    }

    //短信验证
    //参数：手机号
    //返回验证码
    public function message(Request $request)
    {
        $phone = $request->input('phone');
        $rand = mt_rand(100000,999999);

        $param = "{name:'".$phone."',"."number:'".$rand."'}";
        //dd($param);
        /********************阿里系的东西*****************/
        $secretKey = 'a5d6f60efcad4ee09100f2fc56083d60';
        $c = new \TopClient;

        $c ->appkey ='23779348' ;
        $c ->secretKey =$secretKey;

        $req = new \AlibabaAliqinFcSmsNumSendRequest;

        $req ->setExtend( "" );
        $req ->setSmsType( "normal" );
        $req ->setSmsFreeSignName( "停车宝APP" );
        $req ->setSmsParam( "".$param."" );
        $req ->setRecNum( "".$phone."" );
        $req ->setSmsTemplateCode( "SMS_63910239" );

        $resp = $c->execute( $req );

        //dd($resp);
        /*************************************************************/
        return Response::json(['phone'=>$phone,'rand' => $rand]);
    }
}