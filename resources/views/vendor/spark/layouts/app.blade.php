<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Meta Information -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="token" content="{{ csrf_token() }}">
    <meta name="description" content="Display website previews on your website using our API.">
    <meta name="robots" content="index, nofollow">
    <meta name="author" content="Valentin Prugnaud">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title', 'Snikpik :: Website preview made simple.')</title>


    <!-- Facebook -->
    <meta property="og:title" content="Website preview made easy">
    <meta property="og:site_name" content="Snikpik.io">
    <meta property="og:url" content="https://snikpik.io">
    <meta property="og:description" content="Display website previews on your website using our API.">
    <meta property="fb:app_id" content="841769272634645">
    <meta property="og:type" content="website">
    <meta property="og:image" content="{{ asset('img/color-logo.png') }}">

    <!-- CSS -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('favicon.png') }}" rel="icon">

    <!-- Scripts -->
    @yield('scripts', '')

    <!-- Global Spark Object -->
    <script>
        window.Spark = <?php echo json_encode(array_merge(
            Spark::scriptVariables(), []
        )); ?>
    </script>
</head>
<body class="with-navbar" v-cloak>
    <script>
        window.fbAsyncInit = function() {
            FB.init({
                appId      : '841769272634645',
                xfbml      : true,
                version    : 'v2.6'
            });
        };

        (function(d, s, id){
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) {return;}
            js = d.createElement(s); js.id = id;
            js.src = "//connect.facebook.net/en_US/sdk.js";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
    </script>
    <div id="spark-app">
        <!-- Navigation -->
        @if (Auth::check())
            @include('spark::nav.user')
        @else
            @include('spark::nav.guest')
        @endif

        <!-- Main Content -->
        @yield('content')

        <!-- Application Level Modals -->
        @if (Auth::check())
            @include('spark::modals.notifications')
            @include('spark::modals.support')
            @include('spark::modals.session-expired')
        @endif

        <!-- JavaScript -->
        <script src="/js/vendor.js"></script>
        <script src="/js/app.js"></script>
        <script>
            hljs.initHighlightingOnLoad();
            $('[data-toggle="dropdown"]').dropdown();
        </script>
    </div>
</body>
</html>
