@extends('layout.backend')


@section('content')
    <div>
        <h2>{{ $event->title }} </h2><br/> <br/> <br/>

        {!!  $event->featuredimagetag !!} <br/>
        Event Type: {!!  $event->eventtype !!}<br/>
        Event description{!!  $event->body !!}

        @if(!auth()->check())
            <h4>Login to sign up now !</h4>
        @elseif(! $event->is_registration_open)
            <h4>Sorry registration for this event has been closed</h4>
        @elseif($status)
            <h4> You signed up for this event </h4>
            If you wish to cancel your registration
            {!! Form::open() !!}
            {!! Form::hidden('cancel', 1) !!}
            {!! Form::submit('press here', ['class' => 'btn btn-info']) !!}
            {!! Form::close() !!}
        @else

            @if(!$event->require_addional_fields)
                {!! Form::open() !!}

                {!! Form::submit('register now') !!}
                {!! Form::close() !!}
            @else
                {!! Form::open() !!}

                {!! Form::submit('Register now', ['class' => 'btn btn-success']) !!}
                {!! Form::close() !!}

            @endif
        @endif
    </div>

    <div id="disqus_thread"></div>
    <script>
        /**
         *  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
         *  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables
         */
//        /*
         var disqus_config = function () {
         this.page.url = '{{ url('/') }}' ;  // Replace PAGE_URL with your page's canonical URL variable
         this.page.identifier = 1; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
         };
//         */
        (function() {  // DON'T EDIT BELOW THIS LINE
            var d = document, s = d.createElement('script');

            s.src = '//nablustm.disqus.com/embed.js';

            s.setAttribute('data-timestamp', +new Date());
            (d.head || d.body).appendChild(s);
        })();
    </script>
    <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript" rel="nofollow">comments powered by Disqus.</a></noscript>

    {{--<script id="dsq-count-scr" src="//nablustm.disqus.com/count.js" async></script>--}}
    {{--<a href="http://example.com/bar.html#disqus_thread">Link</a>--}}



@stop