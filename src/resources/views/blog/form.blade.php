@extends('layout.backend')

@section('content')

    @yield('form')

    Title: {!! Form::text('title', $blog->title) !!} <br/>
    Body: {!! Form::textarea('body', $blog->body, ['class'=>'event_body', 'id' => 'event_body']) !!} <br/>

    Published: {!! Form::checkbox('is_published', true, $blog->is_published) !!} <br/>


    {!! Form::submit('submit') !!}
    {!! Form::close() !!}


    <script src="//cdn.ckeditor.com/4.5.3/standard/ckeditor.js"></script>
    <script type="text/javascript">
        CKEDITOR.replace('body', {
            filebrowserBrowseUrl: '{!! url('filemanager/index.html') !!}'
        });


    </script>


@stop
