@extends('layout.frontend')

@section('content')

    <div onclick="goBack()">
        <h1><span style="color:black">404 NOT FOUND BRO</span></h1>
        <button class="btn btn-default btn-lg btn-block btn-info">Go back</button>
    </div>

    <script>
        function goBack() {
            window.history.back();
        }
    </script>


@endsection