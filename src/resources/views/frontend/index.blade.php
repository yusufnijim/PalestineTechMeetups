@extends ("layout/frontend")

@section("content")
    Here we display events/blogs and information about NTM

    <script src="//cdn.ckeditor.com/4.5.3/standard/ckeditor.js"></script>
    </head>
    <body>
    <textarea name="editor"></textarea>
    <script>
        CKEDITOR.replace('editor', {
            filebrowserBrowseUrl: '{!! url('/filemanager/index.html') !!}'
        });
    </script>

@endsection