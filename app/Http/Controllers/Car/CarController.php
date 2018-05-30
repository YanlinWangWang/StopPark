<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 17-4-9
 * Time: 上午10:03
 */
//名字空间写到文件夹下
namespace App\Http\Controllers\Car;

//时间
use Carbon\Carbon;
use Illuminate\Http\Request;
use Symfony\Component\VarDumper\Cloner\Data;

//引入核心控制器
use App\Http\Controllers\Controller;

//引入Response方法
use Illuminate\Support\Facades\Response;

//引入操作模型
use APP\Http\Models\Car;
use App\Http\Models\news;
use App\Http\Models\articale;

class CarController extends Controller{

    //计算时间差
    private function counttime($time1,$time2)
    {
        $time = strtotime($time1) - strtotime($time2);
        $day = floor($time / 3600 / 24);
        $hour = floor(($time - $day * 3600 * 24) / 3600);
        $min = floor(($time - $hour * 3600 - $day * 3600 * 24) / 60);
        $sec = floor($time - $hour * 3600 - $day * 3600 * 24 - $min * 60);
        return $day . ':' . $hour.':'.$min.':'.$sec;
    }

    //判断是否进入停车场
    public function TestPark(Request $request)
    {
        $phone = $request->input('phone');

        //判断他是否在停车场里
        $carInfo = new \App\Http\Models\Car;
        $carExist = $carInfo->where('phone',$phone)->orderBy('id', 'dsc')->first();

        //判断是否有停车记录
        //没有记录
        if($carExist == null)
        {
            return ['status' => 0, 'msg' => '未进入停车场'];
        }

        //得到离开时间
        $exist = $carExist['OutTime'];

        //有记录 ，并且离开时间为空
        if($exist != null)
        {
            return ['status' => 0, 'msg' => '未进入停车场'];
        }
        else {
            //得到进入时间
            $time = $carExist['InTime'];

            //$time = strtotime($time);

            //得到停车场名称
            $ParkName = $carExist['ParkName'];
            
            //查询进入停车场金额
            $park = new \App\Http\Models\news;
            $park = $park->where('name',$ParkName)->first();
            $price = $park['price'];

            return ['status' => 1, 'msg' => '已进入停车场', 'time'=>$time, 'price'=>$price];
        }
    }

    public function getAll(Request $request)
    {
        //得到电话号码
        $input = $request->all();
        $phone = $input['phone'];

        //获得全部数据
        $data = new \App\Http\Models\Car;

        //按电话号码查询所有得到的数据
        $history = $data->where('phone', $phone)->select('carNum','InTime','OutTime','price','time')->get();

        return Response::json($history);
    }

    //进入停车场
    /*
     * para:车牌号 停车场名称 手机号
     * return 状态直信息
     */
    public function InTime(Request $request)
    {
        $input = $request->all();
        $carNum = $input['carNum'];

        $timezone = 'Asia/ShangHai' ;
        //加上代表地理位置的表示
        $InTime = Carbon::now($timezone);

        //手机号
        $phone = $input['phone'];
/*
        //影射控制器类
        $articale = new articale();

        //判断该手机号是否存在
        $bool = $articale->where('name',$articale);

        //手机号不存在
        if(!$bool)
        {
            return Response::json(['status'=>2, 'msg' => '手机号不存在']);
        }
*/
        //停车场名称
        //从数据库中选择已存在的停车场名称，判断是否存在
        $ParkName = $input['ParkName'];

        $park = new \App\Http\Models\news;

        //判断是否存在
        $exist = $park->where('name',$ParkName)->first();

        //不存在返回
        if(!$exist)
        {
            return ['status' => 1, 'msg'=>'停车场不存在!'];
        }

        //dd($exist);

        if($exist != null)
        {
            //存入数据库
            $In = new \App\Http\Models\Car;

            $In->InTime = $InTime;
            $In->carNum = $carNum;
            $In->phone = $phone;
            $In->ParkName = $ParkName;

            $In->save();

            //返回状态直
            return ['status' => 0, 'msg' => '创建成功！'];
        }
        else
        {
            return ['status' => 3, 'msg' => '已进入停车场'];
        }
    }

    //离开停车场
    /*
     * para： 手机号 车牌号 金额
     * return :状态直信息
     */
    public function OutTime(Request $request)
    {
        $input = $request->all();
        $carNum = $input['carNum'];
        $price = $input['price'];

        $timezone = 'Asia/ShangHai' ;
        $OutTime = Carbon::now($timezone);

        //因为在离开一个停车场前不可能到另一个停车场，所以不必检查
        //判断车辆是否存在
        $car = new \App\Http\Models\Car;

        //判断是否存在
        $exist = $car->where('carNum','=',$carNum)->orderBy('id', 'dsc')->first();

        if($exist)
        {
            //exist中保存的是该car信息
            //存在保存数据
            $exist->carNum = $carNum;
            $exist->price = $price;
            $exist->OutTime = $OutTime;
            $exist->time = $this->counttime($OutTime, $exist['InTime']);

            $exist->save();

            //返回状态直
            return ['status' => 0, 'msg' => '插入数据库！'];
        }
        else
        {
            return ['status' => 1, 'msg' => '此车未进入停车场！'];
        }

    }
}

?>