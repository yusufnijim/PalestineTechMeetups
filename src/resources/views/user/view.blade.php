@extends('layout.backend')

@section('content')
    {!! Form::open(['method' => 'put', 'files' => true]) !!}

    First Name: {!!  Form::text('first_name', $user->first_name, ['required' => '']) !!} <br/>
    Last Name: {!!  Form::text('last_name', $user->last_name, ['required' => '']) !!} <br/>
    Email: {{ $user->email }} <br/>
    Location: {!!  Form::text('location', $user->location) !!} <br/>
    Full Arabic Name : {!!  Form::text('arabic_full_name', $user->arabic_full_name, ['required' => '']) !!} <br/>


    Phone Number : {!!  Form::text('phone_number', $user->phone_number) !!} <br/>
    profession : {!!  Form::select('profession', $user->professions(), @$user->professions(true)[$user->profession] ) !!}
    <br/>
    profession Location : {!!  Form::text('profession_location', $user->profession_location) !!} <br/>

    Gender: Male {!!  Form::radio('gender', 1, $user->gender == 'male' ? true : '') !!}
    Female {!!  Form::radio('gender', 2, $user->gender == 'female' ? true : '' ) !!}
    <br/>

    <br/>
    {!! $user->imagetag !!}
    Image: {!! Form::file('image') !!}

    {!! Form::submit("save") !!}
    {!! Form::close() !!}



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
