@extends('layout.backend')

@section('content')

    <div>
        <h2>{{ $event->title }} </h2><br/>

        Number of registrars: {{ $number_of_registrars }}<br/>
        Number of accepted: {{ $number_of_accepted }}<br/>
        Number of attended: {{ $number_of_attended }}<br/><br/>

        <button onclick="window.open('/registration/sendemail/{!! $event->id !!}')">Send email</button>
        <button onclick="window.open('/registration/export/{!! $event->id !!}')">Export to excel</button>
        @if($event->require_additional_fields AND $event->survey_id)
            <button onclick="window.open('/survey/result/{{ $event->survey_id }}')">All survey submissions
            </button>
        @endif

        <table border="1" class="event_registration_index table table-striped table-bordered table-hover"
               id="dataTables-example">

            <thead>
            <tr>
                <th>User name</th>
                <th>Arabic full name</th>
                <th>Registered at</th>
                @if($event->require_additional_fields AND $event->survey_id)
                    <th>Addtional fields</th>
                @endif
                <th>Accepted</th>
                <th>Confirmed</th>
                <th>Attended</th>
                <th>Image</th>
            </tr>
            </thead>
            <tbody>
            @foreach($reg as $instance)
                <tr {{ $instance->is_cancelled ? 'title=cancelled' : '' }} style="{{ $instance->is_cancelled ? "color:red" : '' }}">
                    <td> {{ $instance->user->first_name }}</td>
                    <td>{{ $instance->user->arabic_full_name }}</td>
                    <td>{{ $instance->created_at }}</td>

                    @if($event->require_additional_fields AND $event->survey_id)
                        <td>
                            <a href="/survey/result/{{$event->survey_id}}/{{$instance->user->id}}"
                               target="_blank">View</a>
                        </td>
                    @endif

                    <td> {!! Form::open(['method' => 'post', 'url' => 'registration/updateaccepted/' . $event->id]) !!}
                        {!! Form::hidden('user_id', $instance->user_id) !!}
                        {!! Form::hidden('is_accepted', $instance->is_accepted) !!}
                        {!! Form::submit($instance->is_accepted ? 'Yes' : 'No' )!!}
                        {!! Form::close() !!}
                    </td>

                    <td> {{$instance->is_confirmed ? "Yes" : "No" }}</td>

                    <td> {!! Form::open(['method' => 'post', 'url' => 'registration/updateattended/' . $event->id]) !!}
                        {!! Form::hidden('user_id', $instance->user_id) !!}
                        {!! Form::hidden('is_attended', $instance->is_attended) !!}
                        {!! Form::submit($instance->is_attended ? 'Yes' : 'No' )!!}
                        {!! Form::close() !!}
                    </td>


                    <td>{!!  $instance->user->imagetag !!}</td>
                </tr>
            @endforeach
            </tbody>
        </table>

    </div>



    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.11/css/jquery.dataTables.min.css"/>
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.1.2/css/buttons.dataTables.min.css"/>
    <script src="https://cdn.datatables.net/1.10.11/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#dataTables-example').DataTable();
        });
    </script>

@stop