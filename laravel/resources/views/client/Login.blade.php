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
                <div class="col-4"></div>
                <div class="col py-5 shadow-lg p-3 mb-5 rounded login position-relative">
                    <h3 class="text-center login-text">Login</h3>
                    <form action="{{route('trangchu.login')}}" method="post">
                        @csrf
                        @if ($errors->any())
                            <div class="alert alert-danger text-center">
                                <p>{{$errorsM}}</p>
                            </div>
                        @endif
                        <div class="form-group py-3">
                            <label class="login-item" for="username">Username:</label>
                            <input type="text" class="form-control" name="username" value="{{old('username')}}">
                            @error('username')
                                <span style="color:red;">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group py-3">
                            <label class="login-item" for="pwd">Password:</label>
                            <input type="password" class="form-control" name="pwd" value="{{old('pwd')}}">
                            @error('pwd')
                                <span style="color:red;">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="checkbox">
                            <label><input type="checkbox"> Remember me</label>
                        </div>
                        <button type="submit" class="btn btn-primary position-absolute top-90 start-50 translate-middle">Login</button>
                    </form>
                </div>
                <div class="col-4"></div>
            </div>
        </div>
    </section>
</body>
</html>