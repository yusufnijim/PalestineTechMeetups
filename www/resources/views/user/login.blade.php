@extends('layout.master')

@section('sidebar')
    @parent

    <p>This is appended <br /> <br /> <br /> <br /> <br /> to the master sidebar.</p>
@stop



@section('content')

    <br />
    <br />
    <br />
    <br />
    <br />
    <br />
    <br />
    <br />
    
    <div class='social-login' >
        <a href="{{ url('/facebook') }}">
            <img src='{{ asset("assets/img/fb.jpg") }}' style="height: 39px;">Login/Sign up with facebook
        </a>

        <br />
    </div>
@stop
