@extends('layouts.mobile')

@section('css')
    <link rel="stylesheet" href="{{ URL::asset('mobile_static/contents_folder/new_questionnaire/css/questionnaire.css') }}">
@endsection

@section('header')
    <div class="header">
        <div class="head-logo">
            <img src="{{ URL::asset('mobile_static/contents_folder/new_questionnaire/img/logo.png') }}">
        </div>
    </div>
@endsection

@section('content')
    @parent
    <!--单选1 多选2 填空3 矩阵单选4 矩阵量表5 段落说明6 多项填空7-->


@endsection

@section('footer')
    <div class="footer">
        <div class="submit">提交问卷</div>
    </div>
@endsection

@section('js')
    <script src="{{ URL::asset('mobile_static/contents_folder/new_questionnaire/js/questionnaire.js') }}"></script>
@endsection