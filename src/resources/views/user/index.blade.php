@extends('layout.backend')

@section('content')


    <table border="1" class="user_index table table-striped table-bordered table-hover" id="dataTables-example">
        <tr>
            <th>First name</th>
            <th>Last name</th>
            <th>Email</th>
            <th>Image</th>
            <th>Edit</th>
            <th>Delete</th>
            <th>Roles</th>
        </tr>
        @foreach($users as $user)
            <tr>
                <td>{{ $user->first_name }}</td>
                <td>{{ $user->last_name }}</td>
                <td>{{ $user->email }}</td>
                <td>{!! $user->imagetag !!}</td>
                <td><a href="{{ url("user/edit/$user->id") }}" class='btn btn-info'>edit</a></td>
                <td>
                    {!! Form::open( [
                        'url' => "/user/delete/$user->id",
                        "method" => 'delete']
                        ) !!}
                    {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-block' , 'onclick' => 'return confirm("Are you sure you want to delete?")']) !!}
                    {!! Form::close() !!}
                </td>
                <td>
                    <a href="/role/user/{{$user->id}}" class='btn btn-info'>Manage</a>
                </td>
            </tr>
        @endforeach


    </table>
@stop