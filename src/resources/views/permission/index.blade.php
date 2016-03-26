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

    <table border=1>
        <tr>
            <th>
                Label
            </th>
            <th>
                Name
            </th>
            @foreach($roles as $role)
                <th> {{ $role->name }} </th>
            @endforeach
        </tr>
        @foreach($permissions as $permission)
            <tr>
                <td> {{ $permission->label }} </td>
                <td> {{ $permission->name }} </td>


                @foreach($roles as $role)
                    <td>

                        {!! Form::open() !!}
                        {!! Form::hidden('permission_id', $permission->id) !!}
                        {!! Form::hidden('role_id', $role->id) !!}

                        {!! Form::submit($role->permissions()->find([$permission->id])->count() ? 'Yes' : 'No' )!!}

                        {!! Form::close() !!}
                    </td>
                @endforeach


            </tr>
        @endforeach

    </table>

    <br/>

@endsection

