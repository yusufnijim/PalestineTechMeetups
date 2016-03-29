@extends ("layout/frontend")

@section("content")
    Here we display events/blogs and information about NTM

    <h2>Events</h2>
    <hr/>
    @foreach($events as $event)
        {{$event}} <br /><br />
    @endforeach
    <h2>Blogs</h2>

    @foreach($blogs as $blog)
        {{$blog}} <br /><br />
    @endforeach
    <hr/>


@endsection