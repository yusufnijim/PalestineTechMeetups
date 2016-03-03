@extends('layout.master')



@section('content')
    <div>
        {!! Form::open(['method' => 'put']) !!}
        Title: {!! Form::text('title', $event->title) !!} <br/>
        Body: {!! Form::textarea('body', $event->body, ['class'=>'event_body', 'id' => 'event_body']) !!} <br/>

        Max registrars
        count: {!! Form::number('max_registrars_count', $event->max_registrars_count, ['min'=> 1, 'max' => 999]) !!}
        <br/>
        registration open: {!! Form::checkbox('is_registration_open', true, $event->is_registration_open) !!} <br/>
        Event Date: {!! Form::date('date', $event->date, ['class'=> 'event_date']) !!} <br/>
        Location: {!! Form::textarea('location', $event->location, ['size' => '30x2']) !!} <br/>
        {!! Form::submit('update') !!}

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