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
    <!--缩放比例为1-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0,user-scalable=no">

    <title>调查问卷</title>
    <!--全局css开始-->
    <link href="{{ URL::asset('mobile_static/plugin_folder/font-awesome/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('mobile_static/common_folder/stylesheets/common_base.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('mobile_static/common_folder/less/Mobile_index.less') }}" rel="stylesheet/less">
    <!--全局css结束-->
    @yield('css')
</head>
<body>
@section('header')

@show

<div class="content">
    @yield('content')
</div>

@section('footer')
@show
</body>
<!--全局js开始-->
<script src="{{ URL::asset('mobile_static/plugin_folder/jquery_v1.11.3/jquery-1.11.3.min.js') }}"></script>
<script src="{{ URL::asset('mobile_static/plugin_folder/less_v1.7.0/less.min.js') }}"></script>
<script src="{{ URL::asset('mobile_static/common_folder/javascripts/base.js') }}"></script>
<script src="{{ URL::asset('mobile_static/common_folder/javascripts/common_index.js') }}"></script>
<!--全局js结束-->
@yield('js')
</html>