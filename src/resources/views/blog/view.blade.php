@extends('layout.master')

@section('content')


    Title: {{ $event->title }} <br/>
    Body: {!!  $event->body !!} <br/>


@stop