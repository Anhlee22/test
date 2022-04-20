<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('assets/client/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/client/css/login.css')}}">
    <title>Login</title>
</head>
<body>
    <section>
        <div class="container position-relative">
        <a class="back-home" href="{{route('trangchu.homePage')}}">Home</a>
            <div class="row py-5">
                <div class="col-3"></div>
                    <div class="col py-5 shadow-lg pb-5 rounded login position-relative">
                    <h3 class="text-center" style="color: white;">Register</h3>
                        <form action="{{route('trangchu.register')}}" method="POST">
                            @csrf
                            @if ($errors->any())
                                <div class="alert alert-danger text-center">
                                    <p>{{$errorsM}}</p>
                                </div>
                            @endif
                        <div class="form-group">
                            <label for="fullname">Full name:</label>
                            <input type="text" class="form-control" name="fullname" value="{{old('fullname')}}">
                            @error('fullname')
                                <span style="color:red;">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="fullname">User name:</label>
                            <input type="text" class="form-control" name="username" value="{{old('username')}}">
                            @error('username')
                                <span style="color:red;">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="phone_num">Phone number:</label>
                            <input type="text" class="form-control" name="phone_num" value="{{old('phone_num')}}">
                            @error('phone_num')
                                <span style="color:red;">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="text" class="form-control" name="email" value="{{old('email')}}">
                            @error('email')
                                <span style="color:red;">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="address">Address:</label>
                            <input type="text" class="form-control" name="address" value="{{old('address')}}">
                            @error('address')
                                <span style="color:red;">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="pass">Password:</label>
                            <input type="password" class="form-control" name="pass" value="{{old('pass')}}">
                            @error('pass')
                                <span style="color:red;">{{$message}}</span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary position-absolute top-100 start-50 translate-middle">Register</button>
                        </form>
                    </div>
                <div class="col-3"></div>
            </div>
        </div>
    </section>
</body>
</html>