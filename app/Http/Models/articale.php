<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

use Request;

//用户表
class articale extends Model
{
    //定义关联表
    protected $table = 'articale';

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = ['id', 'name', 'password', 'phone', 'carNum', 'age', 'sex', 'email', 'image'];

    //检测用户是否存在
    public function user_exist($username)
    {
        return $this->where('name', $username)->exists();
    }

    //保存到数据库
    public function SignUp($name, $password, $phone, $carNUm,
                           $age, $sex, $email, $image)
    {
        $this->name = $name;
        $this->password = $password;
        $this->phone = $phone;
        $this->carNum = $carNUm;
        $this->age = $age;
        $this->sex = $sex;
        $this->email = $email;
        $this->image = $image;

        $this->save();

        return true;
    }

}
