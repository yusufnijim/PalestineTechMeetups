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

<a href='/admin/roles'>Roles</a> <br />
<a href='/admin/permissions'>Permissions</a> <br />
<a href='/admin/users'>Users</a> <br />

    <p>This is my body content.</p>

@endsection

