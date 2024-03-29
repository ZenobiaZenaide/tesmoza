<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>

    {{-- Daftar Link Styles --}}


    <link rel='stylesheet' href="{{ asset('css/login.css') }}">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>


</head>

<body>
    
    <div class ="wrapper">
        @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $item)
                    <li>{{ $item }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <form action="" method="POST">
            @csrf
            <h1>Monitoring Fallout</h1>
            
            <div class="input-box">
                <input type="text" value="{{ old('email') }}" name="id_employee" placeholder="id_employee" class="form-control">
                <i class='bx bxs-user'></i>
            </div>
            <div class="input-box">
                    <input type="password" name="password" placeholder="Password" class="form-control">
                    <i class='bx bxs-lock'></i>

            </div>
            <div class="remember-forgot">
                <label><input type="checkbox"> Remember me</label>
                <a href="#">Forgot Password?</a>
            </div>
            
            <button type="submit" class="btn">Login</button>

        </form>
</body>
</html>