@extends('layout.backend')



@section('title', 'Page Title')




@section('sidebar')
    @parent

@endsection


@section('content')
<br />
<br />
<br />
<br />

	<table border=1>
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
						{!! Form::submit('Delete') !!}
						{!! Form::hidden('id', $role->id) !!}
					{!! Form::close() !!}
				<td>
			</tr>
	    @endforeach

	</table>

<br />
	{!! Form::open() !!}

		{!! Form::label('name', 'name') !!}
		{!! Form::text('name') !!} <br />

		{!! Form::label('description', 'description') !!}
		{!! Form::text('description') !!} <br />

		{!! Form::submit('Create') !!}
	{!! Form::close() !!}
@endsection

