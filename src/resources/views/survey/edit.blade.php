@extends('survey.form')

@section('form')


    {!! Form::open([ 'method' => 'put']) !!}
    {!! Form::hidden('survey_id', $survey->id, ['id' => 'survey_id']) !!}

    {{--<a href="/survey/view/{{ $survey->id }}">View</a>--}}

@stop
