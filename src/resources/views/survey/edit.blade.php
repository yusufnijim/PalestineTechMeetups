@extends('layout.backend')

@section('content')

    <div>
        {!! Form::open(['method'=>'put']) !!}
        Title: {!! Form::text('name', '', ['required' => 'true']) !!} <br/>
        Body: {!! Form::textarea('description', '', ['class'=>'event_body', 'id' => 'event_body']) !!} <br/>


        {!! Form::submit('create') !!}
        {!! Form::close() !!}


    </div>

@stop
