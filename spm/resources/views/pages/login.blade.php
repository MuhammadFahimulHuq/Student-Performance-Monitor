<!DOCTYPE html>
<html lang="en">

<head>
    <title>Login Page</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('css/login.css') }}" rel="stylesheet">
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
        <form id="box-id-2" method="GET"><p> </p>
            <img class="img-fix" src="img/Sample_User_Icon.png">
            <input class="EEN" type="text" placeholder="Usernmae" name="email" required><br><br>
            <img class="img-fix" src="img/PikPng.com_lock-png_1220187.png">
            <input class="EEN" type="password" placeholder="Password" name="password" required><br><br>
            <span class="AB">
                <input id="BTN1" class="BTTN" type="submit" value="Login">
            </span>
        </form><br>
    </div>
</body>

</html>

{{-- @extends('layout.main')

@section('content')

<div class="row align-items-center pt-5">
 <div class="row">
 <div class="col-md-6 offset-md-3 pt-5">
     <h2>User login</h2>
    <div class="container pt-4">
    <form>

  <div class="row mb-3">

    <label for="inputEmail3" class="col-sm-2 col-form-label col-form-label-lg">ID</label>
    <div class="col-sm-10">
      <input type="number" class="form-control form-control-lg" id="inputEmail3">
    </div>

  </div>



  <div class="row mb-3">

    <label for="inputPassword3" class="col-sm-2 col-form-label col-form-label-lg">Password</label>
    <div class="col-sm-10">
      <input type="password" class="form-control form-control-lg" id="inputPassword3">
    </div>

    </div>

    <div class="row mb-3">
    <div class="form-group">

    <label for="exampleFormControlSelect1" class="col-sm-2 col-form-label col-form-label-lg">User type</label>
    <select class="form-control" id="exampleFormControlSelect1">
      <option>Student</option>
      <option>Faculty</option>
      <option>Admin</option>

    </select>
  </div>

  </div>


  <button type="submit" class="btn btn-primary">Sign in</button>

</form>

    </div>


 </div>

  </div>

@endsection --}}
