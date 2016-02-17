@extends('layout.master')

@section('sidebar')
@stop



@section('content')
    <form method="post">
        <label>{{ trans('customer.email') }}</label>
        {!! Form::text('email'); !!}
        <br/>

        <label>{{ trans('customer.password') }}</label>
        {!! Form::password('password'); !!}
        <br>

        <label>{{ trans('customer.confirmpass') }}</label>
        {!! Form::password('password_confirmation'); !!}
        <br>

        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input class='btn' type="submit" value="{{ trans('customer.register') }}">
    </form>

@stop