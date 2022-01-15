@if ($message = Session::get('server_error'))
<div class="alert alert-danger alert-block">
    <strong>{{$message}}</strong>
</div>
@endif

@if ($message = Session::get('success'))
<div class="alert alert-success alert-block">
    <strong>{{ $message }}</strong>
</div>
@endif