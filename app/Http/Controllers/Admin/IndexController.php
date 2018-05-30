<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Http\Controllers\Articale;
use App\Http\Controllers\Car;

//引入核心控制器
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    //index方法
    public function index()
    {
        return view('index.index');
    }


    //停车场运维
    //停车场日运营情况
    //统计0-6，6-12，12-18，18-24之间的车辆进入情况
    public static function parkInfoDay($id)
    {
        //得到停车场名称
        $park = new  \App\Http\Models\news;

        $park = $park->where('id', $id)->first();

        $parkName = $park->name;

        //在carInfo表中检索所有的信息
        $carInfo = new \App\Http\Models\Car;

        $carInfo = $carInfo->where('ParkName', $parkName)->get();

        //得到本地时间
        $timezone = 'Asia/ShangHai' ;

        //新建叔祖保存时间段内统计数据
        $result[] = array(4);

        //取0的话取最大值300
        $result[0] = 300;
        $result[1] = 300;
        $result[2] = 300;
        $result[3] = 300;

        //判断进入时间
        foreach ($carInfo AS $info)
        {
            //判断时间是否在今天或昨天之间
           $day = Carbon::parse($info->InTime,$timezone);

           $bool = $day->isToday();

           //确定为今天进入的车辆
           if($bool)
           {
               //判断时间段
               //首先得到今天日期
               $time = Carbon::today($timezone);

               //dd($day);

               //分别加6小时得到时间段
               //0点-6点
               $time1 = Carbon::today($timezone)->modify('+6 hours');
               //6点-12点
               $time2 = Carbon::today($timezone)->modify('+12 hours');
               //12点-18点
               $time3 = Carbon::today($timezone)->modify('+18 hours');
               //18点-24点
               $time4 = Carbon::today($timezone)->modify('+24 hours');
               //dd($time4);

               //dd($info->InTime);

               //判断是否在0点-6点
               //计算结果使用300-25 每25代表一辆车
               if($day->between($time,$time1))
               {
                   $result[0] = $result[0]-25;
               }
               else if($day->between($time1,$time2))
               {
                   $result[1] = $result[1]-25;
               }
               else if($day->between($time2,$time3))
               {
                   $result[2] = $result[2]-25;
               }
               else if($day->between($time3,$time4))
               {
                   $result[3] = $result[3]-25;
               }

           }
        }

        return $result;
    }

    //停车场月运营情况
    //统计今日以及之前28天的进入情况
    public static function parkInfoMonth($id)
    {
        //得到停车场名称
        $park = new  \App\Http\Models\news;

        $park = $park->where('id', $id)->first();

        $parkName = $park->name;

        //在carInfo表中检索所有的信息
        $carInfo = new \App\Http\Models\Car;

        $carInfo = $carInfo->where('ParkName', $parkName)->get();

        //得到本地时间
        $timezone = 'Asia/ShangHai' ;

        //新建叔祖保存时间段内统计数据
        //取0的话写300
        $result[] = array(4);
        $result[0] = 300;
        $result[1] = 300;
        $result[2] = 300;
        $result[3] = 300;

        //判断进入时间
        foreach ($carInfo AS $info)
        {
            //得到进入时间
            $day = Carbon::parse($info->InTime,$timezone);

            //判断时间是否在本月内
            $month = Carbon::today($timezone)->modify('-28 days');
            $today = Carbon::tomorrow($timezone);
            $bool = $day->between($month,$today);

            //确定为今天进入的车辆
            if($bool)
            {
                //判断时间段
                //首先得到28天前计数开始时日期
                $time = Carbon::today($timezone)->modify('-28 days');

                //得到时间段
                //第一周
                $time1 = Carbon::today($timezone)->modify('-21 days');
                //第二周
                $time2 = Carbon::today($timezone)->modify('-14 days');
                //第三周
                $time3 = Carbon::today($timezone)->modify('-7 days');
                //第四周
                $time4 = Carbon::tomorrow($timezone);

                //判断是否在第一周
                //2.5代表一辆车
                if($day->between($time,$time1))
                {
                    $result[0] = $result[0]-2.5;
                }
                //第二周
                else if($day->between($time1,$time2))
                {
                    $result[1] = $result[1]-2.5;
                }
                //第三周
                else if($day->between($time2,$time3))
                {
                    $result[2] = $result[2]-2.5;
                }
                //第四周
                else if($day->between($time3,$time4))
                {
                    $result[3] = $result[3]-2.5;
                }


            }
        }
        //dd($result);
        return $result;
    }

    //停车场日收入情况
    public static function parkMoneyDay($id)
    {
        //得到停车场名称
        $park = new  \App\Http\Models\news;

        $park = $park->where('id', $id)->first();

        $parkName = $park->name;

        //在carInfo表中检索所有的信息
        $carInfo = new \App\Http\Models\Car;

        $carInfo = $carInfo->where('ParkName', $parkName)->get();

        //得到本地时间
        $timezone = 'Asia/ShangHai' ;

        //新建叔祖保存时间段内统计数据
        $result[] = array(4);
        $result[0] = 300;
        $result[1] = 300;
        $result[2] = 300;
        $result[3] = 300;

        //判断进入时间
        foreach ($carInfo AS $info)
        {
            //判断时间是否在今天或昨天之间
            $day = Carbon::parse($info->InTime,$timezone);

            $bool = $day->isToday();

            //确定为今天进入的车辆
            if($bool)
            {
                //判断时间段
                //首先得到今天日期
                $time = Carbon::today($timezone);

                //dd($day);

                //得到金额
                $money = $info->price;
                //转化
                $money = $money * 100;
                $money = $money * 0.5;

                //分别加6小时得到时间段
                //0点-6点
                $time1 = Carbon::today($timezone)->modify('+6 hours');
                //6点-12点
                $time2 = Carbon::today($timezone)->modify('+12 hours');
                //12点-18点
                $time3 = Carbon::today($timezone)->modify('+18 hours');
                //18点-24点
                $time4 = Carbon::today($timezone)->modify('+24 hours');
                //dd($time4);

                //dd($info->InTime);

                //判断是否在0点-6点
                if($day->between($time,$time1))
                {
                    $result[0] = $result[0]-$money;
                }
                else if($day->between($time1,$time2))
                {
                    $result[1] = $result[1]-$money;
                }
                else if($day->between($time2,$time3))
                {
                    $result[2] = $result[2]-$money;
                }
                else if($day->between($time3,$time4))
                {
                    $result[3] = $result[3]-$money;
                }

                //dd($result);
            }
        }

        return $result;
    }

    //停车场月收入情况
    public static function parkMoneyMonth($id)
    {
        //得到停车场名称
        $park = new  \App\Http\Models\news;

        $park = $park->where('id', $id)->first();

        $parkName = $park->name;

        //在carInfo表中检索所有的信息
        $carInfo = new \App\Http\Models\Car;

        $carInfo = $carInfo->where('ParkName', $parkName)->get();

        //得到本地时间
        $timezone = 'Asia/ShangHai' ;

        //新建叔祖保存时间段内统计数据
        $result[] = array(4);
        $result[0] = 300;
        $result[1] = 300;
        $result[2] = 300;
        $result[3] = 300;

        //判断进入时间
        foreach ($carInfo AS $info)
        {
            //得到进入时间
            $day = Carbon::parse($info->InTime,$timezone);

            //判断时间是否在本月内
            $month = Carbon::today($timezone)->modify('-28 days');
            $today = Carbon::tomorrow($timezone);
            $bool = $day->between($month,$today);

            //得到金额
            $money = $info->price;
            //内置转化
            $money = $money*100;
            $money = $money * 0.05;

            //确定为今天进入的车辆
            if($bool)
            {
                //判断时间段
                //首先得到28天前计数开始时日期
                $time = Carbon::today($timezone)->modify('-28 days');

                //得到时间段
                //第一周
                $time1 = Carbon::today($timezone)->modify('-21 days');
                //第二周
                $time2 = Carbon::today($timezone)->modify('-14 days');
                //第三周
                $time3 = Carbon::today($timezone)->modify('-7 days');
                //第四周
                $time4 = Carbon::tomorrow($timezone);

                //判断是否在第一周
                if($day->between($time,$time1))
                {
                    $result[0] = $result[0]-$money;
                }
                //第二周
                else if($day->between($time1,$time2))
                {
                    $result[1] = $result[1]-$money;
                }
                //第三周
                else if($day->between($time2,$time3))
                {
                    $result[2] = $result[2]-$money;
                }
                //第四周
                else if($day->between($time3,$time4))
                {
                    $result[3] = $result[3]-$money;
                }

            }
        }

        return $result;
    }

    //停车场进出情况查询
    public static function parkstauts($id)
    {
        //通过id 得到停车场名称
        $park = new \App\Http\Models\news;
        $ParkName = $park->where('id', $id)->select('name')->first();
        $ParkName = $ParkName['name'];
        //dd($ParkName);

        //通过停车场名称得到全部数据
        $data = new \App\Http\Models\Car;

        //按停车场名查询所有得到的数据
        $history = $data->where('ParkName', $ParkName)
            ->select('carNum','InTime','OutTime','price','time')->paginate(25);

        //dd($history);
        return $history;
    }
}
