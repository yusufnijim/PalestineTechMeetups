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
        <thead>
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
        </thead>
        <tbody>

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

        </tbody>
    </table>
    @include('role/form')
    <br/>
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.11/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.11/js/jquery.dataTables.js"></script>

    <script>
        $(document).ready(function () {
            $('#dataTables-example').DataTable({
                responsive: true
            });
        });
    </script>

@endsection

