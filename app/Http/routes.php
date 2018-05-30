<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/



/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

//不需要session
Route::group(['middleware' => ['web']], function () {
    Route::get('/', function () {
        return view('welcome');
    });
    //引入login,登录页面
    Route::get('admin/login','Admin\PublicController@login');
    //code,验证码页面
    Route::get('admin/code','Admin\PublicController@code');

    Route::post('admin/check','Admin\PublicController@check');

});

//需要session验证
Route::group(['middleware' => ['web' , 'admin.login'], 'prefix' => 'admin', 'namespace' => 'Admin'], function () {

    //后台管理页面
    Route::get('index','IndexController@index');

    //修改停车场
    Route::get('news','NewsController@index');

    //查看停车场页面
    Route::get('info', 'NewsController@info');

    //配置add方法
    Route::get('news/add','NewsController@add');

    Route::post('news/store','NewsController@store');

    //设置退出功能
    Route::get('logout' ,'PublicController@logout');

    //删除停车场信息
    Route::any('news/delete','NewsController@delete');

    //刷新停车场信息
    Route::any('news/update','NewsController@update');

    //停车场运营信息
    Route::any('park/infoDay/{id}',function ($id)
    {
        $result = \App\Http\Controllers\Admin\IndexController::parkInfoDay($id);
        //dd($result);
        return view('index.infoDay',['data'=>$result,'message'=>'Hello LaravelAcademy']);
    });

    Route::any('park/infoMonth/{id}',function ($id)
    {
        $result = \App\Http\Controllers\Admin\IndexController::parkInfoMonth($id);

        return view('index.infoMonth',['data'=>$result,'message'=>'Hello LaravelAcademy']);
    });

    //停车场收入信息
    Route::any('park/moneyDay/{id}', function ($id)
    {
        $result = \App\Http\Controllers\Admin\IndexController::parkMoneyDay($id);

        return view('index.moneyDay',['data'=>$result]);
    });

    Route::any('park/moneyMonth/{id}',function ($id)
    {
        $result = \App\Http\Controllers\Admin\IndexController::parkMoneyMonth($id);

        return view('index.moneyMonth',['data'=>$result]);
    });

    //修改一条停车场信息
    Route::any('park/rewrite/{id}', function ($id)
    {
        \App\Http\Controllers\Admin\NewsController::parkRewrite($id);

        return view('news.add');
    });

    //删除停车场信息
    Route::any('park/delete/{id}', function ($id)
    {
        $data = \App\Http\Controllers\Admin\NewsController::parkDelete($id);

        //调用视图
        return view('news.index',['data'=>$data]);
    });

    //停车场进出车辆信息
    Route::any('park/status/{id}', function ($id)
    {
        $history = \App\Http\Controllers\Admin\IndexController::parkstauts($id);

        return view('index.status',['data'=>$history]);
    });
});


//API路由组

//所有停车场
Route::any('admin/Park/api', 'Park\ParkController@api');

//一个停车场信息
Route::any('admin/Park/getOne', 'Park\ParkController@getOne');

//所有用户
Route::any('admin/Articale/api', 'Articale\ArticaleController@api');

//得到一个用户信息
Route::any('admin/Articale/getOne', 'Articale\ArticaleController@getOne');

//注册
Route::any('Articale/signUp', 'Articale\ArticaleController@signUp');

//登陆
Route::any('Articale/login', 'Articale\ArticaleController@login');

//修改密码
Route::any('Articale/passWord', 'Articale\ArticaleController@passWord');

//修改个人信息
Route::any('Articale/inform','Articale\ArticaleController@inform');

//修改车牌
Route::any('Articale/carNum','Articale\ArticaleController@carNUm');

//短信验证
Route::any('Articale/message','Articale\ArticaleController@message');


//车辆管理路由族
Route::group(['middleware' => ['web'], 'prefix' => 'Car' ], function ()
{
    //post方法传递失败！！

    //得到所有信息
    Route::any('getAll','Car\CarController@getAll');

    //进入停车场
    Route::any('InPark', 'Car\CarController@InTime');

    //离开停车场
    Route::any('OutPark', 'Car\CarController@OutTime');

    //是否进入
    Route::any('TestPark', 'Car\CarController@TestPark');
});


