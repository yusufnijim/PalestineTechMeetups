@extends('layout.backend')

@section('content')


    <table border="1" class="blog_index table table-striped table-bordered table-hover" id="dataTables-example">
        <thead>
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>body</th>
            <th>name</th>
            <th>email</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>

        @foreach($messages as $instance)
            <tr>
                <td>{{ $instance->id }}</td>
                <td>{{ $instance->title }}</td>
                <td>{{ $instance->body }}</td>
                <td>{{ $instance->name }}</td>
                <td>{{ $instance->email }}</td>
                <td>
                    {!! Form::open( [
                        'url' => "/backend/message/$instance->id",
                        "method" => 'delete']
                        ) !!}
                    {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-block' , 'onclick' => 'return confirm("Are you sure you want to delete?")']) !!}
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>

    </table>


    <script>
        $(document).ready(function () {
            $('#dataTables-example').DataTable({
                responsive: true,
                "order": [[0, "desc"]]
            });
        });
    </script>

@stop