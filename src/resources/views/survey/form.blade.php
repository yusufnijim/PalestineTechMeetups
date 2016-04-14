@extends('layout.backend')

@section('content')

    @yield('form')

    <div>
        Title: {!! Form::text('name', $survey->name, ['required' => 'true']) !!} <br/>
        Body: {!! Form::textarea('description', $survey->description,
        ['class'=>'survey_body', 'id' => 'survey_body']) !!}
        <br/>


        {!! Form::submit('submit', ['class' => 'btn btn-default']) !!}
        {!! Form::close() !!}

        @if(isset($edit))
            @include('survey/partial/formbuilder')
        @endif

    </div>
    <script src="//cdn.ckeditor.com/4.5.3/standard/ckeditor.js"></script>
    <script type="text/javascript">
        CKEDITOR.replace('description2', {
            filebrowserBrowseUrl: '{!! url('filemanager/index.html') !!}'
        });

    </script>


@stop
