<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 17-4-9
 * Time: 上午10:12
 */

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    //定义关联表
    protected $table = 'carInfo';

    protected $primaryKey = 'id';

    public $timestamps = false;

    //从模型中得到的数据
    protected $fillable = ['id', 'carNum', 'InTime', 'OutTime', 'ParkName', 'price'];
}