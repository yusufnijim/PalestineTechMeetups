@extends('layout.backend')

@section('content')

    @foreach($results as $result)
        {{ $result }}
    @endforeach
@endsection