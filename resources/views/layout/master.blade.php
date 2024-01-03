<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produtos</title>

    <link rel="stylesheet" href="{{ asset('site/style.css') }}">
</head>

<body>

    <div class="main-wrapper" id="app">
        <div class="page-wrapper full-page">
            @yield('content')
        </div>
    </div>
    <script src="{{ asset('site/jquery.js') }}"> </script>
    <script src="{{ asset('site/bootstrap.js') }}"> </script>

</body>

</html>