<div class="foreword">{{ $questionnaire->title }}</div>
<!--单选1 多选2 填空3 矩阵单选4 矩阵量表5 段落说明6 多项填空7-->
@foreach($questions as $question)
    @if($question->type == 1)
        <div class="question" data-type="1" data-id="{{ $question->order }}" question-id="{{ $question->id }}">
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
                            <label><input type="radio" name="{{ $question->order }}" choice-id="{{ $choice->id }}"
                                          ><span class="radio_new"></span>
                                <div class="option_content">
                                    @if($choice->content == "其他___")
                                        其他<input type="text" class="other">
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
             data-max="{{ $question->maximum_option }}" question-id="{{ $question->id }}">
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
                            <label><input type="checkbox" name="{{ $choice->order }}" choice-id="{{ $choice->id }}"
                                          @if($choice->content == "其他___")
                                          class="other_click"
                                        @endif
                                ><span class="check_new"></span>
                                <div class="option_content">
                                    @if($choice->content == "其他___")
                                        其他<input type="text" class="other">
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
        <div class="question" data-type="3" data-id="{{ $question->order }}" question-id="{{ $question->id }}">
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
                        @endif>
            </div>
        </div>
    @elseif($question->type == 4)
        <div class="question" data-type="4"
             data-id="{{ $question->order }}" question-id="{{ $question->id }}">
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
                                            <label><input type="radio" name="{{ $sub_question->id }}"
                                                          choice-id="{{ $choice->id }}"
                                                          question-id="{{ $sub_question->id }}"><span
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
             data-id="{{ $question->order }}" question-id="{{ $question->id }}">
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
                                            <label><input type="radio" name="{{ $sub_question->id }}"
                                                          choice-id="{{ $choice->id }}"
                                                          question-id="{{ $sub_question->id }}"><span
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
        <div class="question" data-type="7" data-id="{{ $question->order }}" question-id="{{ $question->id }}">
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
                                <input type="text" class="mul_fill_input" choice-id="{{ $choice->id }}">
                            </label>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif
@endforeach