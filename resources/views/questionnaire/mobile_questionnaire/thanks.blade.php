@extends('layouts.mobile')

@section('css')
    <link rel="stylesheet"
          href="{{ URL::asset('mobile_static/contents_folder/new_questionnaire/css/questionnaire.css') }}">
    <link href="{{ URL::asset('mobile_static/plugin_folder/bootstrap_v3.3.5/css/bootstrap.min.css') }}" rel="stylesheet">
@endsection

@section('header')
    <div class="header">
        <div class="head-logo">
            <img src="{{ URL::asset('mobile_static/contents_folder/new_questionnaire/img/logo.png') }}">
        </div>
    </div>
@stop

@section('content')
    <div class="content">
        <div class="thanks" style="text-align: center">
            <h1>谢谢参与</h1>
            <a class="btn btn-primary" href="/questionnaire/show/{{ $questionnaire_id }}">点此继续填写问卷</a>
        </div>
    </div>
@stop

@section('js')
    <script src="{{ URL::asset('mobile_static/contents_folder/new_questionnaire/js/questionnaire.js') }}"></script>
@stop