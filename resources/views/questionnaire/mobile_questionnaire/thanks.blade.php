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
    <div class="content">
        <div class="thanks" style="text-align: center">
            <h1>谢谢参与</h1>
        </div>
    </div>
@stop

@section('js')
    <script src="{{ URL::asset('mobile_static/contents_folder/new_questionnaire/js/questionnaire.js') }}"></script>
@stop