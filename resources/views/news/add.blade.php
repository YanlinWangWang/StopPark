<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>后台管理</title>
    <link rel="stylesheet" type="text/css" href="{{asset('public/assets/css/common.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('public/assets/css/main.css')}}"/>
    <script type="text/javascript" src="js/libs/modernizr.min.js"></script>
</head>
<body>
<div class="topbar-wrap white">
    <div class="topbar-inner clearfix">
        <div class="topbar-logo-wrap clearfix">
            <h1 class="topbar-logo none"><a href="index.html" class="navbar-brand">后台管理</a></h1>
            <ul class="navbar-list clearfix">
                <li><a class="on" href="index.html">首页</a></li>
                <li><a href="#" target="_blank">网站首页</a></li>
            </ul>
        </div>
        <div class="top-info-wrap">
            <ul class="top-info-list clearfix">
                <li><a href="http://www.aspku.com">管理员</a></li>
                <li><a href="http://www.aspku.com">修改密码</a></li>
                <li><a href="http://www.aspku.com">退出</a></li>
            </ul>
        </div>
    </div>
</div>
<div class="container clearfix">
    <div class="sidebar-wrap">
        <div class="sidebar-title">
            <h1>菜单</h1>
        </div>
        <div class="sidebar-content">
            <ul class="sidebar-list">
                <li>
                    <a href="#"><i class="icon-font">&#xe003;</i>常用操作</a>
                    <ul class="sub-menu">
                        <li><a href="{{url('admin/news')}}"><i class="icon-font">&#xe006;</i>停车场管理</a></li>
                        <li><a href="design.html"><i class="icon-font">&#xe005;</i>用户管理</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#"><i class="icon-font">&#xe018;</i>系统管理</a>
                    <ul class="sub-menu">
                        <li><a href="system.html"><i class="icon-font">&#xe017;</i>系统设置</a></li>
                        <li><a href="system.html"><i class="icon-font">&#xe037;</i>清理缓存</a></li>
                        <li><a href="system.html"><i class="icon-font">&#xe046;</i>数据备份</a></li>
                        <li><a href="system.html"><i class="icon-font">&#xe045;</i>数据还原</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
    <!--/sidebar-->
    <div class="main-wrap">

        <div class="crumb-wrap">
            <div class="crumb-list"><i class="icon-font"></i><a href="/jscss/admin/design/">首页</a><span class="crumb-step">&gt;</span><a class="crumb-name" href="/jscss/admin/design/">作品管理</a><span class="crumb-step">&gt;</span><span>新增作品</span></div>
        </div>
        <div class="result-wrap">
            <div class="result-content">
                <form action="{{url('admin/news/store')}}" method="post" id="myform" name="myform" enctype="multipart/form-data">
                    <table class="insert-tab" width="100%">
                        <tbody>
                        <tr>
                            <th><i class="require-red">*</i>停车场名称：</th>
                            <td>
                                <input class="common-text required" id="name" name="name" size="50" value="name" type="text">
                            </td>
                        </tr>
                        <tr>
                            <th><i class="require-red">*</i>经度</th>
                            <td>
                            <input class ="common-text required" id="postion_X" name="postion_X" type="number" step = 0.000001>
                            </td>
                        </tr>
                        <tr>
                            <th><i class="require-red">*</i>纬度</th>
                            <td>
                                <input class ="common-text required" id="postion_Y" name="postion_Y"  type="number" step = 0.000001>
                            </td>
                        </tr>
                        <tr>
                            <th><i class="require-red">*</i>车位数：</th>
                            <td><input class="common-text" name="space" size="50" value="0" type="number"></td>
                        </tr>
                        <tr>
                            <th><i class="require-red">*</i>价格：</th>
                            <td><input class="common-text" name="price" size="50" value="0" type="number" step = 0.001></td>
                        </tr>
                        <tr>
                            <th>停车场图片：</th>
                            <td><input name="image" id="image" type="file"><!--<input type="submit" onclick="submitForm('/jscss/admin/design/upload')" value="上传图片"/>--></td>
                        </tr>
                        <tr>
                            <th>停车场描述：</th>
                            <td><textarea name="description" class="common-textarea" id="description" cols="30" style="width: 98%;" rows="10"></textarea></td>
                        </tr>
                        <tr>
                            <th></th>
                            <td>
                                {{csrf_field()}}
                                <input class="btn btn-primary btn6 mr10" value="提交" type="submit">
                                <input class="btn btn6" onclick="history.go(-1)" value="返回" type="button">
                            </td>
                        </tr>
                        </tbody></table>
                </form>
            </div>
        </div>

    </div>
    <!--/main-->
</div>
</body>
</html>