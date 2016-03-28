@extends('layout.backend')

@section('content')

    <a href="/survey/create">Create</a><br />
    @foreach($surveys as $survey)
        {{ $survey }}
        <a href="/survey/edit/{{ $survey->id }}">Edit </a>    <br />
        <a href="/survey/view/{{ $survey->id }}">view </a>
        <br/>
        <br/>
        <br/>
    @endforeach
@stop
