@extends('layout.master')

@section('content')

    <table border="1" class="event_index">
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Date</th>
            <th>View Event</th>
            <th>View registered users</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
        @foreach($events as $event)
            <tr>
                <td>{{ $event->id }}</td>
                <td>{{ $event->title }}</td>
                <td>{{ $event->date }}</td>
                <td><a href="{{ url("/registration/signup/$event->id") }}">View</a></td>
                <td><a href="{{ url("/registration/view/$event->id") }}">Registered users</a></td>

                <td><a href="{{ url("event/edit/$event->id") }}">edit</a></td>
                <td>
                    {!! Form::open( [
                        'url' => "/event/delete/$event->id",
                        "method" => 'post']
                        ) !!}
                    {!! Form::submit('Delete') !!}
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach

    </table>
@stop