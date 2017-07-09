@extends('layouts.mobile')

@section('css')
    <link rel="stylesheet"
          href="{{ URL::asset('mobile_static/contents_folder/new_questionnaire/css/questionnaire.css') }}">
@endsection

@section('header')
    <div class="header">
        <div class="head-logo">
            <img src="{{ URL::asset('mobile_static/contents_folder/new_questionnaire/img/logo.png') }}">
        </div>
    </div>
@stop

@section('content')
    <div class="process"><span>0</span>%</div>
    <div class="foreword">{{ $questionnaire->title }}</div>
    <!--单选1 多选2 填空3 矩阵单选4 矩阵量表5 段落说明6 多项填空7-->
    @foreach($questions as $question)
        @if($question->type == 1)
            <div class="question" data-type="1" data-id="{{ $question->order }}" question-id="{{ $question->id }}"
                 @if($question->cache_answers->sum("choice_id") > 0)
                 data-state="true"
                 @else
                 data-state="false"
                    @endif
            >
                <div class="question_title">
                    <span class="que_num">{{ $question->order }}. </span>
                    <span class="que_content">{{ $question->name }}</span>
                    <span class="star">@if($question->is_required == 1)*@endif </span>
                    <span class="type">(单选)</span>
                </div>
                <div class="error_tips" tabindex="2">请填写此题</div>
                <div class="answer">
                    <div class="options">
                        @foreach($question->choices as $choice)
                            <div class="option" data-jump="{{ $choice->next_question_order }}">
                                <label><input type="radio" name="single_{{ $question->id }}"
                                              choice-id="{{ $choice->id }}"
                                              @if($choice->content == "其他___")
                                              class="other_click"
                                              @endif
                                              @if($choice->cache_answer)
                                              checked
                                              @if($choice->other_is_required)
                                              data-other="must"
                                            @endif
                                            @endif
                                    ><span class="radio_new"></span>
                                    <div class="option_content">
                                        @if($choice->content == "其他___")
                                            其他<input type="text" class="other"
                                                     @if($choice->other_is_required)
                                                     placeholder="选择此项内容必填"
                                                     @endif
                                                     value="{{ $choice->cache_answer ? $choice->cache_answer->other : '' }}">
                                        @else
                                            {{ $choice->content }}
                                        @endif
                                    </div>
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @elseif($question->type == 2)
            <div class="question" data-type="2" data-id="{{ $question->order }}"
                 data-max="{{ $question->maximum_option }}" question-id="{{ $question->id }}"
                 @if($question->cache_answers->sum("choice_id") > 0)
                 data-state="true"
                 @else
                 data-state="false"
                    @endif
            >
                <div class="question_title">
                    <span class="que_num">{{ $question->order }}. </span>
                    <span class="que_content">{{ $question->name }}</span>
                    <span class="star">@if($question->is_required == 1)*@endif </span>
                    <span class="type">(多选)</span>
                    @if($question->maximum_option)
                        <span class="max_choose">(最多选<span>{{ $question->maximum_option }}</span>项)</span>
                    @endif
                </div>
                @if($question->maximum_option)
                    <div class="limit_tips">最多选{{ $question->maximum_option }}项</div>
                @endif
                <div class="error_tips" tabindex="2">请填写此题</div>
                <div class="answer">
                    <div class="options">
                        @foreach($question->choices as $choice)
                            <div class="option">
                                <label><input type="checkbox" name="multi_{{ $choice->order }}"
                                              choice-id="{{ $choice->id }}"
                                              @if($choice->content == "其他___")
                                              class="other_click"
                                              @endif
                                              @if($choice->cache_answer)
                                              checked
                                              @if($choice->other_is_required)
                                              data-other="must"
                                            @endif
                                            @endif
                                    ><span class="check_new"></span>
                                    <div class="option_content">
                                        @if($choice->content == "其他___")
                                            其他<input type="text" class="other"
                                                     @if($choice->other_is_required)
                                                     placeholder="选择此项内容必填"
                                                     @endif
                                                     value="{{ $choice->cache_answer ? $choice->cache_answer->other : '' }}">
                                        @else
                                            {{ $choice->content }}
                                        @endif
                                    </div>
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @elseif($question->type == 3)
            <div class="question" data-type="3" data-id="{{ $question->order }}" question-id="{{ $question->id }}"
                 @if($question->cache_blank)
                 data-state="true"
                 @else
                 data-state="false"
                    @endif
            >
                <div class="question_title">
                    <span class="que_num">{{ $question->order }}. </span>
                    <span class="que_content">{{ explode('_', $question->name)[0] }}</span>
                    <span class="star">@if($question->is_required == 1)*@endif </span>
                    <span class="type">(填空)</span>
                </div>
                <div class="error_tips" tabindex="2">请填写此题</div>
                <div class="answer">
                    <input type="text" class="fill_in"
                           @if($question->is_phone_number == 1)
                           id="phone_que" question-id="{{ $question->id }}"
                           @endif
                           value="{{ $question->cache_blank ? $question->cache_blank->content : '' }}"
                    >
                </div>
            </div>
        @elseif($question->type == 4)
            <div class="question" data-type="4"
                 data-id="{{ $question->order }}" question-id="{{ $question->id }}"
                 @php($status = 0)
                 @foreach($sub_questions as $sub_question)
                 @if($question->order == $sub_question->parent_order)
                 @if($sub_question->cache_answers->sum("choice_id") > 0)
                 data-state="true"
                 @php($status = 1)
                 @break
                 @endif
                 @endif
                 @endforeach
                 @if($status != 1)
                 data-state="false"
                    @endif
            >
                <div class="question_title">
                    <span class="que_num">{{ $question->order }}. </span>
                    <span class="que_content">{{ $question->name }}</span>
                    <span class="star">@if($question->is_required == 1)*@endif </span>
                    <span class="type">(单选)</span>
                </div>
                <div class="error_tips" tabindex="2">请填写此题</div>
                <div class="answer">
                    <table class="array_single">
                        @foreach($sub_questions as $sub_question)
                            @if($question->order == $sub_question->parent_order)
                                @if(!isset($choice_num))
                                    <thead>
                                    <tr>
                                        <td></td>
                                        @php($choice_num = 1)
                                        @foreach($sub_question->choices as $choice)
                                            @php($choice_num++)
                                            <td>{{ $choice->content }}</td>
                                        @endforeach
                                    </tr>
                                    </thead>
                                @endif
                            @endif
                        @endforeach
                        <tbody>
                        @foreach($sub_questions as $sub_question)
                            @if($question->order == $sub_question->parent_order)
                                <tr question-id="{{ $sub_question->id }}">
                                    <td>{{ $sub_question->name }}</td>
                                    @foreach($sub_question->choices as $choice)
                                        <td>
                                            <div class="rank_item">
                                                <label><input type="radio" name="matrix_single_{{ $sub_question->id }}"
                                                              choice-id="{{ $choice->id }}"
                                                              question-id="{{ $sub_question->id }}"
                                                              @if($choice->cache_answer)
                                                              checked
                                                            @endif
                                                    ><span
                                                            class="radio_new"></span></label>
                                            </div>
                                        </td>
                                    @endforeach
                                </tr>
                            @endif
                        @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        @elseif($question->type == 5)
            <div class="question" data-type="5"
                 data-id="{{ $question->order }}" question-id="{{ $question->id }}"
                 @php($status = 0)
                 @foreach($sub_questions as $sub_question)
                 @if($question->order == $sub_question->parent_order)
                 @if($sub_question->cache_answers->sum("choice_id") > 0)
                 data-state="true"
                 @php($status = 1)
                 @break
                 @endif
                 @endif
                 @endforeach
                 @if($status != 1)
                 data-state="false"
                    @endif
            >
                <div class="question_title">
                    <span class="que_num">{{ $question->order }}. </span>
                    <span class="que_content">{{ $question->name }}</span>
                    <span class="star">@if($question->is_required == 1)*@endif </span>
                    <span class="type">(打分题，请点选)</span>
                </div>
                <div class="error_tips" tabindex="2">请填写此题</div>
                <div class="answer">
                    <table class="rank">
                        <thead>
                        <tr>
                            <td></td>
                            <td>
                                <span class="fl">非常不{{ mb_substr($question->measure_word, 0, 2) }}</span>
                                <span class="fr">非常{{ mb_substr($question->measure_word, 0, 2) }}</span>
                            </td>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($sub_questions as $sub_question)
                            @if($question->order == $sub_question->parent_order)
                                <tr>
                                    <td>{{ $sub_question->name }}</td>
                                    <td>
                                        <div class="rank_item">
                                            @foreach($sub_question->choices as $choice)
                                                <label><input type="radio" name="matrix_scale_{{ $sub_question->id }}"
                                                              choice-id="{{ $choice->id }}"
                                                              question-id="{{ $sub_question->id }}"
                                                              @if($choice->cache_answer)
                                                              checked
                                                            @endif
                                                    ><span
                                                            class="radio_new"></span>{{ $choice->content }}</label>
                                            @endforeach
                                        </div>

                                    </td>
                                </tr>
                            @endif
                        @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        @elseif($question->type == 6)
            <div class="question" data-type="6" data-id="{{ $question->order }}">
                <div class="question_title">
                    <strong>
                        <span class="que_content">{{ $question->name }}</span>
                    </strong>
                </div>
            </div>
        @elseif($question->type == 7)
            <div class="question" data-type="7" data-id="{{ $question->order }}" question-id="{{ $question->id }}"
                 @if($question->cache_answers->sum("choice_id") > 0)
                 data-state="true"
                 @else
                 data-state="false"
                    @endif
            >
                <div class="question_title">
                    <span class="que_num">{{ $question->order }}. </span>
                    <span class="que_content">{{ $question->name }}</span>
                    <span class="star">@if($question->is_required == 1)*@endif </span>
                    <span class="type">(填空)</span>
                </div>
                <div class="error_tips" tabindex="2">请填写此题</div>
                <div class="answer">
                    <div class="options">
                        @foreach($question->choices as $choice)
                            <div class="option">
                                <label>
                                    <span class="fill_option">{{ explode('_', $choice->content)[0] }}</span>
                                    <input type="text" class="mul_fill_input" choice-id="{{ $choice->id }}"
                                           value="{{ $choice->cache_answer ? $choice->cache_answer->multi_blank : '' }}">
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif
    @endforeach
    <div class="bottom"></div>
@stop

@section('footer')
    <div class="questionnaire_id" style="display: none">{{ $questionnaire_id }}</div>
    <div class="footer">
        <div class="clearfix">
            <div class="push fl">存储</div>
            <div class="pull fr">载入</div>
        </div>
        <div class="submit">提交问卷</div>
    </div>
@stop

@section('js')
    <script src="{{ URL::asset('mobile_static/contents_folder/new_questionnaire/js/questionnaire.js') }}"></script>
@stop