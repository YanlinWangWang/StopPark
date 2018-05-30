<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>后台管理</title>
    <link rel="stylesheet" type="text/css" href="{{asset('public/assets/css/common.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('public/assets/css/main.css')}}"/>
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
                    <div ><p style="text-align:center;"> 停车场日停车车辆统计</p>
                        <p>数量</p>
                        <p  style="width:24px;height:24px;word-spacing: 3em">  &nbsp; 20  &nbsp;  15  &nbsp; 10  &nbsp; 5   </p>
                        <div class="c">
                            <canvas id="background" width="8" height="3"></canvas>
                            <canvas id="canvas" width="800" height="300"></canvas>
                        </div>

                        <p style="color:#000 ;word-spacing: 1em;"> &nbsp; &nbsp; &nbsp;  &nbsp; 0.00-6.00 &nbsp;&nbsp; &nbsp;   6.00-12.00  &nbsp;
                            &nbsp;   12.00-18.00 &nbsp;
                          &nbsp; 18.00-24.00 &nbsp; &nbsp;
                        <br>

                    </div>
                </div>
            </form>
        </div>
    </div>
    <!--/main-->
</div>
@foreach($data AS $value)
    <span style="display: none" class="aaaa" >{{$value}}</span>
@endforeach
</body>
<script src = "{{asset('public/assets/js/jquery-1.8.3.min.js')}}"></script>
<script type="text/javascript">

    window.onload = function () {
        //通过js取到数据
        var arr1 =document.getElementsByClassName("aaaa")[0].innerHTML;
        var arr2 =document.getElementsByClassName("aaaa")[1].innerHTML;
        var arr3 =document.getElementsByClassName("aaaa")[2].innerHTML;
        var arr4 =document.getElementsByClassName("aaaa")[3].innerHTML;

        //保存在数组当中
        var data = [arr1,arr2,arr3,arr4];

        var background = document.getElementById('background');
        if (background.getContext){
            var b = background.getContext('2d');

            // Line graph
            b.lineWidth = 1;//线条宽度
            b.strokeStyle = '#024';//描边属性颜色
            b.beginPath();//以坐标点为参考点
            b.moveTo(0,25);//参考线高度，从上到下排列列高大小为25px
            b.lineTo(600,25);//参考线长度及列高，长度大小为600px,,高度为275px
            b.moveTo(0,50);//参考线高度，从上到下排列列高大小为50px，高度为250px
            b.lineTo(600,50);
            b.moveTo(0,75);
            b.lineTo(600,75);
            b.moveTo(0,100);
            b.lineTo(600,100);
            b.moveTo(0,125);
            b.lineTo(600,125);
            b.moveTo(0,150);
            b.lineTo(600,150);
            b.moveTo(0,175);
            b.lineTo(600,175);
            b.moveTo(0,200);
            b.lineTo(600,200);
            b.moveTo(0,225);
            b.lineTo(600,225);
            b.moveTo(0,250);
            b.lineTo(600,250);
            b.moveTo(0,275);
            b.lineTo(600,275);
            b.stroke();
        }

        // LINE GRAPH
        var graph = document.getElementById('canvas');
        if (graph.getContext){
            var g = graph.getContext('2d');

            g.lineWidth = 2;
            g.strokeStyle = '#ff0';
            g.shadowColor = '#ff0';
            g.shadowOffsetX = 0;//参考点坐标
            g.shadowOffsetY = 0;//
            g.shadowBlur = 20;//阴影模糊距离

            g.beginPath();
            g.moveTo(0,300);//参考框的高度

            for (var i = 0, l = data.length; i < l; i++) {
                g.lineTo((i + 1) * 150,data[i]);//调整统计表上面点的个数确定,点与点之间的距离为85PX
            }
            g.stroke();
        }



    }
  /*  $(function () {
        window.alert("ahgsg");
        var aaa = $('.aaaa').val();
        window.alert(aaa);

        var background = document.getElementById('background');
        if (background.getContext){
            var b = background.getContext('2d');

            // Line graph
            b.lineWidth = 1;//线条宽度
            b.strokeStyle = '#024';//描边属性颜色
            b.beginPath();//以坐标点为参考点
            b.moveTo(0,25);//参考线高度，从上到下排列列高大小为25px
            b.lineTo(600,25);//参考线长度及列高，长度大小为600px,,高度为275px
            b.moveTo(0,50);//参考线高度，从上到下排列列高大小为50px，高度为250px
            b.lineTo(600,50);
            b.moveTo(0,75);
            b.lineTo(600,75);
            b.moveTo(0,100);
            b.lineTo(600,100);
            b.moveTo(0,125);
            b.lineTo(600,125);
            b.moveTo(0,150);
            b.lineTo(600,150);
            b.moveTo(0,175);
            b.lineTo(600,175);
            b.moveTo(0,200);
            b.lineTo(600,200);
            b.moveTo(0,225);
            b.lineTo(600,225);
            b.moveTo(0,250);
            b.lineTo(600,250);
            b.moveTo(0,275);
            b.lineTo(600,275);
            b.stroke();
        }

        // LINE GRAPH
        var graph = document.getElementById('canvas');
        if (graph.getContext){
            var g = graph.getContext('2d');

            g.lineWidth = 2;
            g.strokeStyle = '#ff0';
            g.shadowColor = '#ff0';
            g.shadowOffsetX = 0;//参考点坐标
            g.shadowOffsetY = 0;//
            g.shadowBlur = 20;//阴影模糊距离

            g.beginPath();
            g.moveTo(0,300);//参考框的高度

            for (var i = 0, l = data.length; i > l; i++) {
                g.lineTo((i + 1) * 85,data[i]);//调整统计表上面点的个数确定,点与点之间的距离为85PX
            }
            g.stroke();
        }


    })

*/



</script>
</html>