@extends('app')
@section('title','Reset Password')
@section('content')
<div style="background: #E1E7F5 ;padding:0.1em;">
    <h1>Password Reset</h1>
</div>
<div class="container" style="max-width: 400px;padding:2em;">
    <form action="{{ route('sendresetmail') }}" method="POST" class="row g-3">
        @csrf
        <div class="col-md-12 alert alert-primary" role="alert">Enter your email address and we will send you a link to reset your password</div>
        <div class="col-md-12">
            <label for="validationDefault02" class="form-label">E-mail</label>
            <input type="email" class="form-control" id="validationDefault02" name="email" placeholder="" value="{{ old('username') }}" required>
            <span class="text-danger">@error('email'){{ $message }}@enderror</span>
        </div>
        <div class="col-12">
            <button class="btn btn-primary" type="submit">Send Password Reset Link</button>
        </div>
    </form>
    <br>
    @if ($message=Session::get('success'))
    <div class="alert alert-info">
        {{ $message }}
    </div>
    @elseif ($message=Session::get('fail'))
    <div class="alert alert-danger">
        {{ $message }}
    </div>
    @endif
</div>
@endsection
@section('extraScripts')
<script>
</script>
@endsection
