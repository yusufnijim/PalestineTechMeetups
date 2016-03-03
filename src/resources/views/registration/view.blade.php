@extends('layout.master')

@section('content')

    <div>
        <h2>{{ $event->title }} </h2><br/> <br/> <br/>

        <table border="1" class="event_index">

            <tr>
                <th>User name</th>
                <th>Arabic full name</th>
                <th>Registered at</th>
                <th>Accepted</th>
                <th>Attended</th>
                <th>Image</th>
            </tr>

            @foreach($reg as $instance)
                <tr>
                    <td>{{ $instance->user->first_name }}</td>
                    <td>{{ $instance->user->arabic_full_name }}</td>
                    <td>{{ $instance->created_at }}</td>
                    <td> {!! Form::open() !!}
                        {!! Form::hidden('user_id', $instance->user_id) !!}
                        {!! Form::hidden('is_attend', $instance->is_attend) !!}
                        {!! Form::submit($instance->is_accepted ? 'Yes' : 'No' )!!}
                        {!! Form::close() !!}
                    </td>
                     <td> {!! Form::open() !!}
                        {!! Form::hidden('user_id', $instance->user_id) !!}
                        {!! Form::hidden('is_attend', $instance->is_attend) !!}
                        {!! Form::submit($instance->is_attend ? 'Yes' : 'No' )!!}
                        {!! Form::close() !!}
                    </td>
                    <td>{!!  $instance->user->imagetag !!}</td>
                </tr>
            @endforeach

        </table>

    </div>


@stop