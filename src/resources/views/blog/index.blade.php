@extends('layout.backend')

@section('content')

    <table border="1" class="blog_index table table-striped table-bordered table-hover" id="dataTables-example">
        <thead>
        <tr>
        
            <th>ID</th>
            <th>Title</th>
            <th>View</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
        </thead>
        <tbody>

        @foreach($blogs as $blog)
            <tr>
                <td>{{ $blog->id }}</td>
                <td>{{ $blog->title }}</td>
                <td><a href="{{ url("/blog/view/$blog->id") }}" class='btn btn-info'>View</a></td>

                <td><a href="{{ url("blog/edit/$blog->id") }}" class='btn btn-info'>edit</a></td>
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
        </tbody>

    </table>


    <script>
        $(document).ready(function () {
            $('#dataTables-example').DataTable({
                responsive: true,
                "order": [[ 0, "desc" ]]
            });
        });
    </script>

@stop