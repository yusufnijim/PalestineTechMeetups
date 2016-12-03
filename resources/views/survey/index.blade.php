@extends('layout.backend')

@section('content')

    <a href="/survey/create">Create</a><br/>

    <table border="1" class="event_index table table-striped table-bordered table-hover" id="dataTables-example">
        <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Description</th>
            <th>Filled</th>
            <th>Submissions</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
        </thead>
        <tbody>
        @foreach($surveys as $instance)
            <tr>
                <td>{{ $instance->id }}</td>
                <td>{{ $instance->name }}</td>
                <td>{{ $instance->description }}</td>
                <td><a href="{{ url("/survey/view/$instance->id") }}" class='btn btn-info'>View</a></td>
                <td><a href="{{ url("/survey/results/$instance->id") }}" class='btn btn-info'>{{ $instance->submissions()->count() }}</a></td>

                <td><a href="{{ url("survey/edit/$instance->id") }}">edit</a></td>

                </td>
                <td>
                    {!! Form::open( [
                        'url' => "/survey/delete/$instance->id",
                        "method" => 'post']
                        ) !!}
                    {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-block' , 'onclick' => 'return confirm("Are you sure you want to delete?")']) !!}
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>

@stop
