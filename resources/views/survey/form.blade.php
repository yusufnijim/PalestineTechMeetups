@extends('layout.backend')

@section('content')

    <ul class="nav nav-tabs">
        <li class="active"><a data-toggle="tab" href="#edit">Edit</a></li>
        <li><a data-toggle="tab" href="#view" onclick="survey_fetch()">View</a></li>
    </ul>

    <div class="tab-content">
        <div id="edit" class="tab-pane fade in active">
            <h3>Edit</h3>


            @yield('form')

            <div>
                Title: {!! Form::text('name', $survey->name, ['required' => 'true']) !!} <br/>
                Body: {!! Form::textarea('description2',
                $survey->description, ['class'=>'survey_body', 'id' => 'survey_body']) !!}
                <br/>


                @if(!isset($edit))
                    {!! Form::submit('next', ['class' => 'btn btn-default']) !!}
                @else
                    {!! Form::submit('submit', ['class' => 'btn btn-default']) !!}

                @endif

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

        </div>
        <div id="view" class="tab-pane fade">
        </div>
    </div>

    <script>
        function survey_fetch() {
            survey_id = $('#survey_id').val();
            $.get('/survey/viewajax/' + survey_id, [], function (data) {
                $("#view").html(data);
            });
        }
    </script>
@stop
