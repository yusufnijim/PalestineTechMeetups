@extends('layout.backend')

@section('content')


    Title: {{ $blog->title }} <br/>
    Body: {!!  $blog->body !!} <br/>


@stop