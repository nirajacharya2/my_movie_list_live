@extends('app')
@section('title','SignUp')
@section('content')
<style>
    div {
        /* border: 1px solid black; */
    }

</style>
<div style="background: #E1E7F5;padding:0.1em;">
    <h1>SignUp </h1>
</div>

<div class="container" style="padding:2em;">
    @if ($message=Session::get('success'))
    <div class="alert alert-info">
        {{ $message }}
    </div>
    @elseif ($message=Session::get('fail'))
    <div class="alert alert-danger">
        {{ $message }}
    </div>
    @endif
    <form action="{{ route('signup') }}" method="POST" class="row g-3">
        @csrf
        <div class="col-md-12">
            <label for="validationDefault01" class="form-label">Username</label>
            <input type="text" class="form-control" id="validationDefault01" name="username" placeholder="" value="{{ old('username') }}" required>
            <span class="text-danger">@error('username'){{ $message }}@enderror</span>
        </div>
        <div class="col-md-12">
            <label for="validationDefault02" class="form-label">E-mail</label>
            <input type="email" class="form-control" id="validationDefault02" name="email" placeholder="" value="{{ old('email') }}" required>
            <span class="text-danger">@error('email'){{ $message }}@enderror</span>
        </div>
        <div class="col-md-12">
            <label for="validationDefault02" class="form-label">Sex</label>
            <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                <input type="radio" class="btn-check" value='1' name="sex" id="btnradio1" required autocomplete="off">
                <label class="btn btn-outline-primary" for="btnradio1">Male</label>
                <input type="radio" class="btn-check" value='0' name="sex" id="btnradio2" required autocomplete="off">
                <label class="btn btn-outline-primary" for="btnradio2">Female</label>
            </div>
            <span class="text-danger">@error('sex'){{ $message }}@enderror</span>
        </div>
        <div class="col-md-12">
            <div class="row g-3">
                <div class="col">
                    <label for="validationDefault03" class="form-label">Password</label>
                </div>
                <div class="col text-end">
                    <input class="form-check-input" type="checkbox" name="showpassword" placeholder="" value="" id="showpassword">

                    <label class="form-check-label" for="flexCheckDefault">
                        Show Password
                    </label>
                </div>
            </div>
            <input type="password" class="form-control" id="validationDefault03" name="password" placeholder="" required>
            <span class="text-danger">@error('password'){{ $message }}@enderror</span>
        </div>
        <div class="col-md-12">
            <div class="row g-3">
                <div class="col">
                    <label for="validationDefault03" class="form-label">Confirm Password</label>
                </div>
                <div class="col text-end">
                    <input class="form-check-input" type="checkbox" name="showconfirmpassword" placeholder="" value="" id="showconfirmpassword">
                    <label class="form-check-label" for="flexCheckDefault">
                        Show Password
                    </label>
                </div>
            </div>
            <input type="password" class="form-control" name="confirmpassword" placeholder="" id="validationDefault003" required>
            <span class="text-danger">@error('confirmpassword'){{ $message }}@enderror</span>
        </div>
        <div class="col-md-12">
            <label for="validationDefault03" class="form-label">Date of Birth</label>
            <input type="date" class="form-control" name="dob" placeholder="" id="validationDefault03" value="{{ old('dob') }}" required>
            <span class="text-danger">@error('dob'){{ $message }}@enderror</span>
        </div>
        {{-- <div class="col-12">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="invalidCheck2" required="">
                <label class="form-check-label" for="invalidCheck2">
                    Remember Me
                </label>
            </div>
        </div> --}}
        <div class="col-12">
            <button class="btn btn-primary" type="submit">Submit form</button>
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

