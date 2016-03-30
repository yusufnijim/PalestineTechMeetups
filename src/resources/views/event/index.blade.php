@extends('layout.backend')

@section('content')

    <table border="1" class="event_index table table-striped table-bordered table-hover" id="dataTables-example">
        <thead>
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
        </thead>
        <tbody>
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
        </tbody>

    </table>

    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.11/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.11/js/jquery.dataTables.js"></script>
    <script type="text/javascript" charset="utf8" src="//cdn.datatables.net/plug-ins/1.10.11/filtering/row-based/TableTools.ShowSelectedOnly.js"></script>

    <script>
        $(document).ready(function () {
            $('#dataTables-example').DataTable({
                responsive: true,
                "oTableTools": {
                    "sRowSelect": "multi",
                },
                "oLanguage": {
                    "oFilterSelectedOptions": {
                        AllText: "All Widgets",
                        SelectedText: "Selected Widgets"
                    }
                }
            });
        });
    </script>
@stop