@extends('layouts.app')

@section('css')
    <link rel="stylesheet"
          href="{{ URL::asset('static/contents_folder/questionnaire_report/css/search_result.css') }}">
@stop

@section('question_content')
    <!--右侧内容主体开始-->
    <div class="content_main">
        <div class="content_route"><a href="{{ route('home') }}">首页</a>
            <span class="content_route_pathname">>调查问卷>结果分析</span></div>

        <!--主体内容开始-->
        <div class="content_mb">
            <h2 class="content_mb_title">结果分析</h2>

            <!--警告框-范例开始-->
            <div class="alert alert-example" role="alert">
                <button type="button" class="close" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <strong class="alert_content"></strong>
            </div>
            <!--警告框-范例结束-->


            <!--自己的内容开始-->

            <div class="result_content">
                <div class="part_title">选择条件</div>
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <td>题目／答案</td>
                        <td>与／或</td>
                        <td>题目／答案</td>
                        <td>与／或</td>
                        <td>题目／答案</td>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td class="first_que">
                            <div class="radio" style="display: inline-block">
                                <label>
                                    <input type="radio" name="yesOrNo1" value="1" class="yes_radio" checked>
                                    是
                                </label>
                            </div>
                            <div class="radio" style="display: inline-block">
                                <label>
                                    <input type="radio" name="yesOrNo1" class="no_radio" value="0">
                                    非
                                </label>
                            </div>

                            <div class="que_content">
                                <p>选择题目</p>
                                <select class="choose_que">
                                    <option disabled selected style='display:none;' value="0">请选择题目</option>
                                    @foreach($questions as $question)
                                        @if(in_array($question->type, [1, 2, 4, 5]))
                                            <option data-id="{{ $question->id }}" data-order="{{ $question->order }}"
                                                    data-type="{{ $question->type }}">{{ $question->order . "." . $question->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="child_content">
                                <p>选择子题目</p>
                                <select class="choose_child">
                                    <option disabled selected style='display:none;' value="0">请选择子题目</option>
                                </select>
                            </div>
                            <div class="anw_content">
                                <p>选择答案</p>
                                <select class="choose_anw">
                                    <option disabled selected style='display:none;' value="0">请选择选项</option>

                                </select>
                            </div>
                        </td>
                        <td class="first_logic">
                            <div class="radio">
                                <label>
                                    <input type="radio" name="yesOrNo2" value="and" class="yes_radio" checked>
                                    与
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="yesOrNo2" class="no_radio" value="or">
                                    或
                                </label>
                            </div>
                        </td>
                        <td class="second_que">
                            <div class="que_content">
                                <div class="radio" style="display: inline-block">
                                    <label>
                                        <input type="radio" name="yesOrNo3" value="1" class="yes_radio" checked>
                                        是
                                    </label>
                                </div>
                                <div class="radio" style="display: inline-block">
                                    <label>
                                        <input type="radio" name="yesOrNo3" class="no_radio" value="0">
                                        非
                                    </label>
                                </div>
                                <p>选择题目</p>
                                <select class="choose_que">
                                    <option disabled selected style='display:none;' value="0">请选择题目</option>
                                    @foreach($questions as $question)
                                        @if(in_array($question->type, [1, 2, 4, 5]))
                                            <option data-id="{{ $question->id }}" data-order="{{ $question->order }}"
                                                    data-type="{{ $question->type }}">{{ $question->order . "." . $question->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="child_content">
                                <p>选择子题目</p>
                                <select class="choose_child">
                                    <option disabled selected style='display:none;' value="0">请选择子题目</option>

                                </select>
                            </div>
                            <div class="anw_content">
                                <p>选择答案</p>
                                <select class="choose_anw">
                                    <option disabled selected style='display:none;' value="0">请选择选项</option>

                                </select>
                            </div>
                        </td>
                        <td class="second_logic">
                            <div class="radio">
                                <label>
                                    <input type="radio" name="yesOrNo4" value="and" class="yes_radio"checked>
                                    与
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="yesOrNo4" class="no_radio" value="or">
                                    或
                                </label>
                            </div>
                        </td>
                        <td class="third_que">
                            <div class="que_content">
                                <div class="radio" style="display: inline-block">
                                    <label>
                                        <input type="radio" name="yesOrNo5" value="1" class="yes_radio" checked>
                                        是
                                    </label>
                                </div>
                                <div class="radio" style="display: inline-block">
                                    <label>
                                        <input type="radio" name="yesOrNo5" class="no_radio" value="0">
                                        非
                                    </label>
                                </div>
                                <p>选择题目</p>
                                <select class="choose_que">
                                    <option disabled selected style='display:none;' value="0">请选择题目</option>
                                    @foreach($questions as $question)
                                        @if(in_array($question->type, [1, 2, 4, 5]))
                                            <option data-id="{{ $question->id }}" data-order="{{ $question->order }}"
                                                    data-type="{{ $question->type }}">{{ $question->order . "." . $question->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="child_content">
                                <p>选择子题目</p>
                                <select class="choose_child">
                                    <option disabled selected style='display:none;' value="0">请选择子题目</option>

                                </select>
                            </div>
                            <div class="anw_content">
                                <p>选择答案</p>
                                <select class="choose_anw">
                                    <option disabled selected style='display:none;' value="0">请选择选项</option>

                                </select>
                            </div>
                        </td>
                    </tr>
                    </tbody>

                </table>
                <div class="btn btn-primary search_result">点击查看结果</div>
                <div class="part_title">输出结果：<span class="result"></span>
                </div>


            </div>


            <!--自己的内容结束-->

        </div>
        <!--主体内容结束-->

    </div>
    <!--右侧内容主体结束-->
@stop

@section('footer')
    @parent
    <div class="activity_info_id" style="display: none">{{ $questionnaire_id }}</div>
@endsection

@section('js')
    <script src="{{ URL::asset('static/contents_folder/questionnaire_report/js/search_result.js') }}"></script>
@stop