@extends('layout.backend')

@section('content')


    {{ $user }}
    <br />
    <br />
    <br />
    <br />
    <h2>My events</h2>

    @foreach($user->events_registered as $event)
        <h4>
            <a href="/registration/signup/{{$event->id}}">{{ $event->title}} </a>
            {{ $event->pivot->is_attended }}
        </h4>
    @endforeach


    @if($user->events_volunteered->count())
        <h2>Volunteered</h2>
        @foreach($user->events_volunteered as $event)
            <h4>
                <a href="/registration/signup/{{$event->id}}">{{ $event->title }} </a>
                Type: {{ $event->pivot->type_id }}
            </h4>
        @endforeach
    @endif
@stop
