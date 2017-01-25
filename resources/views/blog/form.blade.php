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
        <img class='image blog-image' src="{{ $blog->featuredimage }}"/>
        {!! Form::label('featured_image', 'Featured image') !!}

        : {!! Form::file('featured_image', ['onchange' => 'readURL(this, ".blog-image")'] ) !!}

    </div>

    <div class="form-group">
        {!! Form::label('is_published', 'Published') !!}

        : {!! Form::checkbox('is_published', true, $blog->is_published, ['class' => 'form-control']) !!} <br/>
    </div>

    <div class="form-group">
        {!! Form::file('image1', ['id' => 'image1','onchange' => 'readURL(this, ".blog-image1")']) !!}
        <img id="blog-image1" class='image blog-image1 img-rounded' width="300" height="220" src="{{ isset($eventImages) ? $eventImages[0]->image: '' }}"/>
        {!! Form::file('image2', ['id' => 'image2','onchange' => 'readURL(this, ".blog-image2")']) !!}
        <img id="blog-image2" class='image blog-image2 img-rounded' width="300" height="220" src="{{ isset($eventImages) ? $eventImages[1]->image: '' }}"/>
        {!! Form::file('image3', ['id' => 'image3','onchange' => 'readURL(this, ".blog-image3")']) !!}
        <img id="blog-image3" class='image blog-image3 img-rounded' width="300" height="220" src="{{ isset($eventImages) ? $eventImages[2]->image: '' }}"/>
        {!! Form::file('image4', ['id' => 'image4','onchange' => 'readURL(this, ".blog-image4")']) !!}
        <img id="blog-image4" class='image blog-image4 img-rounded' width="300" height="220" src="{{ isset($eventImages) ? $eventImages[3]->image: '' }}"/>
        {!! Form::file('image5', ['id' => 'image5','onchange' => 'readURL(this, ".blog-image5")']) !!}
        <img id="blog-image5" class='image blog-image5 img-rounded' width="300" height="220" src="{{ isset($eventImages) ? $eventImages[4]->image: '' }}"/>
        {!! Form::file('image6', ['id' => 'image6','onchange' => 'readURL(this, ".blog-image6")']) !!}
        <img id="blog-image6" class='image blog-image6 img-rounded' width="300" height="220" src="{{ isset($eventImages) ? $eventImages[5]->image: '' }}"/>
        {!! Form::file('image7', ['id' => 'image7','onchange' => 'readURL(this, ".blog-image7")']) !!}
        <img id="blog-image7" class='image blog-image7 img-rounded' width="300" height="220" src="{{ isset($eventImages) ? $eventImages[6]->image: '' }}"/>
        {!! Form::file('image8', ['id' => 'image8','onchange' => 'readURL(this, ".blog-image8")']) !!}
        <img id="blog-image8" class='image blog-image8 img-rounded' width="300" height="220" src="{{ isset($eventImages) ? $eventImages[7]->image: '' }}"/>
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

        $('#blog-image1').click(function () {
            $('#blog-image1').prop('src', '');
            $('#image1').val('');
        });
        $('#blog-image2').click(function () {
            $('#blog-image2').prop('src', '');
            $('#image2').val('');
        });
        $('#blog-image3').click(function () {
            $('#blog-image3').prop('src', '');
            $('#image3').val('');
        });
        $('#blog-image4').click(function () {
            $('#blog-image4').prop('src', '');
            $('#image4').val('');
        });
        $('#blog-image5').click(function () {
            $('#blog-image5').prop('src', '');
            $('#image5').val('');
        });
        $('#blog-image6').click(function () {
            $('#blog-image6').prop('src', '');
            $('#image6').val('');
        });
        $('#blog-image7').click(function () {
            $('#blog-image7').prop('src', '');
            $('#image7').val('');
        });
        $('#blog-image8').click(function () {
            $('#blog-image8').prop('src', '');
            $('#image8').val('');
        });


    </script>


@stop
