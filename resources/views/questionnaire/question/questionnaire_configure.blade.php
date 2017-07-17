@extends('layouts.app')

@section('css')
    <link rel="stylesheet"
          href="{{ URL::asset('static/contents_folder/questionnaire_configure/css/questionnaire_configure.css') }}">
    <link rel="stylesheet"
          href="{{ URL::asset('static/contents_folder/questionnaire_configure/spinner/jqueryui/jquery-ui-1.10.4.custom.min.css') }}">
@stop

@section('question_content')
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


            <!--自己的内容开始-->
            <div class="content_mb_subject">
                <div>
                    <label for="">请导入问卷上方的图片</label>
                    <form action="{{ url('api/question/save_logo') }}" target="ansynform" method="POST"
                          enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <input type="text" name="id" style="display: none" value="{{ $questionnaire->id }}">
                        <input class="btn btn-default" type="file" name="logo"/>
                        <input class="btn btn-default" type="submit" value="上传" />
                    </form>
                </div>

                <label style="margin-top: 10px">预览：</label>
                <div style="margin-bottom: 10px">
                    <img width="300px" src="{{ URL::asset($questionnaire->img_logo_url) }}" alt="无logo图片">
                </div>
                <!--你可以在这里写你自己的内容了-->
                <div class="step1 clearfix">
                    <p class="step1_title">Step1 : 创建固定问题</p>
                    <div class="fixed_content">
                        <input type="checkbox" class="phone_num"
                               @if($has_phone_number)
                               disabled="disabled" checked
                                @endif
                        >
                        <label>请输入您的手机号____________________</label>
                    </div>
                </div>

                <!--创建问题部分-->
                <div class="step2">
                    <p class="step2_title">Step2 : 创建问题</p>
                    <div class="creat_question_btn btn btn-primary">创建问题</div>
                    <div class="question_content">
                        @foreach($questions as $question)
                            @if($question->parent_order == null)
                                <table class="table table-bordered" data-id="{{ $question->order }}"
                                       @if($question->is_phone_number == 1)
                                       id="phone_que"
                                        @endif
                                >
                                    <thead>
                                    <tr>
                                        <th>Q<span>{{ $question->order }}</span></th>
                                        <th>
                                            <span>{{ $question->name }}</span>
                                            <span>【{{ question_type($question->type) }}】</span>
                                            @if($question->is_required == 1)
                                                <span style="color: red;">*</span>
                                            @endif
                                            @if($question->type == 2 && $question->maximum_option)
                                                <i>
                                                    (最多可选
                                                    <span>{{ $question->maximum_option }}</span>
                                                    项) &nbsp;
                                                </i>
                                            @endif
                                        </th>
                                        <th>
                                            <div class="btn-group">
                                                @if($question->type == 1 || $question->type == 2 || $question->type == 7)
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
                                    {{--单选题 多项填空题--}}
                                    @if($question->type == 1 || $question->type == 7)
                                        @foreach($question->choices as $choice)
                                            <tr
                                                    @if($choice->content == "其他___" && $question->type == 1)
                                                    data="other"
                                                    @if($choice->other_is_required == 1)
                                                    data-other="must"
                                                    @else
                                                    data-other="not"
                                                    @endif
                                                    @endif
                                                    tr-id="{{ $choice->order }}">
                                                <td>
                                                    @if($question->type == 1)
                                                        <input type="radio" name="radio">
                                                    @endif
                                                </td>
                                                <td>
                                                    <span>{{ $choice->content }}</span>
                                                    @if($choice->content == "其他___" && $question->type == 1 && $choice->other_is_required == 1)
                                                        <span style="color: red">*</span>
                                                    @endif
                                                    @if($choice->next_question_order !== null)
                                                        @if($choice->next_question_order === 0)
                                                            <span style='color: #00bfd7'>(跳转到最后)</span>
                                                        @else
                                                            <span style="color: #00bfd7">(跳转到第<span>{{ $choice->next_question_order }}</span>题)</span>
                                                        @endif
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
                                            <tr
                                                    @if($choice->content == "其他___")
                                                    data="other"
                                                    @if($choice->other_is_required == 1)
                                                    data-other="must"
                                                    @else
                                                    data-other="not"
                                                    @endif
                                                    @endif
                                                    tr-id="{{ $choice->order }}">
                                                <td><input type="checkbox"></td>
                                                <td>
                                                    <span>{{ $choice->content }}</span>
                                                    @if($choice->content == "其他___" && $choice->other_is_required == 1)
                                                        <span style="color: red">*</span>
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
                                                        <td class="span_group">
                                                            @php($choice_num = 1)
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
                                                    <tr>
                                                        @php($num = 1)
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
                    <a href="/questionnaire/show/{{ $activity_info_id }}" class="btn btn-primary finish">预览问题</a>
                    @if($first_question)
                        @if($first_question->questionnaire->is_template == 1)
                            <button class="btn btn-primary finish toggle_template">已保存为模板</button>
                        @else
                            <button class="btn btn-primary finish toggle_template">保存为模板</button>
                        @endif
                    @endif
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