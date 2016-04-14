@extends ("layout/frontend")

@section("content")
    <h3>Hello, send us a message and we'll get back to you ASAP :)</h3>
    <br/>
    <br/>
    <br/>

    {!! Form::open() !!}

    <div class="form-group">
        {!! Form::label('name', 'Name') !!}
        : {!! Form::text('name', '', ['required' => 'true', 'id' => 'name', 'class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('email', 'Email') !!}
        : {!! Form::email('email', '', ['required' => 'true', 'id' => 'email', 'class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('title', 'Title') !!}
        : {!! Form::text('title', '', ['required' => 'true', 'id' => 'title', 'class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('body', 'Message') !!}
        : {!! Form::textarea('body', '', ['required'=> 'true', 'class'=>'body', 'id' => 'message', 'class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::submit('send', ['class' => 'btn btn-default']) !!}
    </div>

    {!! Form::close() !!}
@endsection