<?php

namespace App\Http\Controllers\Admin;

use App\Http\Models\news;
use Illuminate\Http\Request;

use App\Http\Requests;

//引入核心控制器
use App\Http\Controllers\Controller;

//引入Response方法
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;
use Symfony\Component\Routing\Route;

class NewsController extends Controller
{
    //定义index方法
    public function index()
    {
        //得到所有数据,每一页显示5条
        $data = \App\Http\Models\news::orderBy('id', 'asc')->paginate(5);

        //调用视图
        return view('news.index',['data'=>$data]);
    }

    //访问停车场数据
    public function info()
    {
        //得到所有数据,每一页显示5条
        $data = \App\Http\Models\news::orderBy('id', 'asc')->paginate(5);

        //调用视图
        return view('index.info',['data'=>$data]);
    }

    //添加add方法
    public function add()
    {
        return view('news.add');
    }

    public function store(Request $request)
    {
        //接受表
        $input = $request->all();

        //dd($request);

        //文件上传
        $file = $request->file('image');


        //Test file exist
        if($file != null) {
            //判断文件上传过程中是否出错
            // if wrong!
            if (!$file->isValid()) {
                /*
                $Path = realpath(public_path('uploads/news'));

                //文件格式
                $extension = $file->getClientOriginalExtension();
                */
                //生成随机名
                $filename = str_random(10);

                //$file->move($Path,$filename);

                //文件路径，保存的是文件名
                //文件保存在/uploads/news下
                $input['image'] = 'public/uploads/news' . '/' . $filename;

            } else {
                $Path = realpath(public_path('uploads/news'));

                //文件格式
                $extension = $file->getClientOriginalExtension();

                //生成随机名
                $filename = str_random(10) . '.' . $extension;

                $file->move($Path, $filename);

                //文件路径，保存的是文件名
                //文件保存在/uploads/news下
                $input['image'] = 'public/uploads/news' . '/' . $filename;

            }
        }

        //Create方法自动保存
        \App\Http\Models\news::create($input);

        return redirect('admin/news');
    }

    //删除全部停车场信息
    public function delete()
   {
       $date = \App\Http\Models\news::where('id', '>', 0)->delete();

       //得到所有数据,每一页显示5条
       $data = \App\Http\Models\news::orderBy('id', 'asc')->paginate(5);

       //调用视图
       return view('news.index',['data'=>$data]);
   }

   //刷新停车场信息
    public function update()
    {
        //得到所有数据,每一页显示5条
        $data = \App\Http\Models\news::orderBy('id', 'asc')->paginate(5);

        //调用视图
        return view('news.index',['data'=>$data]);
    }

    //修改一条停车场信息
    public static function parkRewrite($id)
    {
        //先删除方法
        $park = \App\Http\Models\news::where('id', '=' ,$id);

        $park->delete();

        //返回状态直
        return $park;
 }

    //删除一条停车场信息
    public static function parkDelete($id)
    {
        $park = \App\Http\Models\news::where('id', '=' ,$id)->delete();

        //得到所有数据,每一页显示5条
        $data = \App\Http\Models\news::orderBy('id', 'asc')->paginate(5);

        //调用视图
        return $data;
    }

}
