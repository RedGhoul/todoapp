<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" href="{{URL::asset('/images/favicon.ico')}}" />
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous"
        referrerpolicy="no-referrer"
    />

    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">


    <style>

        body {
            display: flex;
            min-height: 100vh;
            flex-direction: column;
        }

        main {
            flex: 1 0 auto;
        }

    </style>
    <title>Todoisty</title>
</head>
    <body>

    <nav>
        <div class="nav-wrapper">
            <a href="#" class="brand-logo">Todoisty</a>
            <ul id="nav-mobile" class="right hide-on-med-and-down">
                @auth
                    <li>
                        <span class="font-bold uppercase">
                            Welcome {{auth()->user()->name}}
                        </span>
                            </li>
                            <li>
                                <a href="/todo/all" class="hover:text-laravel"
                                ><i class="fa-solid fa-gear"></i>
                                    Manage Todos</a
                                >
                            </li>
                            <li>
                                <form class="inline" method="POST" action="/logout">
                                    @csrf
                                    <button class="btn-large" type="submit">
                                        <i class="fa-solid fa-door-closed"></i>Logout
                                    </button>
                                </form>
                        </li>
                @else
                    <li>
                        <a href="/register" class="hover:text-laravel"
                        ><i class="fa-solid fa-user-plus"></i> Register</a
                        >
                    </li>
                    <li>
                        <a href="/login" class="hover:text-laravel"
                        ><i class="fa-solid fa-arrow-right-to-bracket"></i>
                            Login</a
                        >
                    </li>
                @endauth
            </ul>
        </div>
    </nav>


    <main style="padding-bottom: 30rem">
        {{$slot}}
    </main>
    <footer class="page-footer">
        <div class="container">
            <div class="row">
                <div class="col l6 s12">
                    <h5 class="white-text">Start Now</h5>
                    <p class="grey-text text-lighten-4">You can use rows and columns here to organize your footer content.</p>
                </div>
                <div class="col l4 offset-l2 s12">
                    <h5 class="white-text">Links</h5>
                    <ul>
                        <li><a class="grey-text text-lighten-3" href="#!">Legal</a></li>
                        <li><a class="grey-text text-lighten-3" href="#!">About</a></li>
                        <li><a class="grey-text text-lighten-3" href="#!">Pricing</a></li>
                        <li><a class="grey-text text-lighten-3" href="#!"></a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="footer-copyright">
            <div class="container">
                © 2014 Copyright Todoisty
                <a class="grey-text text-lighten-4 right" href="https://www.avaneesa.com/"  target="_blank">Find more here</a>
            </div>
        </div>
    </footer>
    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script src="//unpkg.com/alpinejs" defer></script>
    <x-flash-message></x-flash-message>
</body>
</html>
