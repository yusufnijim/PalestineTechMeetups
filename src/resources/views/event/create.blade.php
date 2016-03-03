@extends('layout.master')



@section('content')
    <div>
        {!! Form::open() !!}
        Title: {!! Form::text('title') !!} <br / >
        Body: {!! Form::textarea('body', '', ['class'=>'event_body', 'id' => 'event_body']) !!} <br/>

        Max registrars count: {!! Form::number('max_registrars_count', 1, ['min'=> 1, 'max' => 999]) !!} <br/>
        registration open: {!! Form::checkbox('is_registration_open', true, true) !!} <br/>
        Event Date: {!! Form::date('date', '', ['class'=> 'event_date']) !!} <br/>
        Location: {!! Form::textarea('location', '', ['size' => '30x2']) !!} <br/>
        {!! Form::submit('create') !!}

        {!! Form::close() !!}


        <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
        <script>tinymce.init({selector: '.event_body'});</script>
        <script type="text/javascript">
            $(document).ready(function () {
                $('.event_date').datepicker({
                    format: 'yyyy-mm-dd',
                    defaultDate: 'now',
                    autoclose: true
                });
            });
            $("#event_date").datepicker("setDate", new Date());

        </script>
    </div>
@stop