@extends('layout.backend')


@section('content')
    <div>
        <h2>{{ $event->title }} </h2><br/> <br/> <br/>

        {!!  $event->featuredimagetag !!} <br/>
        Event description{!!  $event->body !!}

        @if(!auth()->check())
            <h4>Login to sign up now !</h4>
        @elseif(! $event->is_registration_open)
            <h4>Sorry registration for this event has been closed</h4>
        @elseif($status)
            <h4> You signed up for this event </h4>
            If you wish to cancel your registration
            {!! Form::open() !!}
            {!! Form::hidden('cancel', 1) !!}
            {!! Form::submit('press here', ['class' => 'btn btn-info']) !!}
            {!! Form::close() !!}
        @else

            @if(!$event->require_addional_fields)
                {!! Form::open() !!}

                {!! Form::submit('register now') !!}
                {!! Form::close() !!}
            @else
                {!! Form::open() !!}

                {!! Form::submit('Register now', ['class' => 'btn btn-success']) !!}
                {!! Form::close() !!}

            @endif
        @endif
    </div>
@stop