@if (Session::has('flash_message') )

    {{ session('flash_message') }}
    
@endif
