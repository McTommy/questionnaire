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
    @include('questionnaire.mobile_questionnaire.questions_choices')
    <div class="bottom"></div>
@stop

@section('footer')
    <div class="questionnaire_id" style="display: none">{{ $questionnaire_id }}</div>
    <div class="footer">
        <div class="submit">提交问卷</div>
    </div>
@stop

@section('js')
    <script src="{{ URL::asset('mobile_static/contents_folder/new_questionnaire/js/questionnaire.js') }}"></script>
@stop