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
                        @foreach($questions as $question)
                            @if($question->parent_order == null)
                            <table class="table table-bordered" data-id="{{ $question->order }}" data-type="{{ $question->type }}">
                                <thead>
                                <tr>
                                    <th>Q<span>{{ $question->order }}</span></th>
                                    <th><span>{{ $question->name }}</span> <span>【{{ question_type($question->type) }}】</span></th>
                                    <th>
                                        <div class="btn-group">
                                            @if($question->type == 1 || $question->type == 2)
                                                <div class="btn btn-default btn_creat_answer">创建答案</div>
                                            @elseif($question->type == 4)
                                                <div class="btn btn-default btn_config_option">配置选项</div>
                                            @elseif($question->type == 5)
                                                <div class="btn btn-default btn_config_rank">配置选项</div>
                                            @endif
                                            <div class="btn btn-default btn_edit_question">编辑</div>
                                            <div class="btn btn-default btn_delete_question">删除</div>
                                        </div>
                                    </th>
                                </tr>
                                </thead>
                                @endif
                                <tbody>
                                {{--单选题--}}
                                @if($question->type == 1)
                                    @foreach($question->choices as $choice)
                                        <tr data="" tr-id="{{ $choice->order }}">
                                            <td><input type="radio" name="radio"></td>
                                            <td>
                                                <span>{{ $choice->content }}</span>
                                                @if($choice->next_question_order != null)
                                                    <span style="color: #00bfd7">(跳转到第<span>{{ $choice->next_question_order }}</span>题）</span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="btn btn-group">
                                                    <div class="btn btn-default btn_edit_answer">编辑</div>
                                                    <div class="btn btn-default btn_delete_answer">删除</div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                {{--多选题    --}}
                                @elseif($question->type == 2)
                                    @foreach($question->choices as $choice)
                                        <tr data="" tr-id="{{ $choice->order }}">
                                            <td><input type="checkbox"></td>
                                            <td>
                                                <span>{{ $choice->content }}</span>
                                                @if($choice->next_question_order != null)
                                                    <span style="color: #00bfd7">(跳转到第<span>{{ $choice->next_question_order }}</span>题）</span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="btn btn-group">
                                                    <div class="btn btn-default btn_edit_answer">编辑</div>
                                                    <div class="btn btn-default btn_delete_answer">删除</div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                {{--矩阵单选题    --}}
                                @elseif($question->type == 4)
                                    @foreach($sub_questions as $sub_question)
                                        @if($question->order == $sub_question->parent_order)
                                            @if(!isset($choice_num))
                                                <tr>
                                                    <td></td>
                                                    <td class="span_group" default-order="{{ $choice_num = 1 }}">
                                                        @foreach($sub_question->choices as $choice)
                                                            <span order="{{ $choice_num++ }}">
                                                                {{ $choice->content }}
                                                            </span>
                                                        @endforeach
                                                    </td>

                                                </tr>
                                            @endif
                                            <tr tr-id="{{ $sub_question->order }}">
                                                <td>{{ $sub_question->name }}</td>
                                                <td class="radio_group">
                                                    @for($i=1;$i<$choice_num;$i++)
                                                        <input type="radio" disabled="">
                                                    @endfor
                                                </td>
                                                <td>
                                                    <div class="btn btn-group">
                                                        <div class="btn btn-default btn_delete_answer">删除</div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach

                                @elseif($question->type == 5)
                                    @foreach($sub_questions as $sub_question)
                                        @if($question->order == $sub_question->parent_order)
                                            @if(!isset($num))
                                                <tr data-status="{{ $num = 1 }}">
                                                    <td></td>
                                                    <td class="rank_span">
                                                        <span>非常不{{ mb_substr($question->measure_word, 0, 2) }}</span>
                                                        <span>非常{{ mb_substr($question->measure_word, 0, 2) }}</span>
                                                    </td>
                                                    <td></td>
                                                </tr>
                                            @endif
                                                <tr tr-id="{{ $sub_question->order }}">
                                                    <td>{{ $sub_question->name }}</td>
                                                    <td class="rank_radio">
                                                        @foreach($sub_question->choices as $choice)
                                                            <input type="radio" disabled="">{{ $choice->content }}
                                                        @endforeach
                                                    </td>
                                                    <td>
                                                        <div class="btn btn-group">
                                                            <div class="btn btn-default btn_delete_answer">删除</div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endif
                                    @endforeach
                                @endif

                                </tbody>
                            </table>
                        @endforeach

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
    <script src="{{ URL::asset('static/contents_folder/questionnaire_configure/js/save_question.js') }}"></script>
@stop