@extends('layout.backend')

@section('content')


    <div>

        @foreach($survey->submissions as $submission)
            <div>
                <div>
                    <h3>
                        @if($submission->user_id)
                            <a href="/user/view/{{ $submission->user_id }}">{{ $submission->user->full_name }}</a>
                        @else
                            Anonymous :)
                        @endif
                    </h3>
                </div>

                @foreach($submission->answers as $answer)
                    <div>
                        <h4>Q: {{ $answer->question->title }}</h4>
                    </div>

                    <div>
                        A: {{ $answer->answer }}
                    </div>
                @endforeach
            </div>
        @endforeach

    </div>
@endsection