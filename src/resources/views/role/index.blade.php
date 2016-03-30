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

    <table border="1" class="role_index table table-striped table-bordered table-hover" id="dataTables-example">

        <tr>
            <th>
                Label
            </th>
            <th>
                Name
            </th>
            <th>
                Description
            </th>
            <th>
                Delete
            </th>
        </tr>
        @foreach($roles as $role)
            <tr>
                <td> {{ $role->label }} </td>
                <td> {{ $role->name }} </td>
                <td> {{ $role->description }} </td>

                <td>
                {!! Form::open(['method' => 'delete']) !!}
                {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-block' , 'onclick' => 'return confirm("Are you sure you want to delete?")']) !!}

                {!! Form::hidden('id', $role->id) !!}
                {!! Form::close() !!}
                </td>
            </tr>
        @endforeach

    </table>

    <br/>
    {!! Form::open() !!}

    {!! Form::label('name', 'name') !!}
    {!! Form::text('name') !!} <br/>

    {!! Form::label('description', 'description') !!}
    {!! Form::text('description') !!} <br/>

    {!! Form::submit('Create') !!}
    {!! Form::close() !!}
@endsection

