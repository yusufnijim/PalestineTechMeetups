@extends('layout.backend')

@section('content')


    Title: {{ $event->title }} <br/>
    Body: {!!  $event->body !!} <br/>
    Date: {{ $event->date }} <br/>
    Location: {{ $event->location }} <br/>

    @if($event->is_registration_open)
        <a href="/registration/signup/{{ $event->id }}">Register now</a>
    @else
        Registration closed
    @endif

@stop