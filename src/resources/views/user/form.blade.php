@extends('layout.backend')

@section('content')

    @yield('form')
    <div class="form-group">
        {!! Form::label('first_name', 'First Name') !!}
        : {!!  Form::text('first_name', $user->first_name, ['required' => '', 'class'=>'form-control']) !!} <br/>
    </div>
    <div class="form-group">
        {!! Form::label('last_name', 'Last Name') !!}

        : {!!  Form::text('last_name', $user->last_name, ['required' => '', 'class'=>'form-control']) !!} <br/>
    </div>
    <div class="form-group">
        {!! Form::label('email', 'Email') !!}
        : {!!  Form::text('email', $user->email, [/* 'disabled' => 'true', */ 'class'=>'form-control']) !!}

    </div>
    <div class="form-group">
        {!! Form::label('location', 'Location') !!}

        : {!!  Form::text('location', $user->location,[ 'class'=>'form-control'] ) !!} <br/>
    </div>
    <div class="form-group">
        {!! Form::label('arabic_full_name', 'Full Arabic Name') !!}

        : {!!  Form::text('arabic_full_name', $user->arabic_full_name, ['required' => '', 'class'=>'form-control']) !!} <br/>


    </div>
    <div class="form-group">
        {!! Form::label('phone_number', 'Phone Number') !!}

        : {!!  Form::text('phone_number', $user->phone_number,[ 'class'=>'form-control'] ) !!} <br/>
    </div>
    <div class="form-group">
        {!! Form::label('profession', 'Profession') !!}


        : {!!  Form::select('profession', $user->professions(), @$user->professions(true)[$user->profession],[ 'class'=>'form-control'] ) !!}
        <br/>
    </div>
    <div class="form-group">
        {!! Form::label('profession_location', 'Profession Location') !!}

        : {!!  Form::text('profession_location', $user->profession_location,[ 'class'=>'form-control'] ) !!} <br/>

    </div>
    <div class="form-group">
        {!! Form::label('gender', 'Gender') !!}

        : Male {!!  Form::radio('gender', 1, $user->genderName == 'Male' ? true : '') !!}
        Female {!!  Form::radio('gender', 2, $user->genderName == 'Female' ? true : '' ) !!}
        <br/>

        <br/>
        {!! $user->imagetag !!}
    </div>
    <div class="form-group">
        {!! Form::label('image', 'Image') !!}

        : {!! Form::file('image', ['onchange' => 'readURL(this)'] ) !!}


    </div>
    <div class="form-group">
        {!! Form::submit('submit', ['class' => 'btn btn-default']) !!}
    </div>
    {!! Form::close() !!}

<script>
function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $(".user_image").attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>

@stop
