<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <title>API Colores</title>
</head>
<body>
    <div class="container-fluid">
        <!-- Content page -->
		@yield('content')
    </div>
    
    <!--Scripts-->
    <script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
    @stack('script')
</body>
</html>