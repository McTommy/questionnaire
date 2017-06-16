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

    <title>首页</title>

    <!--全局css开始-->
    <link href="{{ URL::asset('static/plugin_folder//bootstrap_v3.3.5/css/bootstrap.min.css') }}" rel="stylesheet"/>
    <link href="{{ URL::asset('static/plugin_folder/font-awesome/font-awesome.min.css') }}" rel="stylesheet"/>
    <link href="{{ URL::asset('static/common_folder/stylesheets/common_base.css') }}" rel="stylesheet"/>
    <link href="{{ URL::asset('static/common_folder/less/PC_index.less') }}" rel="stylesheet/less"/>
    <!--全局css结束-->

    @yield('css')
</head>
<body>

@yield('content')

</body>
<!--全局js开始-->
<script src="{{ URL::asset('static/plugin_folder/jquery_v1.11.3/jquery-1.11.3.min.js') }}"></script>
<script src="{{ URL::asset('static/plugin_folder/bootstrap_v3.3.5/js/bootstrap.min.js') }}"></script>
<script src="{{ URL::asset('static/plugin_folder/jquery.validate_v1.13.1/jquery.validate-1.13.1.js') }}"></script>
<script src="{{ URL::asset('static/plugin_folder/less_v1.7.0/less.min.js') }}"></script>
<script src="{{ URL::asset('static/common_folder/javascripts/base.js') }}"></script>
<script src="{{ URL::asset('static/common_folder/javascripts/common_index.js') }}"></script>
<!--全局js结束-->
@yield('js')
</html>
