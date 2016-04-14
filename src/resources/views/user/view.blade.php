@extends('layout.backend')

@section('content')


    <div>
        <h3>{{ $user->full_name }}</h3>
    </div>

    <div>
        Profession: {{ $user->profession }}
    </div>

    <div>
        <img style='float:right' src="{{ $user->image }}"/>
    </div>
    <div>
        Joined at: {{ $user->created_at }}
    </div>

    <div>
        Location: {{ $user->location }}
    </div>

    <div>
        Bio: {{ $user->bio }}
    </div>

    <br/>

    <div style="clear:left; clear:right">
        {{ $user }}
    </div>

    <h2>My events</h2>

    @foreach($user->events_registered as $event)
        @if($event->is_attended AND !$event->is_cancelled)
            <h4>
                <a href="/registration/signup/{{$event->id}}">{{ $event->title}} </a>
                {{ $event->pivot->is_attended }}
            </h4>
        @endif
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
