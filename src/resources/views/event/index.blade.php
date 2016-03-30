@extends('layout.backend')

@section('content')

    <table border="1" class="event_index table table-striped table-bordered table-hover" id="dataTables-example">
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
            <td><a href="{{ url("/registration/signup/$event->id") }}" class='btn btn-info'>View</a></td>
            <td><a href="{{ url("/registration/view/$event->id") }}" class='btn btn-info'>Registered users</a></td>
            <td><a href="{{ url("/event/volunteers/$event->id") }}" class='btn btn-info'>Volunteers</a></td>

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
                {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-block' , 'onclick' => 'return confirm("Are you sure you want to delete?")']) !!}
                {!! Form::close() !!}
            </td>
            {{ $event->survey }}
        </tr>
    @endforeach

    </table>
    <script>
        $(document).ready(function () {
            $('#dataTables-example').DataTable({
                responsive: true
            });
        });
    </script>
@stop