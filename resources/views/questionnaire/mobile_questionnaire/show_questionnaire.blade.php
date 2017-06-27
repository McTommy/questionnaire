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
@stop

@section('content')
    @parent
    <!--单选1 多选2 填空3 矩阵单选4 矩阵量表5 段落说明6 多项填空7-->
    @foreach($questions as $question)
        @if($question->type == 1)
            <div class="question" data-type="1" data-id="{{ $question->order }}" question-id="{{ $question->id }}">
                <div class="question_title" >
                    <span class="que_num">{{ $question->order }}. </span>
                    <span class="que_content">{{ $question->name }}</span>
                    <span class="star">@if($question->is_required == 1)*@endif </span>
                    <span class="type">(单选)</span>
                </div>
                <div class="answer">
                    <div class="options">
                        @foreach($question->choices as $choice)
                            <div class="option">
                                <label><input type="radio" name="{{ $choice->id }}"><span class="radio_new"></span>
                                    <div class="option_content">
                                        @if($choice->content == "其他___")
                                            其他<input type="text" class="other">
                                        @else
                                            {{ $choice->content }}
                                        @endif
                                    </div></label>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @elseif($question->type == 2)
            <div class="question" data-type="2" data-id="{{ $question->order }}"
                 data-max="{{ $question->maximum_option }}" question-id="{{ $question->id }}">
                <div class="question_title" >
                    <span class="que_num">{{ $question->order }}. </span>
                    <span class="que_content">{{ $question->name }}</span>
                    <span class="star">@if($question->is_required == 1)*@endif </span>
                    <span class="type">(多选)</span>
                    <span class="max_choose">(最多选<span>{{ $question->maximum_option }}</span>项)</span>
                </div>
                <div class="answer">
                    <div class="options">
                        @foreach($question->choices as $choice)
                        <div class="option">
                            <label><input type="checkbox" name="{{ $choice->id }}"><span class="check_new"></span>
                                <div class="option_content">
                                    @if($choice->content == "其他___")
                                        其他<input type="text" class="other">
                                    @else
                                        {{ $choice->content }}
                                    @endif
                                </div></label>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @elseif($question->type == 3)
            <div class="question"  data-type="3" data-id="{{ $question->order }}" question-id="{{ $question->id }}">
                <div class="question_title" >
                    <span class="que_num">{{ $question->order }}. </span>
                    <span class="que_content">{{ explode('_', $question->name)[0] }}</span>
                    <span class="star">@if($question->is_required == 1)*@endif </span>
                    <span class="type">(填空)</span>
                </div>
                <div class="answer">
                    <input type="text" class="fill_in">
                </div>
            </div>
        @elseif($question->type == 4)
            <div class="question" data-type="4"
                 data-id="{{ $question->order }}" question-id="{{ $question->id }}">
                <div class="question_title" >
                    <span class="que_num">{{ $question->order }}. </span>
                    <span class="que_content">{{ $question->name }}</span>
                    <span class="star">@if($question->is_required == 1)*@endif </span>
                    <span class="type">(单选)</span>
                </div>
                <div class="answer">
                    <table class="array_single">
                        @foreach($sub_questions as $sub_question)
                            <thead>
                            <tr>
                                <td></td>
                                <td>儿童购物（服装／玩具／母婴用品）</td>
                                <td>亲子娱乐（单次）</td>
                                <td>儿童教育（单次）</td>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>50元以内</td>
                                <td>
                                    <div class="rank_item">
                                        <label><input type="radio" name="single1"><span class="radio_new"></span></label>
                                    </div>
                                </td>
                                <td>
                                    <div class="rank_item">
                                        <label><input type="radio" name="single1"><span class="radio_new"></span></label>
                                    </div>
                                </td>
                                <td>
                                    <div class="rank_item">
                                        <label><input type="radio" name="single1"><span class="radio_new"></span></label>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>50～99元</td>
                                <td>
                                    <div class="rank_item">
                                        <label><input type="radio" name="single1"><span class="radio_new"></span></label>
                                    </div>
                                </td>
                                <td>
                                    <div class="rank_item">
                                        <label><input type="radio" name="single1"><span class="radio_new"></span></label>
                                    </div>
                                </td>
                                <td>
                                    <div class="rank_item">
                                        <label><input type="radio" name="single1"><span class="radio_new"></span></label>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>100～199元</td>
                                <td>
                                    <div class="rank_item">
                                        <label><input type="radio" name="single1"><span class="radio_new"></span></label>
                                    </div>
                                </td>
                                <td>
                                    <div class="rank_item">
                                        <label><input type="radio" name="single1"><span class="radio_new"></span></label>
                                    </div>
                                </td>
                                <td>
                                    <div class="rank_item">
                                        <label><input type="radio" name="single1"><span class="radio_new"></span></label>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>200～399元</td>
                                <td>
                                    <div class="rank_item">
                                        <label><input type="radio" name="single1"><span class="radio_new"></span></label>
                                    </div>
                                </td>
                                <td>
                                    <div class="rank_item">
                                        <label><input type="radio" name="single1"><span class="radio_new"></span></label>
                                    </div>
                                </td>
                                <td>
                                    <div class="rank_item">
                                        <label><input type="radio" name="single1"><span class="radio_new"></span></label>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>400～599元</td>
                                <td>
                                    <div class="rank_item">
                                        <label><input type="radio" name="single1"><span class="radio_new"></span></label>
                                    </div>
                                </td>
                                <td>
                                    <div class="rank_item">
                                        <label><input type="radio" name="single1"><span class="radio_new"></span></label>
                                    </div>
                                </td>
                                <td>
                                    <div class="rank_item">
                                        <label><input type="radio" name="single1"><span class="radio_new"></span></label>
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                        @endforeach
                    </table>

                </div>
            </div>
        @elseif($question->type == 5)

        @elseif($question->type == 6)

        @elseif($question->type == 7)

        @endif
    @endforeach

@stop

@section('footer')
    <div class="footer">
        <div class="submit">提交问卷</div>
    </div>
@stop

@section('js')
    <script src="{{ URL::asset('mobile_static/contents_folder/new_questionnaire/js/questionnaire.js') }}"></script>
@stop