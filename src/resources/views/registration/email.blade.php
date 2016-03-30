@extends('layout.backend')

@section('content')

    {!! Form::open( ['method'=>'post'] ) !!}

    <h2>{{ $event->title }}</h2>

    <br/>
    <br/>

    <div class="form-group">
        {!! Form::label('subject', 'Subject') !!}

        : {!! Form::text('subject', '', ['required' => 'true', 'id' => 'title', 'class' => 'form-control']) !!}
        <br/>
    </div>

    <div class="form-group">
        {!! Form::label('from', 'From') !!}

        : {!! Form::text('from', 'Noreply@nablustechmeetups.com', ['required' => 'true', 'id' => 'title', 'class' => 'form-control', 'disabled' => 'true']) !!}
        <br/>
    </div>


    <div class="form-group">
        {!! Form::label('to', 'To') !!} <br />
        Registered users : {!! Form::checkbox('to', 1) !!} <br/>
        Confirmed users : {!! Form::checkbox('to', 2) !!} <br/>
        Attended users : {!! Form::checkbox('to', 3) !!} <br/>

    </div>

    <div class="form-group">
        {!! Form::label('body', 'Body') !!}

        : {!! Form::textarea('body', '', ['required' => 'true', 'id' => 'title', 'class' => 'form-control']) !!}
        <br/>
    </div>

    <div class="form-group">
        {!! Form::label('confirm_attendance', 'Confirm attendance link') !!}
        : {!! Form::checkbox('confirm_attendance', 1) !!} <br/>

    </div>

    <div class="form-group">
        {!! Form::submit('submit', ['class' => 'btn btn-default']) !!}
    </div>


    {!! Form::close() !!}
@stop