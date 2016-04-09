@extends('layout.backend')

@section('content')
    <h2>{{ $survey->name }}</h2>
    {!! $survey->description !!} <br/> <br/>


    <h2>Questions: </h2><br/>
    {!! Form::open(['url'=>'/survey/answer/' . $survey->id]) !!} {{--['url'=>'/survey/answer/' . $survey->id]--}}

    @foreach($survey->questions()->get() as $question)
        {{--{{$question}} <br /><br /><br />--}}

        <h4>{!! Form::label('', $question->title) !!}</h4>
        @if($question->type->name == 'Short answer')

            {!! Form::text("answer[$question->id]", unserialize($question->choice), unserialize($question->other)) !!}
        @endif

        @if($question->type->name == 'Paragraph')
            {!! Form::textarea("answer[$question->id]", unserialize($question->choice)) !!}
        @endif

        @if($question->type->name == 'Multiple choice')
            @foreach(unserialize($question->choice) as $key => $value)
                {{ $value }}: {!! Form::radio("answer[$question->id]", $key) !!}
            @endforeach

        @endif

        @if($question->type->name == 'Checkboxes')
            @foreach(unserialize($question->choice) as $choice)
                {{ $choice }}: {!! Form::checkbox("answer[$question->id]", $question->choice) !!}

            @endforeach
        @endif

        @if($question->type->name == 'Dropdown')
            {!! Form::select("answer[$question->id]" , unserialize($question->choice)) !!}
        @endif

        {{--@if($question->type->name == 'Linear scale')--}}
        {{--{!! Form::textarea($question->id, $question->choices) !!}--}}
        {{--@endif--}}

        {{--@if($question->type->name == 'Multiple choice grid')--}}
        {{--{!! Form::textarea($question->id, $question->choices) !!}--}}
        {{--@endif--}}

        @if($question->type->name == 'Date')
            {!! Form::date("answer[$question->id]", unserialize($question->choice)) !!}
        @endif

        @if($question->type->name == 'Time')
            {!! Form::date("answer[$question->id]", unserialize($question->choice)) !!}
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
