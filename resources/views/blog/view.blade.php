@extends('layout.backend')

@section('content')

yyyy
    Title: {{ $blog->title }} <br/>
    {!!  $blog->featuredimagetag !!} <br/>
    Body: {!!  $blog->body !!} <br/>


@stop