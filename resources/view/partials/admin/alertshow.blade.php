
@if (isset($errors))
@foreach ($errors as $error)

<div class="alert alert-danger">
    <span> {{ $error }} </span>
</div>

<?php \System\Session::delete('errors'); ?>

@endforeach
@endif

@if (isset($alerts))
@foreach ($alerts as $alert)

<div class="alert alert-info">
    <span> {{ $alert }} </span>
</div>

<?php \System\Session::delete('alerts'); ?>

@endforeach
@endif