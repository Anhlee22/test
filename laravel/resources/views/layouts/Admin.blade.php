<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('assets/client/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/client/css/style.css')}}">
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <title>Admin | @yield('title')</title>
    @yield('css')
</head>
<body>
    @include('admin.blocks.header')
    <main class="container-xl">
        <div class=".container-xl">
            <div class=".container-xxl" style="">
                <aside>
                    @section('sidebar')
                        @include('admin.blocks.slidebar')
                    @show
                </aside>
            </div>
            <div class=".container-xxl">
                <div class="content" style="">
                    @yield('content')
                </div>
            </div>
        </div>
    </main>
    @include('admin.blocks.footer')
        <script src="{{asset('assets/client/js/bootstrap.min.js')}}"></script>
        <script src="{{asset('assets/client/js/custom.js')}}"></script>
    @yield('js')
</body>
</html>