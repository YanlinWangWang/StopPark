
<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>『停车宝』后台管理</title>
    <link href='{{asset('public/assets/css/admin_login.css')}}' rel="stylesheet" type="text/css" />
</head>
<body>
<div class="admin_login_wrap">
    <h1>后台管理</h1>
    <div class="adming_login_border">
        <div class="admin_input">
            <form action="{{url('admin/check')}}" method="post">
                <ul class="admin_items">
                    <li style = 'text-align: center; color: #942a25' >
                        @if(session('msg'))
                            {{session('msg')}}
                            @endif
                    </li>
                    <li>
                        <label for="user">用户名：</label>
                        <input type="text" name="username" value="admin" id="username" size="30" class="admin_input_style" />
                    </li>
                    <li>
                        <label for="pwd">密码：</label>
                        <input type="password" name="password" value="admin" id="password" size="30" class="admin_input_style" />
                    </li>
                    <li>
                        <label for="pwd">验证码：</label>
                        <input type="password" name="code" value="code" id="code" size="18" class="admin_input_style" />
                        <img src="{{url('admin/code')}}" onclick="this.src = '{{url('admin/code')}}?'+new Date().getTime();"/>
                    </li>
                    <li>
                        <!--生成随机验证-->
                        {{csrf_field()}}
                        <input type="submit" tabindex="3" value="提交" class="btn btn-primary" />
                    </li>
                </ul>
            </form>
        </div>
    </div>
    <p class="admin_copyright"><a tabindex="5" href="http://www.aspku.com/" target="_blank">返回首页</a> &copy; 2014 Powered by <a href="http://www.aspku.com/" target="_blank">源码之家</a></p>
</div>
</body>
</html>
