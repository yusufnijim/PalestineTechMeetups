@extends ("layout/frontend")

@section("content")
    {{ trans('frontend/index.Welcome') }}

    <h2>Events</h2>
    <hr/>
    @foreach($events as $event)
        <h3>{{ $event->title }}</h3>
        {!! $event->featured_image_tag  !!}
        {!! $event->summary  !!}<br/>
        <a href="/registration/signup/{{$event->id}}">Read more...</a>
        <br/>
        <br/>
    @endforeach
    <h2>Blogs</h2>
    <hr/>

    @foreach($blogs as $blog)
        <h3>{{ $blog->title }}</h3>
        {!! $blog->featured_image_tag  !!}

        {!! $blog->summary  !!}<br/>

        <a href="/blog/view/{{$blog->id}}">Read more...</a>
        <br/>
        <br/>
    @endforeach
    <hr/>


@endsection