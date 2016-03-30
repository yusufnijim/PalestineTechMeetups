@if (Session::has('flash_message') )


    <?php  $message = session('flash_message');
    ?>

    <div class="alert alert-{{ $message[1] }}">
        {{ $message[0] }}
    </div>


@endif
