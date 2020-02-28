<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <link rel="stylesheet" href="/resources/demos/style.css">
        <link rel="stylesheet" href='/css/app.css' />

        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        @yield("scripts")
        <title>PaperWall @yield("title")</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
      
    </head>
    <body>
        <nav class="">
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="menu links">
                    @auth
                    @else
                        <a href="{{ route('login') }}">Login</a>
                        <a href="{{ route('register') }}">Register</a>
                    @endauth
                </div>
            @endif
            <div class = 'breadcrumb'>
                <ul class='breadcrumb'>
                @yield("breadcrumb")
            </ul>
            </div>
        </div></nav>
            <div class="content">

                @yield("mainContent")
                <div class="links">
                    @yield("links")
                </div>
            </div>
        </div>
    </body>
</html>
