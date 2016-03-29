@extends('layout.backend')

@section('content')


    <table border="1" class="event_index">
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
        @foreach($blogs as $blog)
            <tr>
                <td>{{ $blog->id }}</td>
                <td>{{ $blog->title }}</td>
                <td><a href="{{ url("/blog/view/$blog->id") }}">View</a></td>

                <td><a href="{{ url("blog/edit/$blog->id") }}">edit</a></td>
                <td>
                    {!! Form::open( [
                        'url' => "/blog/delete/$blog->id",
                        "method" => 'post']
                        ) !!}
                    {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-block' , 'onclick' => 'return confirm("Are you sure you want to delete?")']) !!}
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach

    </table>
@stop