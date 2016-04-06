@extends('layout.backend')

@section('content')

    @yield('form')

    <div class="form-group">
        {!! Form::label('title', 'Title') !!}
        : {!! Form::text('title', $event->title, ['required' => 'true', 'id' => 'title', 'class' => 'form-control']) !!}
        <br/>
    </div>
    <div class="form-group">
        {!! Form::label('permalink', 'Permalink') !!}

        : {!! Form::text('permalink', $event->permalink, ['required' => 'true', 'id' => 'permalink', 'class' => 'form-control']) !!}
        <br/>
    </div>
    <div class="form-group">

        {!! Form::label('body', 'Body') !!}
        : {!! Form::textarea('body', $event->body, ['class'=>'event_body', 'id' => 'event_body', 'class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        {!! $event->featured_image !!}
        {!! Form::label('featured_image', 'Featured image') !!}

        : {!! Form::file('featured_image', ['onchange' => 'readURL(this, ".user_image")'] ) !!}

    </div>

    <div class="form-group">

        {!! Form::label('max_registrars_count', 'Max registrars count') !!}:
        {!! Form::number('max_registrars_count', $event->max_registrars_count, ['min'=> 1, 'max' => 999, 'required' => true, 'class' => 'form-control']) !!}
        <br/>
    </div>
    <div class="form-group">
        {!! Form::label('is_registration_open', 'registration open') !!}

        : {!! Form::checkbox('is_registration_open', true, $event->is_registration_open) !!} <br/>
    </div>
    <div class="form-group">
        {!! Form::label('date', 'Event Date open') !!}

        : {!! Form::date('date', $event->date, ['class'=> 'event_date']) !!} <br/>
    </div>
    <div class="form-group">
        {!! Form::label('location', 'Location') !!}

        : {!! Form::textarea('location', $event->location, ['size' => '30x2']) !!} <br/>

    </div>
    <div class="form-group">
        {!! Form::label('is_published', 'Published') !!}

        : {!! Form::checkbox('is_published', 1, $event->is_published) !!} <br/>

    </div>
    <div class="form-group">
        {!! Form::label('require_additional_fields', 'Require additional user
        details') !!}

        : {!! Form::checkbox('require_additional_fields', true, $event->require_additional_fields) !!}
        <br/>
    </div>

    <div class="form-group">
        {!! Form::label('survey_id', 'Form') !!}

        : {!! Form::select('survey_id', $surveys)  !!}
        <a href="/survey/create" class="btn btn-warning" target="_blank">new form</a>
        <br/>
    </div>

    <div class="form-group">
        {!! Form::submit('submit', ['class' => 'btn btn-default']) !!}
    </div>
    {!! Form::close() !!}


    <script src="//cdn.ckeditor.com/4.5.3/standard/ckeditor.js"></script>
    <script type="text/javascript">
        CKEDITOR.replace('body', {
            filebrowserBrowseUrl: '{!! url('filemanager/index.html') !!}'
        });

        $("#title").keyup(function () {
            var str = sansAccent($(this).val());
            str = str.replace(/[^a-zA-Z0-9\s]/g, "");
            str = str.toLowerCase();
            str = str.replace(/\s/g, '-');
            $("#permalink").val(str);
        });
        function sansAccent(str) {
            var accent = [
                /[\300-\306]/g, /[\340-\346]/g, // A, a
                /[\310-\313]/g, /[\350-\353]/g, // E, e
                /[\314-\317]/g, /[\354-\357]/g, // I, i
                /[\322-\330]/g, /[\362-\370]/g, // O, o
                /[\331-\334]/g, /[\371-\374]/g, // U, u
                /[\321]/g, /[\361]/g, // N, n
                /[\307]/g, /[\347]/g // C, c
            ];
            var noaccent = ['A', 'a', 'E', 'e', 'I', 'i', 'O', 'o', 'U', 'u', 'N', 'n', 'C', 'c'];
            for (var i = 0; i < accent.length; i++) {
                str = str.replace(accent[i], noaccent[i]);
            }
            return str;
        }

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

@endsection