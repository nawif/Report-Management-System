<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth

                    @else
                        <a href="{{ route('login') }}">@lang('nav.login')</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">@lang('nav.register')</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    @lang('nav.app name')
                </div>

                <div class="links">
                    @auth
                        @if ((Auth::user()->canView()))
                            <a href={{url('report/home')}}>@lang('nav.home')</a>
                        @endif
                        @if ((Auth::user()->canCreate()))
                            <a href={{url('report/create')}}>@lang('nav.create report')</a>
                        @endif
                        <a href={{url('user/me')}}>@lang('nav.edit account')</a>
                    @endauth
                    <a href="https://github.com/nawif/">@lang('nav.github')</a>
                </div>
            </div>
        </div>
    </body>
</html>
