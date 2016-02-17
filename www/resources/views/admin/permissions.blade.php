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
					Role name
				</th>
				<th>
					Role slug
				</th>
				<th>
					Description
				</th>
			</tr>
		@foreach($permissions as $permission)
			<tr>
				<td> {{ $permission->name }} </td>
				<td> {{ $permission->slug }} </td>
				<td> {{ $permission->description }} <td>
				<td> {{ $permission->description }} <td>
			</tr>
	    @endforeach

	</table>

<br />

@endsection

