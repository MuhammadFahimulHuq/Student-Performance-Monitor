<!DOCTYPE html>
<html lang="en">

<head>
    <title>Login Page</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('css/login.css') }}" rel="stylesheet">
    <script src="{{ asset('js/app.js') }}" defer></script>
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

</head>

<body class="wrapper fadeInDown">
    <header>
        <div class="box1">
            <div class="first">
                <img src="/img/iub_logo.png" width="280px" height="180px">
                <h1>Student Performance Monitor</h1>
            </div>
            {{-- <h1 class="first">Login</h1> --}}
        </div>
    </header>
    <div class="box2">

        @if (session()->has('message'))
            <div class="alert alert-danger">{{ session()->get('message') }}</div>
        @endif

        <form action="{{ route('validationLogin') }}" id="box-id-2" method="POST">
            @csrf
            <p> </p>

            <img class="img-fix" src="img/Sample_User_Icon.png">
            <input class="EEN" type="text" placeholder="User" name="username" required><br><br>
            @error('username')
                <h1>{{ $message }}</h1>
            @enderror

            <img class="img-fix" src="img/PikPng.com_lock-png_1220187.png">
            <input class="EEN" type="password" placeholder="Password" name="password" required><br><br>
            @error('password')
                <h1>{{ $message }}</h1>
            @enderror
            <span class="AB">
                <input id="BTN1" class="BTTN" type="submit" value="Login">
            </span>
        </form><br>
    </div>
</body>

</html>
