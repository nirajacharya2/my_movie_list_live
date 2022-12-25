@extends('app')
@section('title','Login')
@section('content')
<div style="background: #E1E7F5 ;padding:0.1em;">
    <h1>Login </h1>
</div>
<div class="container" style="max-width: 400px;padding:2em;">
    @if ($message=Session::get('success'))
    <div class="alert alert-info">
        {{ $message }}
    </div>
    @elseif ($message=Session::get('fail'))
    <div class="alert alert-danger">
        {{ $message }}
    </div>
    @endif
    
    @if($message=='Email Not verified')

    <form action="{{ route('reVerify') }}" method="POST">
        @csrf
        <input type="hidden" name="username" value="{{ Session::get('data') }}">

        <button type="submit" class="btn btn-primary">verify</button>
    </form>
    @endif

    <form action="{{ route('loginPost') }}" method="POST" class="row g-3">
        @csrf
        <div class="col-md-12">
            <label for="validationDefault02" class="form-label">Username</label>
            <input type="text" class="form-control" id="validationDefault02" name="username" placeholder="" value="{{ old('username') }}" required>
            <span class="text-danger">@error('username'){{ $message }}@enderror</span>
        </div>
        <div class="col-md-12">
            <div class="row g-3">
                <div class="col">
                    <label for="validationDefault03" class="form-label">Password</label>
                </div>
                <div class="col text-end">
                    <input class="form-check-input" type="checkbox" value="" id="showpassword">
                    <label class="form-check-label" for="flexCheckDefault">
                        Show Password
                    </label>
                </div>
            </div>
            <input type="password" class="form-control" id="validationDefault03" name="password" placeholder="" required>
            <span class="text-danger">@error('password'){{ $message }}@enderror</span>
        </div>
        <div class="col-12">
            <button class="btn btn-primary" type="submit">Login</button>
        </div>
    </form>
    {{-- <div>
        <a href="{{ route('forgotpasswordmail') }}">Forgot password?</a>
    </div> --}}

</div>
@endsection
@section('extraScripts')
<script>
    document.getElementById("showpassword").addEventListener("click", myFunction1);
    function myFunction1() {
        var x = document.getElementById("validationDefault03");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }

</script>

@endsection
