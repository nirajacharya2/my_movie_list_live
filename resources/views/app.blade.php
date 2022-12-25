<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <link rel="shortcut icon" href="{{URL::asset('/movie.png')}}">




    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.2/assets/css/docs.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
    <style>
        html {
            margin: 0;
            padding: 0;
        }

        hr {
            margin: 0.2em;
        }


        .title {
            background: #E1E7F5;
            margin-bottom: 0.1em;
            padding: 0 0 0 0.3em;

        }



        .border-l-r-b {
            border-right: #E1E7F5 solid 1px;
            border-left: #E1E7F5 solid 1px;
            border-bottom: #E1E7F5 solid 1px;
        }

        .bordeR {
            border: #E1E7F5 solid 1px;
            padding: 1em;
            margin: 1em;
        }
        .genrebordeR {
            border: #E1E7F5 solid 1px;
            border-radius: 0.5em;
            /* padding: 0.1em;
            margin: 0.1em; */
        }

        .border-l-b {
            border-left: #E1E7F5 solid 1px;
            border-bottom: #E1E7F5 solid 1px;
        }

        a {
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

    </style>
    @stack('css')
    @stack('script')
    <title>@yield('title')</title>

</head>
<body>
    {{-- <button type="button" class="btn btn-primary" id="liveToastBtn">
        Show live toast
    </button> --}}

    {{-- <div class="toast-container position-fixed bottom-0 end-0 p-3">
        <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <img src="..." class="rounded me-2" alt="..." />
                <strong class="me-auto">Bootstrap</strong>
                <small>11 mins ago</small>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">Hello, world! This is a toast message.</div>
        </div>
    </div> --}}
    <div class="toast-container position-fixed bottom-0 end-0 p-3">

        <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">

            <div class="toast-header">
                {{-- <img src="..." class="rounded me-2" alt="..."> --}}
                <strong class="me-auto" id="req-status"> ✔️ </strong>

                <small class="text-muted">just now</small>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div id="suscess-message" class="toast-body">

            </div>
        </div>
    </div>

    <div class="container-lg">
        @if (Session::has('userInfo'))
        @section('userImage', Session::get('userInfo')->user_image)
        @section('username', Session::get('userInfo')->username)
        @endif
        @include('navbar')
        @yield('content')
        @stack('script')
        @yield('extraScripts')
        {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script> --}}
    </div>
    @include('footer')
</body>
</html>
