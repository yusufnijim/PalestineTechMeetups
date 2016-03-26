@extends('layout.backend')

@section('content')


    <table border="1" class="user_index">
        <tr>
            <th>First name</th>
            <th>Last name</th>
            <th>Email</th>
            <th>Image</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
        @foreach($users as $user)
            <tr>
                <td>{{ $user->first_name }}</td>
                <td>{{ $user->last_name }}</td>
                <td>{{ $user->email }}</td>
                <td>{!! $user->imagetag !!}</td>
                <td><a href="{{ url("user/edit/$user->id") }}">edit</a></td>
                <td>
                    {!! Form::open( [
                        'url' => "/event/delete/$user->id",
                        "method" => 'post']
                        ) !!}
                    {!! Form::submit('Delete') !!}
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach


    </table>
@stop