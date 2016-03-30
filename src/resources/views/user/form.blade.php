@extends('layout.backend')

@section('content')

    @yield('form')
    <div class="form-group">
        {!! Form::label('first_name', 'First Name') !!}
        : {!!  Form::text('first_name', $user->first_name, ['required' => '']) !!} <br/>
    </div>
    <div class="form-group">
        {!! Form::label('last_name', 'Last Name') !!}

        : {!!  Form::text('last_name', $user->last_name, ['required' => '']) !!} <br/>
    </div>
    <div class="form-group">
        Email: {{ $user->email }} <br/>
    </div>
    <div class="form-group">
        {!! Form::label('location', 'Location') !!}

        : {!!  Form::text('location', $user->location) !!} <br/>
    </div>
    <div class="form-group">
        {!! Form::label('arabic_full_name', 'Full Arabic Name') !!}

        : {!!  Form::text('arabic_full_name', $user->arabic_full_name, ['required' => '']) !!} <br/>


    </div>
    <div class="form-group">
        {!! Form::label('phone_number', 'Phone Number') !!}

        : {!!  Form::text('phone_number', $user->phone_number) !!} <br/>
    </div>
    <div class="form-group">
        {!! Form::label('profession', 'profession') !!}


        : {!!  Form::select('profession', $user->professions(), @$user->professions(true)[$user->profession] ) !!}
        <br/>
    </div>
    <div class="form-group">
        {!! Form::label('profession_location', 'profession Location') !!}

        : {!!  Form::text('profession_location', $user->profession_location) !!} <br/>

    </div>
    <div class="form-group">
        {!! Form::label('gender', 'Gender') !!}

        : Male {!!  Form::radio('gender', 1, $user->gender == 'male' ? true : '') !!}
        Female {!!  Form::radio('gender', 2, $user->gender == 'female' ? true : '' ) !!}
        <br/>

        <br/>
        {!! $user->imagetag !!}
    </div>
    <div class="form-group">
        {!! Form::label('image', 'Image') !!}

        : {!! Form::file('image') !!}


    </div>
    <div class="form-group">
        {!! Form::submit('submit', ['class' => 'btn btn-default']) !!}
    </div>
    {!! Form::close() !!}


@stop
