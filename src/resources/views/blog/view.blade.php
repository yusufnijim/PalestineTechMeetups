@extends('layout.master')

@section('content')


    Title: {{ $blog->title }} <br/>
    Body: {!!  $blog->body !!} <br/>


@stop