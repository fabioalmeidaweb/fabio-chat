<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Chatbot</title>
        <link rel="stylesheet" href="{{ mix('/css/app.css') }}">
    </head>
    <body class="blue-grey lighten-5">
        <nav id="main-nav">
            <div class="nav-wrapper container-fluid grey darken-4">
                <div class="row">
                    <div class="col s12">
                        <a href="#/" class="brand-logo"><i class="material-icons">chat</i>Chatbot</a>
                        <ul class="right hide-on-med-and-down">
                            <li>
                                <a id="nav-mobile" href="#" data-activates="slide-out" class="menu">
                                    <i class="material-icons">menu</i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>

        <ul id="slide-out" class="side-nav">
            <li>
                <div class="userView">
                    <div class="background"><img src="img/leaf_background.jpg" alt=""></div>
                    <a><img src="https://secure.gravatar.com/avatar/b1cd40e67b1bb0bfff24abe2781fa137" alt="" class="circle"></a>
                    <a><span class="white-text name">Fabio Almeida</span></a>
                    <a href="https://github.com/fabioalmeidaweb"><span class="white-text email">@fabioalmeidaweb</span></a>
                </div>
            </li>
        </ul>

        <div id="app"></div>
        <script src="{{ mix('/js/app.js') }}"></script>
    </body>
</html>
