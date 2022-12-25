@extends('app')
@section('title','Reset Password')
@section('content')
<div style="background: #E1E7F5 ;padding:0.1em;">

    <h1>Password Reset</h1>




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

    <form action="{{ route('passwordresetconformation') }}" method="POST" class="row g-3">
        @csrf
        <div class="col-md-12">
            <label for="validationDefault02" class="form-label">E-mail</label>
            <input type="email" class="form-control" id="validationDefault02" name="email" placeholder="" value="{{ $email }}" required>
            <span class="text-danger">@error('email'){{ $message }}@enderror</span>
        </div>
        <input type="hidden" name="token" value="{{ $token }}">
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
            <span class="text-danger">@error('password')@enderror</span>
        </div>
        <div class="col-md-12">
            <div class="row g-3">
                <div class="col">
                    <label for="validationDefault003" class="form-label">Confirm Password</label>
                </div>
                <div class="col text-end">
                    <input class="form-check-input" type="checkbox" value="" id="showconfirmpassword">
                    <label class="form-check-label" for="flexCheckDefault">
                        Show Password
                    </label>
                </div>
            </div>
            <input type="password" class="form-control" id="validationDefault003" name="confirmpassword" placeholder="" required>
            <span class="text-danger">@error('confirmpassword')@enderror</span>

        </div>
        <div class="col-12">
            <button class="btn btn-primary" type="submit">Reset</button>
        </div>
    </form>
</div>
@endsection
@section('extraScripts')
<script>
    document.getElementById("showpassword").addEventListener("click", myFunction1);


    document.getElementById("showconfirmpassword").addEventListener("click", myFunction2);

    function myFunction1() {
        var x = document.getElementById("validationDefault03");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }

    function myFunction2() {
        var x = document.getElementById("validationDefault003");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }

</script>

@endsection
