@extends('layout.backend')

@section('content')
    <h2>{{ $survey->name }}</h2>
    {{ $survey->description }} <br/> <br/>


    Questions: <br/>
    {!! Form::open() !!} {{--['url'=>'/survey/answer/' . $survey->id]--}}

    @foreach($survey->questions()->orderBy('order')->get() as $question)
        {{$question}}
        <h3>{{ $question->question }}</h3>
        {{ $question->type->name }} <br/>


        @if($question->type->name == 'Short answer')
            {!! Form::text("answer[$question->id]", $question->choice) !!}
        @endif

        @if($question->type->name == 'Paragraph')
            {!! Form::textarea($question->id, $question->choice) !!}
        @endif

        @if($question->type->name == 'Multiple choice')
            @foreach(unserialize($question->choices) as $choice)
                {{ $choice }}: {!! Form::radio($question->id, $question->choice) !!}
            @endforeach

        @endif

        @if($question->type->name == 'Checkboxes')
            @foreach(unserialize($question->choices) as $choice)
                {{ $choice }}: {!! Form::checkbox($question->id, $question->choice) !!}

            @endforeach
        @endif

        @if($question->type->name == 'Dropdown')
            {!! Form::select($question->id , unserialize($question->choice)) !!}
        @endif

        {{--@if($question->type->name == 'Linear scale')--}}
        {{--{!! Form::textarea($question->id, $question->choices) !!}--}}
        {{--@endif--}}

        {{--@if($question->type->name == 'Multiple choice grid')--}}
        {{--{!! Form::textarea($question->id, $question->choices) !!}--}}
        {{--@endif--}}

        @if($question->type->name == 'Date')
            {!! Form::date($question->id, $question->choice) !!}
        @endif

        @if($question->type->name == 'Time')
            {!! Form::date($question->id, $question->choice) !!}
        @endif

        <br/>
        <br/>
        <br/>
    @endforeach

    <br/>
    <br/>
    {!! Form::submit("save") !!}
    {!! Form::close() !!}

@stop
