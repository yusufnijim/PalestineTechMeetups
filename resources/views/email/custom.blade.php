{!! $body !!}

@if($confirm_attendance)
    <a href="{{ url('/registration/confirm/' . $event_id . "/" . $user->id) }}">Confirm</a>
@endif