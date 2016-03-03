@extends('layout.master')

@section('content')

    <div>
        <h2>{{ $event->title }} </h2><br/>

        Number of registrars: {{ $number_of_registrars }}<br/>
        Number of accepted: {{ $number_of_accepted }}<br/>
        Number of attended: {{ $number_of_attended }}<br/><br/>

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


                    <td> {!! Form::open(['method' => 'post', 'url' => 'registration/updateaccepted/' . $event->id]) !!}
                        {!! Form::hidden('user_id', $instance->user_id) !!}
                        {!! Form::hidden('is_accepted', $instance->is_accepted) !!}
                        {!! Form::submit($instance->is_accepted ? 'Yes' : 'No' )!!}
                        {!! Form::close() !!}
                    </td>


                    <td> {!! Form::open(['method' => 'post', 'url' => 'registration/updateattended/' . $event->id]) !!}
                        {!! Form::hidden('user_id', $instance->user_id) !!}
                        {!! Form::hidden('is_attended', $instance->is_attended) !!}
                        {!! Form::submit($instance->is_attended ? 'Yes' : 'No' )!!}
                        {!! Form::close() !!}
                    </td>


                    <td>{!!  $instance->user->imagetag !!}</td>
                </tr>
            @endforeach

        </table>

    </div>


@stop