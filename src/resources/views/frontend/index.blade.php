@extends ("layout/frontend")

@section("content")
    Here we display events/blogs and information about NTM

    <h2>Events</h2>
    <hr/>
    @foreach($events as $event)
        <h3>{{ $event->title }}</h3>
        {{$event}} <br/>
        <a href="/events/view/{{$event->id}}">Read more...</a>
        <br/>
        <br/>
    @endforeach
    <h2>Blogs</h2>
    <hr/>

    @foreach($blogs as $blog)
        <h3>{{ $blog->title }}</h3>
        {{$blog}} <br/>

        <a href="/events/view/{{$event->id}}">Read more...</a>
        <br/>
        <br/>
    @endforeach
    <hr/>


@endsection