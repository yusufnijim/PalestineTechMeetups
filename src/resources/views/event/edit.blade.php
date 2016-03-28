@extends('layout.backend')



@section('content')
    <div>
        {!! Form::open(['method' => 'put']) !!}
        Title: {!! Form::text('title', $event->title, ['required' => 'true']) !!} <br/>
        Body: {!! Form::textarea('body', $event->body, ['class'=>'event_body', 'id' => 'event_body']) !!}
        <br/>

        Max registrars
        count: {!! Form::number('max_registrars_count', $event->max_registrars_count, ['min'=> 1, 'max' => 999, 'required' => true]) !!}
        <br/>
        registration open: {!! Form::checkbox('is_registration_open', true, $event->is_registration_open) !!} <br/>
        Event Date: {!! Form::date('date', $event->date, ['class'=> 'event_date']) !!} <br/>
        Location: {!! Form::textarea('location', $event->location, ['size' => '30x2']) !!} <br/>

        Require additional user details: {!! Form::checkbox('require_additional_fields', true, $event->require_additional_fields) !!} <br/>

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