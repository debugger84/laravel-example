<!doctype html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">


        <title>Test app</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link href="libraries/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="libraries/bootstrap/css/bootstrap-theme.min.css" rel="stylesheet">
        <link href="css/styles.css" rel="stylesheet">
        <meta name="csrf-token" content="{{ csrf_token() }}">
    </head>
    <body>
        <div class="container">
            <div class="header clearfix">
                <h3 class="text-muted">Clients Application</h3>
                <hr>
            </div>

            @yield('content')

            <footer class="footer">
                <hr>
                <p>© 2016 Company, Inc.</p>
            </footer>

        </div>


        <script src="libraries/jquery/jquery-3.2.1.min.js"></script>
        <script src="libraries/bootstrap/js/bootstrap.min.js"></script>

        @yield('bottomScript')
    </body>
</html>
