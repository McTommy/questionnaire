@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ URL::asset('static/contents_folder/questionnaire_configure/css/questionnaire_configure.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('static/contents_folder/questionnaire_configure/spinner/jqueryui/jquery-ui-1.10.4.custom.min.css') }}">
@stop

@section('question_content')
    <!--右侧内容主体开始-->
    <div class="content_main">
        <div class="content_route"><a href="{{ url('home') }}">首页</a>
            <span class="content_route_pathname">>调查问卷>创建调查问卷</span></div>

        <!--主体内容开始-->
        <div class="content_mb">
            <h2 class="content_mb_title">创建调查问卷模板</h2>

            <!--警告框-范例开始-->
            <div class="alert alert-example" role="alert">
                <button type="button" class="close" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <strong class="alert_content"></strong>
            </div>
            <!--警告框-范例结束-->

            <!--自己的内容开始-->
            <div class="content_mb_subject">

                <!--你可以在这里写你自己的内容了-->

                <!--创建问题部分-->
                <div class="step2">
                    <p class="step2_title">创建问题</p>
                    <div class="creat_question_btn btn btn-primary">创建问题</div>
                    <div class="question_content">
                        {{--<table class="table table-bordered">--}}
                            {{--<thead>--}}
                            {{--<tr>--}}
                                {{--<th>Q<span>1</span></th>--}}
                                {{--<th><span>您是否对我们的邮寄服务满意</span> <span>【单选】</span></th>--}}
                                {{--<th>--}}
                                    {{--<div class="btn-group">--}}
                                        {{--<div class="btn btn-default btn_config_rank">配置选项</div>--}}
                                        {{--<div class="btn btn-default btn_edit_question">编辑</div>--}}
                                        {{--<div class="btn btn-default btn_delete_question">删除</div>--}}
                                    {{--</div>--}}
                                {{--</th>--}}
                            {{--</tr>--}}
                            {{--</thead>--}}
                            {{--<tbody>--}}
                            {{--<tr>--}}
                                {{--<td> </td>--}}
                                {{--<td class="rank_span"><span>非常不满意</span><span>非常满意</span> </td>--}}
                                {{--<td></td>--}}
                            {{--</tr>--}}
                            {{--<tr>--}}
                                {{--<td>问题1 </td>--}}
                                {{--<td class="rank_radio"><input type="radio">1<input type="radio">2<input type="radio">3<input type="radio">4</td>--}}
                                {{--<td>--}}
                                    {{--<div class="btn btn-group">--}}
                                        {{--<div class="btn btn-default btn_edit_answer">编辑</div>--}}
                                        {{--<div class="btn btn-default btn_delete_answer">删除</div>--}}
                                    {{--</div>--}}
                                {{--</td>--}}
                            {{--</tr>--}}
                            {{--<tr>--}}
                                {{--<td>问题1 </td>--}}
                                {{--<td class="rank_radio"><input type="radio">1<input type="radio">2<input type="radio">3<input type="radio">4</td>--}}
                                {{--<td>--}}
                                    {{--<div class="btn btn-group">--}}
                                        {{--<div class="btn btn-default btn_edit_answer">编辑</div>--}}
                                        {{--<div class="btn btn-default btn_delete_answer">删除</div>--}}
                                    {{--</div>--}}
                                {{--</td>--}}
                            {{--</tr>--}}
                            {{--</tbody>--}}
                        {{--</table>--}}
                        {{--<table class="table table-bordered">--}}
                            {{--<thead>--}}
                            {{--<tr>--}}
                                {{--<th>Q<span>2</span></th>--}}
                                {{--<th><span>22222222222</span> <span>【单选】</span></th>--}}
                                {{--<th>--}}
                                    {{--<div class="btn-group">--}}
                                        {{--<div class="btn btn-default btn_creat_answer">创建答案</div>--}}
                                        {{--<div class="btn btn-default btn_edit_question">编辑</div>--}}
                                        {{--<div class="btn btn-default btn_delete_question">删除</div>--}}
                                    {{--</div>--}}
                                {{--</th>--}}
                            {{--</tr>--}}

                            {{--</thead>--}}
                            {{--<tbody></tbody>--}}
                        {{--</table>--}}
                        {{--<table class="table table-bordered">--}}
                            {{--<thead>--}}
                            {{--<tr>--}}
                                {{--<th>Q<span>3</span></th>--}}
                                {{--<th><span>33333333333333</span> <span>【单选】</span></th>--}}
                                {{--<th>--}}
                                    {{--<div class="btn-group">--}}
                                        {{--<div class="btn btn-default btn_creat_answer">创建答案</div>--}}
                                        {{--<div class="btn btn-default btn_edit_question">编辑</div>--}}
                                        {{--<div class="btn btn-default btn_delete_question">删除</div>--}}
                                    {{--</div>--}}
                                {{--</th>--}}
                            {{--</tr>--}}

                            {{--</thead>--}}
                            {{--<tbody></tbody>--}}
                        {{--</table>--}}
                        {{--<table class="table table-bordered">--}}
                            {{--<thead>--}}
                            {{--<tr>--}}
                                {{--<th>Q<span>4</span></th>--}}
                                {{--<th><span>4444444444444</span> <span>【单选】</span></th>--}}
                                {{--<th>--}}
                                    {{--<div class="btn-group">--}}
                                        {{--<div class="btn btn-default btn_creat_answer">创建答案</div>--}}
                                        {{--<div class="btn btn-default btn_edit_question">编辑</div>--}}
                                        {{--<div class="btn btn-default btn_delete_question">删除</div>--}}
                                    {{--</div>--}}
                                {{--</th>--}}
                            {{--</tr>--}}
                            {{--</thead>--}}
                            {{--<tbody>--}}
                            {{--<tr>--}}
                                {{--<td></td>--}}
                                {{--<td class="span_group"><span>选项1</span><span>选项1</span><span>选项1</span></td>--}}
                                {{--<td>--}}
                                    {{--<div class="btn btn-default btn_edit_question">编辑</div>--}}
                                {{--</td>--}}
                            {{--</tr>--}}
                            {{--<tr>--}}
                                {{--<td>问题1</td>--}}
                                {{--<td class="radio_group"><input type="radio" name="问题1"><input type="radio" name="问题1"><input type="radio" name="问题1"></td>--}}
                                {{--<td><div class="btn btn-default btn_edit_question">编辑</div></td>--}}
                            {{--</tr>--}}
                            {{--<tr>--}}
                                {{--<td>问题2</td>--}}
                                {{--<td class="radio_group"><input type="radio" name="问题2"><input type="radio" name="问题2"><input type="radio" name="问题2"></td>--}}
                                {{--<td><div class="btn btn-default btn_edit_question">编辑</div></td>--}}


                            {{--</tr>--}}
                            {{--<tr></tr>--}}
                            {{--</tbody>--}}
                        {{--</table>--}}
                    </div>
                </div>
                <div class="finish-creat">
                    <button class="btn btn-primary finish">保存</button>
                </div>
            </div>
            <!--自己的内容结束-->

        </div>
        <!--主体内容结束-->

    </div>
    <!--右侧内容主体结束-->


@endsection

@include('questionnaire.question.modal')

@section('footer')
    @parent
    <div class="activity_info_id" style="display: none">{{ $activity_info_id }}</div>
@endsection

@section('js')
    <script src="{{ URL::asset('static/contents_folder/questionnaire_configure/js/questionnaire_configure.js') }}"></script>
@stop