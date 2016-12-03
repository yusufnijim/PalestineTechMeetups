{!! Form::open() !!}
<div class="form-group">

    {!! Form::label('name', 'name') !!}
    {!! Form::text('name', '', ['class' => 'form-control']) !!} <br/>
</div>
<div class="form-group">

    {!! Form::label('description', 'description') !!}
    {!! Form::text('description', '', ['class' => 'form-control']) !!} <br/>
</div>
<div class="form-group">

{!! Form::submit('submit', ['class' => 'btn btn-default']) !!}

{!! Form::close() !!}
