@extends('layout.backend')

@section('content')


    Title: {{ $blog->title }} <br/>
    {!!  $blog->featuredimagetag !!} <br/>
    Body: {!!  $blog->body !!} <br/>


@stop