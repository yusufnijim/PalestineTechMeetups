@extends('layout.backend')

@section('content')

    <div>
        <h2>Volunteers </h2>

        <div>
            @foreach($volunteers as $volunteer)

                {!! Form::open(['method' => 'delete']) !!}

                {{ $volunteer->user->first_name }}
                {{ $volunteer->type }}
                {!! Form::hidden('record_id', $volunteer->id) !!}
                {!! Form::submit("Delete") !!}
                {!! Form::close() !!}
                <br/>
                <br/>

            @endforeach
        </div>
        <div>

            {!! Form::open(['method' => 'post']) !!}
            Member name: {!! Form::select('user_id', $users_list) !!}
            Role: {!! Form::select('type_id', $volunteers_type_list) !!}
            {!! Form::submit('add volunteer') !!}
            {!! Form::close() !!}

        </div>

    </div>
@stop