@extends('layout.master')



@section('content')
    <div>
        {!! Form::open() !!}
        Title: {!! Form::text('title') !!} <br />
        Body: {!! Form::textarea('body', '', ['class'=>'event_body', 'id' => 'event_body']) !!} <br/>

        Published: {!! Form::checkbox('is_published', true, true) !!} <br />

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