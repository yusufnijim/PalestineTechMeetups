@extends('layout.backend')


@section('title', 'Page Title')




@section('sidebar')
    @parent

@endsection


@section('content')
    <br/>
    <br/>
    <br/>
    <br/>

    User: {{ $user->name }} <br/>
    Email: {{ $user->email }} <br/>
    <table border=1>
        <tr>
            <th>
                Label
            </th>
            <th>
                Name
            </th>
            <th>
                Assigned
            </th>
        </tr>
        @foreach($roles as $role)
            <tr>
                <td> {{ $role->label }} </td>
                <td> {{ $role->name }} </td>


                <td> {!! Form::open() !!}
                    {!! Form::hidden('role_id', $role->id) !!}
                    {!! Form::submit($user->hasRole($role) ? 'Yes' : 'No' )!!}
                    {!! Form::close() !!}
                </td>


            </tr>
        @endforeach

    </table>

    <br/>
@endsection

