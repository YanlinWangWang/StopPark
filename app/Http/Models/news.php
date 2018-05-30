<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class news extends Model
{
    //定义关联表
    protected $table = 'park';

    protected $primaryKey = 'id';

    public $timestamps = false;

    //从模型中得到的数据
    protected $fillable = ['id', 'name', 'description', 'postion_X', 'postion_Y', 'space', 'price', 'image'];


}
