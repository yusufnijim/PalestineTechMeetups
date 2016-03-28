@extends('layout.backend')

@section('content')

    <table border="1" class="event_index">
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Date</th>
            <th>View Event</th>
            <th>View registered users</th>
            <th>Event Volunteers</th>
            <th>Edit</th>
            <th>Additional info</th>
            <th>Delete</th>
        </tr>
        @foreach($events as $event)
            <tr>
                <td>{{ $event->id }}</td>
                <td>{{ $event->title }}</td>
                <td>{{ $event->date }}</td>
                <td><a href="{{ url("/registration/signup/$event->id") }}">View</a></td>
                <td><a href="{{ url("/registration/view/$event->id") }}">Registered users</a></td>
                <td><a href="{{ url("/event/volunteers/$event->id") }}">Volunteers</a></td>

                <td><a href="{{ url("event/edit/$event->id") }}">edit</a></td>

                <td>
                    @if($event->require_additional_fields)
                        @if($event->survey_id)
                            <a href="{{ url("/survey/edit/$event->survey_id") }}">Info</a>
                        @else
                            <a href="{{ url("/survey/create/?event_id=$event->id") }}">Create</a>
                        @endif
                    @else
                        NO
                    @endif

                </td>
                <td>
                    {!! Form::open( [
                        'url' => "/event/delete/$event->id",
                        "method" => 'post']
                        ) !!}
                    {!! Form::submit('Delete', ['data-confirm' => "Are you sure to delete this item?"]) !!}
                    {!! Form::close() !!}
                </td>
                {{ $event->survey }}
            </tr>
        @endforeach

    </table>
@stop