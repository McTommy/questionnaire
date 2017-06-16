<!doctype html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <!--360 浏览器在读取到这个标签后，立即切换对应的极速核-->
    <meta name="renderer" content="webkit">
    <!--优先使用 IE 最新版本和 Chrome-->
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <!--百度禁止转码-->
    <meta http-equiv="Cache-Control" content="no-siteapp"/>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>调查问卷</title>

    <!--全局css开始-->
    <link href="{{ URL::asset('static/plugin_folder/bootstrap_v3.3.5/css/bootstrap.min.css') }}" rel="stylesheet"/>
    <link href="{{ URL::asset('static/plugin_folder/font-awesome/font-awesome.min.css') }}" rel="stylesheet"/>
    <link href="{{ URL::asset('static/common_folder/stylesheets/common_base.css') }}" rel="stylesheet"/>
    <link href="{{ URL::asset('static/common_folder/less/PC_index.less') }}" rel="stylesheet/less"/>
    <link href="{{ URL::asset('static/plugin_folder/jquery-ui_v1.10.0/jquery-ui-1.10.0.custom.css') }}" rel="stylesheet">
    <!--全局css结束-->

    @yield('css')

</head>

<body>


<!--标题栏开始-->
<div class="row header">
    <h2>MEEZAO</h2>

    <div class="toolbar">
        <a href="" class="fa fa-envelope-o toolbar_information_center"><sup class="information_num"><i class="fa fa-circle"></i></sup></a><!--
         --><div class="toolbar_item">
            <a href="#none" class="toolbar_person_information">
                <i class="fa fa-circle"></i>
                <span class="toolbar_user_name">{{ Auth::user()->name }}</span>
            </a>
            <ul class="toolbar_drop_menu">
                {{--<li class="toolopr_modify_password" data-toggle="modal" data-target=".modal_modify_password">修改密码</li>--}}
                {{--<li class="toolopr_phone_solution" data-toggle="modal" data-target=".modal_phone_solution">手机号解绑</li>--}}
                <li class="toolopr_log_out">
                    <a href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                        退出登录
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </li>
            </ul>
        </div>
    </div>
</div>
<!--标题栏结束-->

<!--页面开始-->
<div class="container-fluid wrp">

    <!--导航栏开始-->
    <div class="nav_bar">
        <ul class="nav_bar_level1">
            <li><a href="#none"><span>全数据报表系统</span></a>
                <ul class="nav_bar_level2">
                    <li><a href="#none"><span>微官基础报表</span></a></li>
                    <li><a href="#none"><span>官网基础报表</span></a></li>
                    <li><a href="#none"><span>CRM报表</span></a></li>
                    <li><a href="#none"><span>Meezao免费报表</span></a></li>
                    <li><a href="#none"><span>Meezao付费报表</span></a></li>
                </ul>
            </li>
            <li><a href="#none"><span>微信管理系统</span></a>
                <ul class="nav_bar_level2">
                    <li><a href="#none"><span>文案系统</span></a>
                        <ul class="nav_bar_level3">
                            <li><a href="#none"><i class="fa fa-circle"></i><span>创建文案</span></a></li>
                            <li><a href="#none"><i class="fa fa-circle"></i><span>组合文案</span></a></li>
                            <li><a href="#none"><i class="fa fa-circle"></i><span>文案列表</span></a></li>
                            <li><a href="#none"><i class="fa fa-circle"></i><span>Meezao文案系统</span></a></li>
                        </ul>
                    </li>
                    <li><a href="#none"><span>微信平台管理系统</span></a>
                        <ul class="nav_bar_level3">
                            <li><a href="#none"><i class="fa fa-circle"></i><span>自定义菜单</span></a></li>
                            <li><a href="#none"><i class="fa fa-circle"></i><span>自动回复管理</span></a></li>
                            <li><a href="#none"><i class="fa fa-circle"></i><span>消息管理</span></a></li>
                            <li><a href="#none"><i class="fa fa-circle"></i><span>素材管理</span></a></li>
                        </ul>
                    </li>
                </ul>
            </li>
            <li><a href="#none"><span>官网管理系统</span></a>
                <ul class="nav_bar_level2">
                    <li><a href="#none"><span>微信基础报表</span></a></li>
                    <li><a href="#none"><span>微官网基础报表</span></a></li>
                    <li><a href="#none"><span>会员分析报表</span></a>
                        <ul class="nav_bar_level3">
                            <li><a href="#none"><i class="fa fa-circle"></i><span>Meezao免费报表</span></a></li>
                            <li><a href="#none"><i class="fa fa-circle"></i><span>Meezao付费报表</span></a></li>
                            <li><a href="#none"><i class="fa fa-circle"></i><span>Meezao定制报表</span></a></li>
                        </ul>
                    </li>
                </ul>
            </li>
            <li><a href="#none"><span>M-CRM系统</span></a>
                <ul class="nav_bar_level2">
                    <li><a href="#none"><span>会员分组</span></a></li>
                    <li><a href="#none"><span>分组管理</span></a></li>
                    <li><a href="#none"><span>分组促销</span></a></li>
                    <li><a href="#none"><span>会员分析图表</span></a></li>
                </ul>
            </li>
            <li><a href="#none"><span>卡券管理系统</span></a>
                <ul class="nav_bar_level2">
                    <li><a href="#none"><span>卡券列表</span></a></li>
                </ul>
            </li>
            <li><a href="#none"><span>核销系统</span></a>
                <ul class="nav_bar_level2">
                    <li><a href="#none"><span>网页核销</span></a></li>
                    <li><a href="#none"><span>手机核销</span></a></li>
                    <li><a href="#none"><span>核销记录</span></a></li>
                </ul>
            </li>
            <li><a href="#none"><span>平台管理系统</span></a>
                <ul class="nav_bar_level2">
                    <li><a href="#none"><span>权限管理</span></a></li>
                    <li><a href="#none"><span>品牌管理</span></a></li>
                    <li><a href="#none"><span>系统消息</span></a></li>
                    <li><a href="#none"><span>服务帮助</span></a></li>
                </ul>
            </li>
        </ul>

    </div>
    <!--导航栏结束-->

    <!--右侧内容开始-->
    <div class="content clearfix">


        <!--隐藏警告框标签开始-->
        <div class="alert_hide_tag hide">
            <div class="alert_whether_show"></div>
            <div class="alert_tag_type"></div>
            <div class="alert_tag_delay"></div>
            <div class="alert_tag_content"></div>
        </div>
        <!--隐藏警告框标签结束-->


        <!--右侧内容主体开始-->
        <div class="content_main">
            <div class="content_route"><a href="#none">首页</a>
                <span class="content_route_pathname">>CRM系统>消费者管理</span></div>

            <!--主体内容开始-->
            <div class="content_mb">
                <h2 class="content_mb_title">调查问卷模板</h2>

                <!--警告框-范例开始-->
                <div class="alert alert-example" role="alert">
                    <button type="button" class="close" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <strong class="alert_content"></strong>
                </div>
                <!--警告框-范例结束-->

                @yield('content')

            </div>
            <!--主体内容结束-->

        </div>
        <!--右侧内容主体结束-->


    </div>
    <!--右侧内容结束-->
</div>
<!--页面结束-->

@yield('modal')

@section('footer')
<!--尾部开始-->
<div class="container-fluid foot">
    <h2>Design by Meezao</h2>
</div>
<!--尾部结束-->
@show





</body>

<!--全局js开始-->
<script src="{{ URL::asset('static/plugin_folder/jquery_v1.11.3/jquery-1.11.3.min.js') }}"></script>
<script src="{{ URL::asset('static/plugin_folder/jquery-ui_v1.10.0/jquery-ui-1.10.0.custom.min.js') }}"></script>
<script src="{{ URL::asset('static/plugin_folder/jquery-ui_v1.10.0/jquery-ui-timepicker-addon.js') }}"></script>
<script src="{{ URL::asset('static/plugin_folder/bootstrap_v3.3.5/js/bootstrap.min.js') }}"></script>
<script src="{{ URL::asset('static/plugin_folder/jquery.validate_v1.13.1/jquery.validate-1.13.1.js') }}"></script>
<script src="{{ URL::asset('static/plugin_folder/less_v1.7.0/less.min.js') }}"></script>
<script src="{{ URL::asset('static/common_folder/javascripts/base.js') }}"></script>
<script src="{{ URL::asset('static/common_folder/javascripts/common_index.js') }}"></script>
<!--全局js结束-->
@yield('js')

</html>
