@extends ("layout/frontend")

@section("content")
    {{ trans('frontend/index.Welcome') }}

    <h2>Events</h2>
    <hr/>
    @foreach($events as $event)
        <h3>{{ $event->title }}</h3>
        <img src="{{ $event->featured_image }}" class='event-image' />
        {!! $event->summary  !!}<br/>
        <a href="/registration/signup/{{$event->id}}">Read more...</a>
        <br/>
        <br/>
    @endforeach
    <h2>Blogs</h2>
    <hr/>

    @foreach($blogs as $blog)
        <h3>{{ $blog->title }}</h3>
        <img src="{{ $blog->featured_image }}" class='blog-image' />

        {!! $blog->summary  !!}<br/>

        <a href="/blog/view/{{$blog->id}}">Read more...</a>
        <br/>
        <br/>
    @endforeach
    <hr/>


@endsection