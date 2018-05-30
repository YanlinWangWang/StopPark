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
            </ul>
        </div>
        <div class="top-info-wrap">

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
                        <li><a href="{{url('admin/info')}}"><i class="icon-font">&#xe005;</i>信息统计</a></li>
                    </ul>
                </li>
                <!--
                <li>
                    <a href="#"><i class="icon-font">&#xe018;</i>系统管理</a>
                    <ul class="sub-menu">
                        <li><a href="system.html"><i class="icon-font">&#xe017;</i>系统设置</a></li>
                        <li><a href="system.html"><i class="icon-font">&#xe037;</i>清理缓存</a></li>
                        <li><a href="system.html"><i class="icon-font">&#xe046;</i>数据备份</a></li>
                        <li><a href="system.html"><i class="icon-font">&#xe045;</i>数据还原</a></li>
                    </ul>
                </li>
                -->
            </ul>
        </div>
    </div>
    <!--/sidebar-->
    <div class="main-wrap">

        <div class="crumb-wrap">
            <div class="crumb-list"><i class="icon-font"></i><a href="index.html">首页</a><span class="crumb-step">&gt;</span><span class="crumb-name">停车场管理</span></div>
        </div>
        <div class="search-wrap">
            <div class="search-content">
                <form action="#" method="post">
                    <table class="search-tab">
                        <tr>
                            <th width="70">关键字:</th>
                            <td><input class="common-text" placeholder="关键字" name="keywords" value="" id="" type="text"></td>
                            <td><input class="btn btn-primary btn2" name="sub" value="查询" type="submit"></td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
        <div class="result-wrap">
            <form name="myform" id="myform" method="post">
                <div class="result-title">
                    <div class="result-list">
                        <a href="{{url('admin/news/add')}}"><i class="icon-font"></i>新增停车场</a>
                        <a id="batchDel" href="{{url('admin/news/delete')}}"><i class="icon-font"></i>全部删除</a>
                        <a id="updateOrd" href="{{url('admin/news/update')}}"><i class="icon-font"></i>更新排序</a>
                    </div>
                </div>
                <div class="result-content">
                    <table class="result-tab" width="100%">
                        <tr>
                            <!--<th style="text-align: center">图片</th>-->
                            <th style="text-align: center">名称</th>
                            <th  style="text-align: center">简介</th>
                            <th style="text-align: center">经度</th>
                            <th  style="text-align: center">维度</th>
                            <th  style="text-align: center">车位数</th>
                            <th style="text-align: center" >价格</th>
                            <th style="text-align: center">操作</th>
                        </tr>
                        @foreach($data AS $row)
                            <tr>
                                <!--<td><img width = "80px" height="30px" alt="picture" src="/{{url('QtIcon.png')}}"  ></td>-->
                                <td title="{{$row->name}}"><a target = "blank" href="#" title = {{$row->name}}>{{$row->name}}</a>
                                </td>
                                <td>{{$row->description}}</td>
                                <td>{{$row->postion_X }}</td>
                                <td>{{$row->postion_Y }}</td>
                                <td>{{$row->space}}</td>
                                <td>{{$row->price}}</td>
                                <td>
                                    <?php $id = $row->id;?>
                                    <a class = "link-update" href = "{{url('admin/park/rewrite/'.$id)}}">修改</a>
                                    <a class = "link-del" href = "{{url('admin/park/delete/'.$id)}}">删除</a>
                                        <a class = "link-number" href = "{{url('admin/park/status/'.$id)}}">进出情况</a>
                                </td>
                            </tr>
                            @endforeach
                    </table>
                    <div class="list-page" > {!! $data->render() !!}</div>
                </div>
            </form>
        </div>
    </div>
    <!--/main-->
</div>
</body>
</html>