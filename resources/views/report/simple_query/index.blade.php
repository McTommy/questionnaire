@extends('layouts.app')

@section('question_content')
    {{ $questionnaire_id }}
    <br>
    <ul>
        @foreach($questions as $question)
            <li>
                <p>id:{{ $question->id }}</p>
                <p>order:{{ $question->order }}</p>
                <p>name:{{ $question->name }}</p>
                <p>type:{{ question_type($question->type) }}</p>
                <p>created_at:{{ $question->created_at }}</p>
            </li>
            <br>
        @endforeach
    </ul>
@stop