<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Meta Information -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Snikpik.io :: Web preview made easy</title>
    <link rel="icon" href="{{ asset('favicon.png') }}" type="image/png">

    <!-- Fonts -->
    <link href='https://fonts.googleapis.com/css?family=Lato:300,400,600' rel='stylesheet' type='text/css'>

    <style>
        body, html {
            background: url('img/bg.jpg') #EFEFEF no-repeat;
            background-blend-mode: overlay;
            height: 100%;
            margin: 0;
        }

        .full-height {
            min-height: 100%;
        }

        .flex-column {
            display: flex;
            flex-direction: column;
        }

        .flex-fill {
            flex: 1;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }


        .text-center {
            text-align: center;
            font-family: 'Lato', Helvetica, Arial, sans-serif;
        }

        .links {
            padding: 1em;
            text-align: right;
        }

        .links a {
            text-decoration: none;
        }

        .links button {
            background-color: #3097D1;
            border: 0;
            border-radius: 4px;
            color: white;
            cursor: pointer;
            font-family: 'Open Sans';
            font-size: 14px;
            font-weight: 600;
            padding: 15px;
            text-transform: uppercase;
            width: 100px;
        }
    </style>
</head>
<body>
    <div class="full-height flex-column">
        {{--<nav class="links">--}}
            {{--<a href="/login" style="margin-right: 15px;">--}}
                {{--<button>--}}
                    {{--Login--}}
                {{--</button>--}}
            {{--</a>--}}

            {{--<a href="/register">--}}
                {{--<button>--}}
                    {{--Register--}}
                {{--</button>--}}
            {{--</a>--}}
        {{--</nav>--}}

        <div class="flex-fill flex-center">
            <h1 class="text-center">
                <img src="/img/color-logo.png"><br>
                Coming soon.
            </h1>
        </div>
    </div>
</body>
</html>
