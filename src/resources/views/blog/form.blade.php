@extends('layout.backend')

@section('content')

    @yield('form')

    <div class="form-group">
        {!! Form::label('title', 'Title') !!}

        : {!! Form::text('title', $blog->title, ['required' => 'true', 'id' => 'title', 'class' => 'form-control']) !!}
        <br/>
    </div>

    <div class="form-group">
        {!! Form::label('permalink', 'Permalink') !!}

        : {!! Form::text('permalink', $blog->permalink, ['required' => 'true', 'id' => 'permalink', 'class' => 'form-control']) !!}
        <br/>
    </div>


    <div class="form-group">
        {!! Form::label('body', 'Body') !!}

        : {!! Form::textarea('body', $blog->body, ['class'=>'event_body', 'id' => 'event_body', 'class' => 'form-control']) !!}

    </div>

    <div class="form-group">
        {!! $blog->featured_image !!}
        {!! Form::label('featured_image', 'Featured image') !!}

        : {!! Form::file('featured_image', ['onchange' => 'readURL(this, ".user_image")'] ) !!}

    </div>

    <div class="form-group">
        {!! Form::label('is_published', 'Published') !!}

        : {!! Form::checkbox('is_published', true, $blog->is_published, ['class' => 'form-control']) !!} <br/>
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
    </script>


@stop
