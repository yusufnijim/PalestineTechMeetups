@extends('layout.master')


@section('content')
    <div>
        <h2>{{ $event->title }} </h2><br /> <br /> <br />

        Event description{!!  $event->body !!}

        @if($status)
            <h4> You signed up for this event </h4>
        @elseif(! $event->is_registration_open)
            <h4>Sorry registration for this event has been closed</h4>
        @else
            {!! Form::open() !!}

            {!! Form::submit('register now') !!}
            {!! Form::close() !!}
        @endif
    </div>
@stop