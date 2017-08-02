@extends('layouts.app')

@section('css')
    <link href={{ URL::asset('static/plugin_folder/jquery-ui_v1.10.0/jquery.ui.datepicker.css') }} rel="stylesheet"/>
    <link href={{ URL::asset('static/plugin_folder/jquery-ui_v1.10.0/jquery-ui-1.7.2.custom.css') }} rel="stylesheet"/>
    <link href={{ URL::asset('static/contents_folder/questionnaire_list/less/interaction_center.less') }} rel="stylesheet"/>
@stop

@section('question_content')
    <!--右侧内容主体开始-->
    <div class="content_main">
        <div class="content_route"><a href="#none">首页</a>
            <span class="content_route_pathname">>调查问卷</span></div>

        <!--主体内容开始-->
        <div class="content_mb">
            <h2 class="content_mb_title">调查问卷</h2>

            <!--警告框-范例开始-->
            <div class="alert alert-example" role="alert">
                <button type="button" class="close" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
                <strong class="alert_content"></strong>
            </div>
            <!--警告框-范例结束-->


            <!--自己的内容开始-->
            <div class="content_mb_subject">

                <!--导航条开始-->
                <nav class="navbar navbar-default">
                    <button class="btn btn-primary btn_create_questionnaire">创建问卷</button>
                </nav>
                <!--导航条结束-->

                <!--表格开始-->
                <div class="common_table template_list_table">
                    <table class="table table-bordered">
                        <thead>
                        <tr class="table_head">
                            <th class="th_questionnaire_title">问卷名称</th>
                            <th class="th_questionnaire_author">作者</th>
                            <th class="th_questionnaire_sub_title">副标题</th>
                            <th class="th_questionnaire_answer_number">已答</th>
                            <th class="th_questionnaire_template">被存为模板</th>
                            <th class="th_questionnaire_status">状态</th>
                            <th class="th_questionnaire_create_time">创建时间</th>
                            <th class="th_questionnaire_start_time">开始时间</th>
                            <th class="th_questionnaire_end_time">结束时间</th>
                            <th class="th_opr" style="width: 290px">操作</th>
                        </tr>
                        </thead>


                        <tbody>

                        @foreach($questionnaires as $questionnaire)
                            <tr data-id="{{ $questionnaire->id }}">
                                <td>{{ $questionnaire->title }}</td>
                                <td>{{ $questionnaire->author }}</td>
                                <td>{{ $questionnaire->sub_title }}</td>
                                <td>{{ $questionnaire->answer_number }}</td>
                                <td>{{ $questionnaire->is_template == 0 ? '否' : '是' }}</td>
                                <td>{{ $questionnaire->status == 0 ? '异常' : '正常' }}</td>
                                <td>{{ $questionnaire->created_at }}</td>
                                <td>{{ $questionnaire->start_time }}</td>
                                <td>{{ $questionnaire->end_time }}</td>
                                <td>
                                    <div class="btn-group table_btn_group" role="group">

                                        @if($questionnaire->start_time < date("Y-m-d H:i:s") && $questionnaire->end_time && $questionnaire->start_time)
                                            <a type="button" class="btn btn-primary btn_edit" disabled
                                               title="调查问卷一旦开始，不可编辑">不可编辑</a>
                                        @else
                                            <a type="button" href="questionnaire/{{ $questionnaire->id }}"
                                               class="btn btn-primary btn_edit">编辑问题</a>
                                        @endif
                                        {{--<a type="button" href="#none" class="btn btn-primary btn_report_simple" disabled>结果查询</a>--}}
                                        <a type="button" href="/report/simple_query/{{ $questionnaire->id }}" class="btn btn-primary btn_report_simple">结果查询</a>
                                        <a type="button" href="#none" class="btn btn-black btn_delete">删除</a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>

                    </table>
                </div>
                <!--表格结束-->
                <nav>
                    <div class="pull-right">
                        {{ $questionnaires->render() }}
                    </div>
                </nav>
            </div>
            <!--自己的内容结束-->


        </div>
        <!--主体内容结束-->

    </div>
    <!--右侧内容主体结束-->
@stop

@include('questionnaire.modal')

@section('js')
    <script src="{{ URL::asset('static/contents_folder/questionnaire_list/javascripts/interaction_center.js') }}"></script>
@stop