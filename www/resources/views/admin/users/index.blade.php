@extends('layout.master')



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
					user name
				</th>
				<th>
					user email
				</th>
				<th>
					Description
				</th>
				<th>
					Delete
				</th>
			</tr>
		@foreach($users as $user)
			<tr>
				<td> {{ $user->first_name }} {{ $user->last_name }} </td>
				<td> {{ $user->email }} </td>

				<td> {{ $user->description }} </td>

				<td>
					{!! Form::open(['method' => 'delete']) !!}
						{!! Form::submit('Delete') !!}
						{!! Form::hidden('id', $user->id) !!}
					{!! Form::close() !!}
				<td>
			</tr>
	    @endforeach

	</table>

<br />

@endsection

