<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Confirm Verification</title>
</head>
<body>
    {{-- {{ $token }}
    {{ $email }} --}}
    <form action="{{ route('verifyEmail') }}" method="POST">
        @csrf
        <input type="hidden" name="email" value="{{ $email }}">
        <input type="hidden" name="token" value="{{ $token }}">
        <button type="submit" class="btn btn-primary"> confirm verification</button>
    </form>

</body>
</html>
