<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Rese</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/nav.css') }}" />
</head>

<body>
    <header class="header">
        <div class="header_inner">
            <form class="form" action="/back" method="post">
                @csrf
                <button class="button_back" type="submit"></button>
            </form>
        </div>
    </header>

    <main>
        <div class="nav_content">
            <div class="nav_inner">
                <ul>
                    <li>
                        <a href="/">Home</a>
                    </li>
                    @auth
                    <li>
                        <form action="/logout" method="post">
                            @csrf
                            <button type="submit">Logout</button>
                        </form>
                    </li>
                    <li>
                        <a href="/mypage">Mypage</a>
                    </li>
                    @endauth
                    @guest
                    <li>
                        <a href="/register">Registration</a>
                    </li>
                    <li>
                        <a href="/login">Login</a>
                    </li>
                    @endguest
                </ul>
            </div>
        </div>
    </main>
</body>

</html>